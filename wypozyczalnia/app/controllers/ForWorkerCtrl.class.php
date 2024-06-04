<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use core\SessionUtils;
use app\forms\BikeForm;
use app\forms\SearchForm;
use app\forms\FilterForm;

class ForWorkerCtrl{
    private $form;
    private $models;
    private $searchForm;

    public function __construct() {
        $this->form = new BikeForm();
        $this->searchForm = new searchForm();
        $this->filterForm = new FilterForm();
    }

    public function validate(){
        $v = new Validator();

        $this->form->model = $v->validateFromRequest('model', ['min_length' => 5, 'max_length' => 30, 'validator_message' => 'Model ma mieć od 5 do 30 znaków']);
        $this->form->description = $v->validateFromRequest('description', ['min_length' => 10, 'max_length' => 300, 'validator_message' => 'Opis ma mieć od 10 do 300 znaków']);
        $this->form->price = $v->validateFromRequest('price', ['numeric' => true, 'validator_message' => 'Cena musi być liczbą']);
        $this->form->bikeType = ParamUtils::getFromRequest('bikeType');
        $this->form->picture = ParamUtils::getFromRequest('picture');

        if (App::getMessages()->isError()){
            return false;
        }

        if (empty(trim($this->form->model))) {
            Utils::addErrorMessage('Wprowadź model');
        }
        if (empty(trim($this->form->description))) {
            Utils::addErrorMessage('Wprowadź opis');
        }
        if (empty(trim($this->form->price))) {
            Utils::addErrorMessage('Wprowadź cenę');
        }
        if (empty(trim($this->form->bikeType))) {
            Utils::addErrorMessage('Wprowadź typ roweru');
        }
        if (empty(trim($this->form->picture))) {
            Utils::addErrorMessage('Wprowadź zdjęcie');
        }
        if((!(empty(trim($this->form->picture)))) && (!(substr($this->form->picture, -4) == '.png' || substr($this->form->picture, -4) == '.jpg' || substr($this->form->picture, -4) == 'jpeg'))){
            Utils::addErrorMessage('Błędny format pliku, aplikacja obsługuje tylko png, jpg lub jpeg');
        }

        if (App::getMessages()->isError()){
            return false;
        }

        // Proste sprawdzanie czy dany model juz instnieje !UZYWAC SELECT ZAMIAST GET - GET DO 1 WIERSZA! 

        try{
            $this->models = App::getDB()->select('bikes', ['id_bike','model']);
        }
        catch(\PDOException $e){
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }      
        }

        foreach($this->models as $m){
            if($this->form->model == $m['model'] && $this->form->id != $m['id_bike']){
                Utils::addErrorMessage('Istnieje już taki model');
                return false;
            }
        }

        //DO TAD

