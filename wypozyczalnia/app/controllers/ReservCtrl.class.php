<?php

namespace app\controllers;

use core\App;

class ReservCtrl{
    public function action_reservationView(){
        $this->generateView();
    }
    public function generateView(){
        App::getSmarty()->assign('windowTitle','Rezerwacja');
        
        App::getSmarty()->display("reservView.tpl");
    }
}