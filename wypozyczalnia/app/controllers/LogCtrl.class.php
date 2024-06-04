<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\RoleUtils;
use core\ParamUtils;
use core\SessionUtils;
use app\forms\LoginForm;

class LogCtrl {

  private $form;

  public function __construct() {
      $this->form = new LoginForm();
  }

  public function validate() {
    $this->form->login = ParamUtils::getFromRequest('login');
    $this->form->password = ParamUtils::getFromRequest('password');

    if(!isset($this->form->login)){
      return false;
    }

    if(!isset($this->form->password)){
      return false;
    }

    if(empty($this->form->login)) {
      Utils::addErrorMessage('Nie podano loginu');
    }
    if(empty($this->form->password)) {
      Utils::addErrorMessage('Nie podano hasła');
    }

    if(App::getMessages()->isError()){
      return false;
    }

    try{
      $this->users = App::getDB()->select('users', ['login','password']);
      $this->checkIfUserIsActive = App::getDB()->get('users', ['is_active'], ['login' => $this->form->login]);
    }
    catch(\PDOException $e){
        Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
        if (App::getConf()->debug){
            Utils::addErrorMessage($e->getMessage());
        }      
    }

    foreach($this->users as $u){
      if($this->form->login == $u['login'] && password_verify($this->form->password, $u['password'])){ // passwordVerify sprawdza czy haslo zgadza sie z zahaszowanym haslem w bazie - POLE W BAZIE HASLO MA MIEC VARCHAR - DLUGOSC 255

        if($this->checkIfUserIsActive['is_active'] == 0){
          Utils::addErrorMessage('To konto już nie istnieje');
          return false;
        }
        else{
          return !App::getMessages()->isError();
        }
      }
    }

    Utils::addErrorMessage('Niepoprawny login lub hasło');
    return false;
  }

  public function action_loginView(){
    $this->generateView();
  }

  public function action_login() {
    if($this->validate()){

      try{
        $this->idUser = App::getDB()->get('users', ['id_user'], ['login' => $this->form->login]);

        $this->roles = App::getDB()->select('user_role', ['[><]roles' => ['id_role' => 'id_role']], ['role'], ['AND' => ['id_user' => $this->idUser, 'roles.is_activated' => 1, 'user_role.is_activated' => 1]]);
      }
      catch(\PDOException $e){
          Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
          if (App::getConf()->debug){
              Utils::addErrorMessage($e->getMessage());
          }      
      }

      foreach($this->roles as $r){
        RoleUtils::addRole($r['role']);
      }

      SessionUtils::store('userId', $this->idUser['id_user']);

      App::getRouter()->redirectTo("mainView");
    }
    else{
      $this->generateView(); // zostajesz na stronie log jak sie nie zalogujesz
    }
  }

  public function action_logout() {
    session_destroy();
    App::getRouter()->redirectTo('mainView');
  }

  public function generateView(){
    App::getSmarty()->assign('form', $this->form);

    App::getSmarty()->assign('windowTitle','Logowanie');
    App::getSmarty()->assign('title','Logowanie');
    App::getSmarty()->assign('buttonText','Zaloguj się');

    App::getSmarty()->display("logView.tpl");
  }
 
}