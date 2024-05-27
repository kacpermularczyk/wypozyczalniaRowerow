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
  private $helper;

  public function __construct() {
    $this->form = new RegisterForm();
  }
  public function validate(){
    $v = new Validator();

    $this->form->firstName = $v->validateFromRequest('firstName', ['min_length' => 5, 'max_length' => 30, 'validator_message' => 'Imie ma mieć od 5 do 30 znaków']);
    $this->form->surname = $v->validateFromRequest('surname', ['min_length' => 5, 'max_length' => 30, 'validator_message' => 'Nazwisko ma mieć od 5 do 30 znaków']);
    $this->form->email = $v->validateFromRequest('email', ['min_length' => 5, 'max_length' => 30, 'validator_message' => 'email ma mieć od 5 do 30 znaków']);
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
        
        App::getDB()->insert("users", ["first_name" => $this->form->firstName, "surname" => $this->form->surname, "e-mail" => $this->form->email, "login" => $this->form->login, "password" => $this->form->password, "when_modified" => $this->whenModified]);

        $this->form->id = App::getDB()->get("users", ["id_user"], ["login" => $this->form->login]);

        App::getDB()->update("users", ["who_modified" => $this->form->id["id_user"]], ["login" => $this->form->login]);
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