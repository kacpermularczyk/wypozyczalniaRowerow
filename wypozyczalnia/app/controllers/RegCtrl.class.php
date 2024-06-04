<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\RegisterForm;

class RegCtrl {
  private $form;
  private $accounts;

  public function __construct() {
    $this->form = new RegisterForm();
  }
  public function validate(){
    $v = new Validator();

    $this->form->firstName = $v->validateFromRequest('firstName', ['regexp' => '/^[A-Za-z]+$/', 'min_length' => 5, 'max_length' => 30, 'validator_message' => 'Imie ma mieć od 5 do 30 znaków i składać się tylko z liter']);
    $this->form->surname = $v->validateFromRequest('surname', ['regexp' => '/^[A-Za-z]+$/', 'min_length' => 5, 'max_length' => 30, 'validator_message' => 'Nazwisko ma mieć od 5 do 30 znaków i składać się tylko z liter']);
    $this->form->email = $v->validateFromRequest('email', ['email' => true,'min_length' => 5, 'max_length' => 30, 'validator_message' => 'email ma mieć od 5 do 30 znaków']);
    $this->form->login = $v->validateFromRequest('login', ['min_length' => 5, 'max_length' => 30, 'validator_message' => 'Login ma mieć od 5 do 30 znaków']);
    $this->form->password = $v->validateFromRequest('password', ['min_length' => 5, 'max_length' => 30, 'validator_message' => 'Hasło ma mieć od 5 do 30 znaków']);
    $this->form->passwordRepeat = ParamUtils::getFromRequest('passwordRepeat');

    if (App::getMessages()->isError()){
      return false;
    }

    if (empty(trim($this->form->firstName))) {
      Utils::addErrorMessage('Wprowadź imie');
    }
    if (empty(trim($this->form->surname))) {
      Utils::addErrorMessage('Wprowadź nazwisko');
    }
    if (empty(trim($this->form->email))) {
      Utils::addErrorMessage('Wprowadź e-mail');
    }
    if (empty(trim($this->form->login))) {
      Utils::addErrorMessage('Wprowadź login');
    }
    if (empty(trim($this->form->password))) {
      Utils::addErrorMessage('Wprowadź hasło');
    }
    if (empty(trim($this->form->passwordRepeat))) {
      Utils::addErrorMessage('Powtórz hasło');
    }
    if($this->form->password != $this->form->passwordRepeat){
      Utils::addErrorMessage('Hasła nie są takie same');
      return false;
    }

    if (App::getMessages()->isError()){
      return false;
    }

    try{
      $this->accounts = App::getDB()->select('users', ['e-mail', 'login']);
    }
    catch(\PDOException $e){
        Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
        if (App::getConf()->debug){
            Utils::addErrorMessage($e->getMessage());
        }      
    }

    foreach($this->accounts as $a){
        if($this->form->email == $a['e-mail']){
            Utils::addErrorMessage('Istnieje już taki e-mail');
            return false;
        }
        if($this->form->login == $a['login']){
          Utils::addErrorMessage('Istnieje już taki login');
          return false;
        }
    }

    return !App::getMessages()->isError();
  }

  public function action_register(){
    if($this->validate()){
      try{
        $this->whenModified = date('Y/m/d H:i:s');
        $this->form->password = password_hash($this->form->password, PASSWORD_DEFAULT);
        $this->form->firstName = strtolower($this->form->firstName);
        $this->form->firstName = ucfirst($this->form->firstName);
        $this->form->surname = strtolower($this->form->surname);
        $this->form->surname = ucfirst($this->form->surname);
        
        App::getDB()->insert("users", ["first_name" => $this->form->firstName, "surname" => $this->form->surname, "e-mail" => $this->form->email, "login" => $this->form->login, "password" => $this->form->password, "when_modified" => $this->whenModified, "is_active" => 1]);

        $this->form->id = App::getDB()->get("users", ["id_user"], ["login" => $this->form->login]);

        App::getDB()->update("users", ["who_modified" => $this->form->id["id_user"]], ["login" => $this->form->login]);

        $this->roleUserId = App::getDB()->get("roles", ["id_role"], ["role" => "user"]);

        App::getDB()->insert("user_role", ["id_user" => $this->form->id['id_user'], "id_role" => $this->roleUserId['id_role'], "active_since" => $this->whenModified, "is_activated" => 1]);
      }
      catch (\PDOException $e){
          Utils::addErrorMessage('Wystąpił błąd podczas zapisu danych');
          if (App::getConf()->debug){
              Utils::addErrorMessage($e->getMessage());
          }      
      }
    }
    $this->generateView();
  }
  public function action_registerView(){
    $this->generateView();
  }
  public function generateView()
  {
    App::getSmarty()->assign('windowTitle','Rejestracja');
    App::getSmarty()->assign('title','Rejestracja');
    App::getSmarty()->assign('buttonText','Zarejestruj się');

    App::getSmarty()->display("regView.tpl");
  }
 
}