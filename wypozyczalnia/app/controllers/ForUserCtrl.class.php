<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use core\SessionUtils;
use app\forms\FilterForm;

class ForUserCtrl{
    public function __construct(){
        $this->form = new FilterForm();
    }
    public function action_userRentalsView(){
        $this->generateRentalView();
    }
    public function generateRentalView(){
        $this->userId = (int)SessionUtils::load('userId', $keep = true);

        try {
            $this->rentals = App::getDB()->select("rentals",["[><]bikes" =>["id_bike" => "id_bike"], "[><]users" => ["id_user" => "id_user"]],["model", "date_start", "date_end", "login", "id_rental", "returned_in_term", "not_returned_in_term"], [ 'AND' => ["accepted" => 1, "rentals.id_user" => $this->userId]]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('rentals', $this->rentals);

        App::getSmarty()->assign('windowTitle','widok zamówień');
        App::getSmarty()->display("rentalViewForUser.tpl");
    }
    public function action_rentalsOnlyUser(){
        $this->form->filter = (int)ParamUtils::getFromRequest('filter');
        $this->userId = (int)SessionUtils::load('userId', $keep = true);

        try {
            $this->rentals = App::getDB()->select("rentals",["[><]bikes" =>["id_bike" => "id_bike"], "[><]users" => ["id_user" => "id_user"]],["model", "date_start", "date_end", "login", "id_rental", "returned_in_term", "not_returned_in_term"], [ 'AND' => ["accepted" => 1, "rentals.id_user" => $this->userId], 'LIMIT' => $this->form->filter]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('rentals', $this->rentals);

        App::getSmarty()->display("userRentalsTable.tpl");
    }
}