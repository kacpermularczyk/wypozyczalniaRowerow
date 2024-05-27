<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\BikeForm;

class ForWorkerCtrl{
    private $form;
    private $models;

    public function __construct() {
        $this->form = new BikeForm();
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
        if((!(empty(trim($this->form->picture)))) && (!(substr($this->form->picture, -3) == 'png' || substr($this->form->picture, -3) == 'jpg'))){
            Utils::addErrorMessage('Błędny format pliku, aplikacja obsługuje tylko png lub jpg');
        }

        if (App::getMessages()->isError()){
            return false;
        }

        // Proste sprawdzanie czy dany model juz instnieje !UZYWAC SELECT ZAMIAST GET - GET DO 1 WIERSZA! 

        try{
            $this->models = App::getDB()->select('bikes', ['model']);
        }
        catch(\PDOException $e){
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }      
        }

        foreach($this->models as $m){
            if($this->form->model == $m['model']){
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
                App::getDB()->insert("bikes", ["model" => $this->form->model, "description" => $this->form->description, "price" => $this->form->price, "id_type" => $this->form->bikeType, "picture" => $this->form->picture]);
            }
            catch (\PDOException $e){
                Utils::addErrorMessage('Wystąpił błąd podczas zapisu danych');
                if (App::getConf()->debug){
                    Utils::addErrorMessage($e->getMessage());
                }      
            }
        }
        $this->generateViewForAddBike();
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

    

    public function validateForDelete(){
        $this->form->model = ParamUtils::getFromRequest('model');

        if (empty(trim($this->form->model))) {
            Utils::addErrorMessage('Wprowadź typ roweru');
        }
        if (App::getMessages()->isError()){
            return false;
        }
        return !App::getMessages()->isError();
    }
    public function action_deleteBike(){
        if($this->validateForDelete()){
            try {
                App::getDB()->delete("bikes", ["id_bike" => $this->form->model]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateViewForDeleteBike();
    }
    public function action_deleteBikeView(){
        $this->generateViewForDeleteBike();
    }
    public function generateViewForDeleteBike(){
        try {
            $this->bikes = App::getDB()->select("bikes", ["id_bike", "model",]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('bikes', $this->bikes);

        App::getSmarty()->assign('windowTitle','Usuwanie rowerow');
        App::getSmarty()->assign('title','Usuń rower');
        App::getSmarty()->assign('buttonText','Usuń');
        
        App::getSmarty()->display("deleteBikeView.tpl");
    }




    //EDYTOWANIE



    public function validateForEdit(){
        $this->form->id = ParamUtils::getFromRequest('bikeToChange');

        if (empty(trim($this->form->id))) {
            Utils::addErrorMessage('Wprowadź rower do zmiany');
        }
        if (App::getMessages()->isError()){
            return false;
        }
        return !App::getMessages()->isError();
    }
    public function action_editBike(){
        if($this->validateForEdit() && $this->validate()){
            try {
                App::getDB()->update("bikes", ["model" => $this->form->model,"description" => $this->form->description,"price" => $this->form->price,"picture" => $this->form->picture, "id_type" => $this->form->bikeType], ["id_bike" => $this->form->id]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateViewForEditBike();
        }
    public function action_editBikeView(){
        $this->generateViewForEditBike();
    }
    public function generateViewForEditBike(){
        try {
            $this->bikes = App::getDB()->select("bikes", ["id_bike", "model",]);
            $this->types = App::getDB()->select("types_of_bikes", ["id_type", "type",]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('bikes', $this->bikes);
        App::getSmarty()->assign('types', $this->types);

        App::getSmarty()->assign('windowTitle','Edytowanie rowerow');
        App::getSmarty()->assign('title','Edytuj rower');
        App::getSmarty()->assign('buttonText','Edytuj');
        
        App::getSmarty()->display("editBikeView.tpl");
    }
}