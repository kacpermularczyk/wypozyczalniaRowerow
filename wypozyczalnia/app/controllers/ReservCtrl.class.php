<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;
use app\forms\SearchForm;
use app\forms\ReservationForm;

class ReservCtrl{
    private $form;

    public function __construct(){
        $this->form = new SearchForm();
        $this->reservation = new ReservationForm();
    }
    public function validate() {
        $this->form->search = ParamUtils::getFromRequest('search'); // walidacja tu jest useless, ale na wypadek rozbudowy osobna funkcja
        return !App::getMessages()->isError();
    }
    public function loadData(){
        $this->validate(); // skoro walidacja jest ueless to nie daje w ifie tylko wywoluje zeby miec zmienna do warunkow w WHERE

        try {
            $this->bikes = App::getDB()->select("bikes",["[><]types_of_bikes" =>["id_type" => "id_type"]],["id_bike","model","description","price","picture","type", "bike_condition"], [ "AND" => ["OR" => ["model[~]" => $this->form->search."%", "type[~]" => $this->form->search."%", "price[~]" => $this->form->search."%"], "is_active" => 1]]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
    }
    public function action_reservationView(){
        $this->loadData();

        App::getSmarty()->assign('bikes', $this->bikes);
        $this->generateView();
    }
    public function generateView(){
        App::getSmarty()->assign('windowTitle','Rezerwacja');
        
        App::getSmarty()->display("reservView.tpl");
    }
    public function action_bikesOnly(){
        $this->loadData();

        App::getSmarty()->assign('bikes', $this->bikes);
        App::getSmarty()->display("bikesList.tpl");
    }





    //rezerwacja




    public function reservationValidate(){
        $this->reservation->model = ParamUtils::getFromRequest('modelToReserv');
        $this->reservation->dateStart = ParamUtils::getFromRequest('dateStart');
        $this->reservation->dateEnd = ParamUtils::getFromRequest('dateEnd');

        if (empty(trim($this->reservation->model))) {
            Utils::addErrorMessage('Wprowadź model');
        }
        if (empty(trim($this->reservation->dateStart))) {
            Utils::addErrorMessage('Wprowadź date od kiedy');
        }
        if (empty(trim($this->reservation->dateEnd))) {
            Utils::addErrorMessage('Wprowadź date do kiedy');
        }

        if (App::getMessages()->isError()){
            return false;
        }
        
        $this->currentDate = date('Y/m/d H:i:s');
        $this->reservation->dateStart = date('Y/m/d H:i:s', strtotime($this->reservation->dateStart));
        $this->reservation->dateEnd = date('Y/m/d H:i:s', strtotime($this->reservation->dateEnd));

        if($this->currentDate > $this->reservation->dateStart || $this->currentDate > $this->reservation->dateEnd){
            Utils::addErrorMessage('Zła data rezerwacji');
            return false;
        }
        if($this->reservation->dateEnd < $this->reservation->dateStart){
            Utils::addErrorMessage('Zła data rezerwacji');
            return false;
        }

        try {
            $this->bikeCondition = App::getDB()->get('bikes', ['bike_condition'], ['model' => $this->reservation->model]);
            $this->bikeId = App::getDB()->get('bikes', ['id_bike'], ['model' => $this->reservation->model]);
            $this->models = App::getDB()->select('bikes', ['model']);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        
        foreach($this->models as $m){
            if($this->reservation->model == $m['model']){
                if($this->bikeCondition['bike_condition'] != "Dostępny"){
                    Utils::addErrorMessage('Ten rower obecnie nie jest dostępny');
                    return false;
                }
                else{
                    return !App::getMessages()->isError();
                }
            }
        }
        
        Utils::addErrorMessage('W ofercie nie ma takiego roweru');
        return false;

    }
    public function action_reservation(){
        if($this->reservationValidate()){
            try {
                $this->userId = SessionUtils::load('userId', $keep = true);
                App::getDB()->insert("rentals", ["id_bike" => $this->bikeId['id_bike'], "id_user" => $this->userId, "date_start" => $this->reservation->dateStart, "date_end" => $this->reservation->dateEnd, "accepted" => 0, "returned_in_term" => 0, "not_returned_in_term" => 0]);
            }
            catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas wpisywania informacji do bazy danych');
                if (App::getConf()->debug){
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            $this->action_reservationView();
        }
        else{
            $this->action_reservationView();
        }
    }
}