<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\RoleUtils;
use core\ParamUtils;
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

    if(App::getMessages()->isError())
        return false;

    if($this->form->login == "admin" && $this->form->password == "admin"){ //tutaj pozniej zamienic na bd
        RoleUtils::addRole('admin');
    } else if ($this->form->login == "user" && $this->form->password == "user"){
        RoleUtils::addRole('user');
    } else{
        Utils::addErrorMessage('Niepoprawny login lub hasło');
    }

    return !App::getMessages()->isError();
  }

  public function action_loginView(){
    $this->generateView();
  }

  public function action_login() {
    if ($this->validate()){
        App::getRouter()->redirectTo("mainView");
    } else {
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