<?php

namespace app\controllers;

use core\App;

class RegCtrl {
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