<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use app\forms\BikesFilteringForm;

class ReservCtrl{
    private $form;
    private $bikes;
    private $types;

    public function __construct(){
        $this->form = new BikesFilteringForm();
    }
    public function validate() {
        $this->form->category = ParamUtils::getFromRequest('category'); // walidacja tu jest useless, ale na wypadek rozbudowy osobna funkcja
        return !App::getMessages()->isError();
    }
    public function action_reservationView(){
        $this->validate();

        try {
            $this->bikes = App::getDB()->select("bikes",["[><]types_of_bikes" =>["id_type" => "id_type"]],["model","description","price","picture","type"], ["bikes.id_type[~]" => $this->form->category]);
            $this->types = App::getDB()->select("types_of_bikes", ["id_type", "type",]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('bikes', $this->bikes);
        App::getSmarty()->assign('types', $this->types);
        $this->generateView();
    }
    public function generateView(){
        App::getSmarty()->assign('windowTitle','Rezerwacja');
        
        App::getSmarty()->display("reservView.tpl");
    }
}