<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use core\SessionUtils;
use app\forms\DeleteUserForm;
use app\forms\RolesForm;
use app\forms\SearchForm;

class ForAdminCtrl{
    private $form;
    private $rolesForm;
    private $searchForm;

    public function __construct() {
        $this->form = new DeleteUserForm();
        $this->rolesForm = new RolesForm();
        $this->searchForm = new SearchForm();
    }

    //Widok panelu dla admina

    public function loadData(){
        $this->searchForm->search = ParamUtils::getFromRequest('search');
        try {
            $this->dataToLoad = App::getDB()->select("user_role",["[><]users" =>["id_user" => "id_user"], "[><]roles" =>["id_role" => "id_role"]],["login", "role", "active_since", "active_until", "is_active", "roles.id_role", "users.id_user","user_role.is_activated"], ["OR" => ["login[~]" => $this->searchForm->search."%", "role[~]" => $this->searchForm->search."%"]]);

            $this->roles = App::getDB()->select("roles", ["id_role", "role"], ['is_activated' => 1]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
    }
    public function action_adminPanelView(){
        $this->generateViewForAdminPanel();
    }
    public function generateViewForAdminPanel(){
        $this->loadData();

        App::getSmarty()->assign('data',$this->dataToLoad);
        App::getSmarty()->assign('roles',$this->roles);

        App::getSmarty()->assign('windowTitle','Panel admina');

        App::getSmarty()->display("adminPanelView.tpl");
    }

    //wyszukiwanie

    public function action_tableOnly(){
        $this->loadData();

        App::getSmarty()->assign('data',$this->dataToLoad);
        App::getSmarty()->assign('roles',$this->roles);
        App::getSmarty()->display("adminTable.tpl");
    }

    //Dodawanie roli do systemu (lub gdy wystepuje - aktywacja)
    
    public function validateForAddRole(){
        $this->rolesForm->newRole = ParamUtils::getFromRequest('newRole');

        if (empty(trim($this->rolesForm->newRole))) {
            Utils::addErrorMessage('Wprowadź role');
        }
        if (App::getMessages()->isError()){
            return false;
        }

        return !App::getMessages()->isError();
    }
    public function action_addRole(){ //jak wczesniej byla o takiej nazwie to ja znowu uaktywniam
        if($this->validateForAddRole()){
            try{
                $this->checkIfRoleIsAlready = App::getDB()->get("roles", ["role"], ["role" => $this->rolesForm->newRole]);

                if($this->checkIfRoleIsAlready != NULL){
                    App::getDB()->update("roles", ["is_activated" => 1], ['role' => $this->rolesForm->newRole]);
                }
                else{
                    App::getDB()->insert("roles", ["role" => $this->rolesForm->newRole, "is_activated" => 1]);
                }
            }
            catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas dodawania informacji do bazy danych');
                if (App::getConf()->debug){
                    Utils::addErrorMessage($e->getMessage());
                }
            }
        }
        $this->generateViewForAdminPanel();
    }

    //Usuwanie roli z systemu (dezaktywacja)


    public function validateForDisableRole(){
        $this->rolesForm->idRole = ParamUtils::getFromRequest('roles');

        if (empty(trim($this->rolesForm->idRole))) {
            Utils::addErrorMessage('Wprowadź role');
        }
        if (App::getMessages()->isError()){
            return false;
        }

        return !App::getMessages()->isError();
    }
    public function action_disableRole(){
        if($this->validateForDisableRole()){
            try{
                App::getDB()->update("roles", ["is_activated" => 0], ['id_role' => $this->rolesForm->idRole]);
            }
            catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas aktualizacji informacji w bazie danych');
                if (App::getConf()->debug){
                    Utils::addErrorMessage($e->getMessage());
                }
            }
        }
        $this->generateViewForAdminPanel();
    }


    //Usuwanie usera

    public function action_deleteUser(){
        $this->form->id = ParamUtils::getFromRequest('userId');
        $this->adminId = SessionUtils::load('userId', $keep = true);
        try {
            App::getDB()->update("users", ["is_active" => 0, "who_modified" => $this->adminId], ["id_user" => $this->form->id]);
            
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        
        $this->generateViewForAdminPanel();
    }


    //dodawanie roli userowi

    public function getDbRecords(){ //uniwersalne do dodawania roli i zabierania
        try{
            $this->roles = App::getDB()->select('roles', ['id_role', 'role']);
            $this->users = App::getDB()->select('users', ['id_user', 'login']);
        }
        catch(\PDOException $e){
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }      
        }

        App::getSmarty()->assign('users',$this->users);
        App::getSmarty()->assign('roles',$this->roles);
    }
    public function action_addRoleToUser(){
        $this->rolesForm->idRole = ParamUtils::getFromRequest('roles');
        $this->rolesForm->idUser = ParamUtils::getFromRequest('userId');

        $this->currentDate = date('Y/m/d H:i:s');

        try{
            App::getDB()->insert("user_role", ["id_user" => $this->rolesForm->idUser, "id_role" => $this->rolesForm->idRole, "active_since" => $this->currentDate, "active_until" => NULL, "is_activated" => 1]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas wpisywania informacji do bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
    
        $this->generateViewForAdminPanel();
    }

    //Usuwanie roli userowi (dezaktywacja)

    public function action_disableRoleToUser(){
        $this->rolesForm->idRole = ParamUtils::getFromRequest('roles');
        $this->rolesForm->idUser = ParamUtils::getFromRequest('userId');

        $this->currentDate = date('Y/m/d H:i:s');

        try{
            App::getDB()->update("user_role", ["is_activated" => 0, "active_until" => $this->currentDate], ['AND' => ['id_user' => $this->rolesForm->idUser, 'id_role' => $this->rolesForm->idRole]]);
        }
        catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas aktualizacji informacji w bazie danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }
        
        $this->generateViewForAdminPanel();
    }
}