<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\DeleteUserForm;
use app\forms\RolesForm;

class ForAdminCtrl{
    private $form;
    private $rolesForm;

    public function __construct() {
        $this->form = new DeleteUserForm();
        $this->rolesForm = new RolesForm();
    }

    public function validateForDeleteUser(){
        $this->form->id = ParamUtils::getFromRequest('users');

        if (empty(trim($this->form->id))) {
            Utils::addErrorMessage('Wprowadź usera do usuniecia');
        }
        if (App::getMessages()->isError()){
            return false;
        }

        return !App::getMessages()->isError();
    }
    public function action_deleteUser(){
        if($this->validateForDeleteUser()){
            try {
                App::getDB()->update("users", ["who_modified" => NULL], ["id_user" => $this->form->id]);
                App::getDB()->delete("users", ["id_user" => $this->form->id]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateViewForDeleteUser();
    }
    public function action_deleteUserView(){
        $this->generateViewForDeleteUser();
    }
    public function generateViewForDeleteUser(){
        try {
            $this->users = App::getDB()->select("users", ["id_user", "login",]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        App::getSmarty()->assign('users', $this->users);

        App::getSmarty()->assign('windowTitle','Usuwanie usera');
        App::getSmarty()->assign('title','Usuń usera');
        App::getSmarty()->assign('buttonText','Usuń');

        App::getSmarty()->display("deleteUserView.tpl");
    }





    //Dodawanie roli user

    public function getDbRecords(){
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



    public function validateForAddOrDisableRole(){
        $this->rolesForm->idRole = ParamUtils::getFromRequest('roles');
        $this->rolesForm->idUser = ParamUtils::getFromRequest('users');

        if (empty(trim($this->rolesForm->idRole))) {
            Utils::addErrorMessage('Wprowadź role');
        }
        if (empty(trim($this->rolesForm->idUser))) {
            Utils::addErrorMessage('Wprowadź usera');
        }
        if (App::getMessages()->isError()){
            return false;
        }

        return !App::getMessages()->isError();
    }
    public function action_addRoleToUser(){
        if($this->validateForAddOrDisableRole()){

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
        }
        $this->generateViewForAddRoleToUser();
    }
    public function action_addRoleToUserView(){
        $this->generateViewForAddRoleToUser();
    }
    public function generateViewForAddRoleToUser(){
        $this->getDbRecords();

        App::getSmarty()->assign('windowTitle','Dodawanie ról');
        App::getSmarty()->assign('title','Dodaj rolę');
        App::getSmarty()->assign('buttonText','Dodaj');

        App::getSmarty()->display("addRoleToUserView.tpl");
    }



    //Wyłączanie roli user
    //korzystam z tej samej walidacji co w dodawaniu

    public function action_disableRoleToUser(){
        if($this->validateForAddOrDisableRole()){

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
        }
        $this->generateViewForDisableRoleToUser();
    }
    public function action_disableRoleToUserView(){
        $this->generateViewForDisableRoleToUser();
    }
    public function generateViewForDisableRoleToUser(){
        $this->getDbRecords();

        App::getSmarty()->assign('windowTitle','Wyłączanie ról');
        App::getSmarty()->assign('title','Wyłącz rolę');
        App::getSmarty()->assign('buttonText','Wyłącz');

        App::getSmarty()->display("disableRoleToUserView.tpl");
    }


    //Dezaktywacja roli w systemu


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
        $this->generateViewForDisableRole();
    }
    public function action_disableRoleView(){
        $this->generateViewForDisableRole();
    }
    public function generateViewForDisableRole(){
        try{
            $this->roles = App::getDB()->select('roles', ['id_role', 'role']);
        }
        catch(\PDOException $e){
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }      
        }

        App::getSmarty()->assign('roles',$this->roles);

        App::getSmarty()->assign('windowTitle','Wyłączanie ról');
        App::getSmarty()->assign('title','Wyłącz rolę');
        App::getSmarty()->assign('buttonText','Wyłącz');

        App::getSmarty()->display("disableRoleView.tpl");
    }


    //Dodawanie roli do systemu


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
    public function action_addRole(){
        if($this->validateForAddRole()){
            try{
                $this->checkIfRoleIsAlready = App::getDB()->get("roles", ["role"], ["role" => $this->rolesForm->newRole]);

                if($this->checkIfRoleIsAlready != NULL){
                    App::getDB()->update("roles", ["is_activated" => 1], ['role' => $this->rolesForm->newRole]);
                }
                else{
                    App::getDB()->insert("roles", ["role" => $this->rolesForm->newRole, "is_activated" => 1]);
                }

                App::getDB()->update("roles", ["is_activated" => 0], ['id_role' => $this->rolesForm->idRole]);
            }
            catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas dodawania informacji do bazy danych');
                if (App::getConf()->debug){
                    Utils::addErrorMessage($e->getMessage());
                }
            }
        }
        $this->generateViewForAddRole();
    }
    public function action_addRoleView(){
        $this->generateViewForAddRole();
    }
    public function generateViewForAddRole(){
        App::getSmarty()->assign('windowTitle','Dodawanie ról');
        App::getSmarty()->assign('title','Dodaj rolę');
        App::getSmarty()->assign('buttonText','Dodaj');

        App::getSmarty()->display("addRoleView.tpl");
    }
}