        return !App::getMessages()->isError();
    }

    public function action_addBike(){
        if($this->validate())
        {
            try{
                App::getDB()->insert("bikes", ["model" => $this->form->model, "description" => $this->form->description, "price" => $this->form->price, "id_type" => $this->form->bikeType, "picture" => $this->form->picture, "bike_condition" => "Dostępny", "is_active" => 1]);
            }
            catch (\PDOException $e){
                Utils::addErrorMessage('Wystąpił błąd podczas zapisu danych');
                if (App::getConf()->debug){
                    Utils::addErrorMessage($e->getMessage());
                }      
            }
            App::getRouter()->redirectTo("reservationView");
        }
        else{
            $this->generateViewForAddBike();
        }
    }
    public function action_addBikeView(){
        $this->generateViewForAddBike();
    }
    public function generateViewForAddBike(){
        try {
            $this->types = App::getDB()->select("types_of_bikes", ["id_type", "type",]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('types', $this->types);

        App::getSmarty()->assign('windowTitle','Dodawanie rowerow');
        App::getSmarty()->assign('title','Dodaj rower');
        App::getSmarty()->assign('buttonText','Dodaj');
        
        App::getSmarty()->display("addBikeView.tpl");
    }

    


    //USUWANIE

    public function action_deleteBike(){
        $this->form->id = ParamUtils::getFromRequest('bikeToDel');
        try {
            App::getDB()->update("bikes", ["is_active" => 0], ["id_bike" => $this->form->id]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getRouter()->redirectTo("reservationView");
    }



    //EDYTOWANIE



    public function action_editBike(){
        $this->form->id = SessionUtils::load('idToEdit', $keep = true);
        if($this->validate()){
            try {
                App::getDB()->update("bikes", ["model" => $this->form->model,"description" => $this->form->description,"price" => $this->form->price,"picture" => $this->form->picture, "id_type" => $this->form->bikeType], ["id_bike" => $this->form->id]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas edytowania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            SessionUtils::remove('idToEdit');
            App::getRouter()->redirectTo("reservationView");
        }
        else{
            $this->generateViewForEditBike();
        }
    }
    public function action_editBikeView(){
        SessionUtils::store('idToEdit', ParamUtils::getFromRequest('bikeToEdit'));

        $this->generateViewForEditBike();
    }
    public function generateViewForEditBike(){
        try {
            $this->types = App::getDB()->select("types_of_bikes", ["id_type", "type",]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('types', $this->types);

        App::getSmarty()->assign('windowTitle','Edytowanie rowerow');
        App::getSmarty()->assign('title','Edytuj rower');
        App::getSmarty()->assign('buttonText','Edytuj');
        
        App::getSmarty()->display("editBikeView.tpl");
    }


    // TUTAJ WIDOK ZAMÓWIEN DO AKCEPTACJI


    public function action_accept(){
        $this->idRental = ParamUtils::getFromRequest('acceptButton');
        try {
            App::getDB()->update("rentals", ["accepted" => 1], ["id_rental" => $this->idRental]);
            $this->idBike = App::getDB()->get("rentals", ["id_bike"], ["id_rental" => $this->idRental]);
            App::getDB()->update("bikes", ["bike_condition" => "Zarezerwowany"], ["id_bike" => $this->idBike]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateViewForRentalToAccept();
    }
    public function action_decline(){
        $this->idRental = ParamUtils::getFromRequest('declineButton');
        try {
            App::getDB()->delete("rentals", ["id_rental" => $this->idRental]);
            
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateViewForRentalToAccept();
    }

    public function action_acceptRentalsView(){
        $this->generateViewForRentalToAccept();
    }
    public function generateViewForRentalToAccept(){
        try {
            $this->rentals = App::getDB()->select("rentals",["[><]bikes" =>["id_bike" => "id_bike"], "[><]users" => ["id_user" => "id_user"]],["model", "date_start", "date_end", "login", "id_rental"], [ 'AND' => ["accepted" => 0, 'returned_in_term' => 0, 'not_returned_in_term' => 0]]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('rentals', $this->rentals);

        App::getSmarty()->assign('windowTitle','widok zamówień akceptacja');
        App::getSmarty()->display("rentalToAcceptView.tpl");
    }
    public function action_rentalsToAcceptOnly(){
        $this->filterForm->filter = ParamUtils::getFromRequest('filter');
        try {
            $this->rentals = App::getDB()->select("rentals",["[><]bikes" =>["id_bike" => "id_bike"], "[><]users" => ["id_user" => "id_user"]],["model", "date_start", "date_end", "login", "id_rental"], [ 'AND' => ["accepted" => 0, 'returned_in_term' => 0, 'not_returned_in_term' => 0], 'LIMIT' => $this->filterForm->filter]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('rentals', $this->rentals);
        App::getSmarty()->display("rentalToAcceptTable.tpl");
    }

    // TUTAJ WIDOK ZAMÓWIEN ZAAKCEPTOWANYCH

    public function loadRentals(){
        $this->searchForm->search = ParamUtils::getFromRequest('search');
        try {
            $this->rentals = App::getDB()->select("rentals",["[><]bikes" =>["id_bike" => "id_bike"], "[><]users" => ["id_user" => "id_user"]],["model", "date_start", "date_end", "login", "id_rental"], [ 'AND' => ["accepted" => 1, 'returned_in_term' => 0, 'not_returned_in_term' => 0, "OR" => ["login[~]" => $this->searchForm->search."%", "model[~]" => $this->searchForm->search."%"]]]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
    }
    public function action_rentalsView(){
        $this->generateRentalView();
    }
    public function generateRentalView(){
        $this->loadRentals();

        App::getSmarty()->assign('rentals', $this->rentals);

        App::getSmarty()->assign('windowTitle','widok zamówień');
        App::getSmarty()->display("rentalView.tpl");
    }
    public function action_rentalsOnly(){
        $this->loadRentals();

        App::getSmarty()->assign('rentals', $this->rentals);
        App::getSmarty()->display("rentalViewTable.tpl");
    }


    //////

    public function action_inTerm(){
        $this->idRental = ParamUtils::getFromRequest('yes');
        try {
            App::getDB()->update("rentals", ["returned_in_term" => 1], ["id_rental" => $this->idRental]);
            
            $this->idBike = App::getDB()->get("rentals", ["id_bike"], ["id_rental" => $this->idRental]);
            App::getDB()->update("bikes", ["bike_condition" => "Dostępny"], ["id_bike" => $this->idBike]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateRentalView();
    }

    public function action_notInTerm(){
        $this->idRental = ParamUtils::getFromRequest('no');
        try {
            App::getDB()->update("rentals", ["not_returned_in_term" => 1], ["id_rental" => $this->idRental]);

            $this->idBike = App::getDB()->get("rentals", ["id_bike"], ["id_rental" => $this->idRental]);
            App::getDB()->update("bikes", ["bike_condition" => "Dostępny"], ["id_bike" => $this->idBike]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateRentalView();
    }
}