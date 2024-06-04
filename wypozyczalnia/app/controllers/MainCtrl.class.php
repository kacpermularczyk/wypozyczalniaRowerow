<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class MainCtrl {
    private $bikes;

    public function action_mainView(){
        try {
            $this->bikes = App::getDB()->select("bikes",["[><]types_of_bikes" =>["id_type" => "id_type"]],["model","price","type","picture"], ["is_active" => 1]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania informacji z bazy danych');
            if (App::getConf()->debug){
                Utils::addErrorMessage($e->getMessage());
            }
        }

        $this->generateView();
    }
    public function generateView(){
        App::getSmarty()->assign('bikes', $this->bikes); //do bd

        App::getSmarty()->assign('windowTitle','Strona glowna');
        App::getSmarty()->assign('firstTitle','Wypożyczalnia rowerów');
        App::getSmarty()->assign('secondTitle','Sosnowiec, Ulicowska 5');

        App::getSmarty()->assign('person1','Marta, Sosnowiec');
        App::getSmarty()->assign('person2','Kamil, Katowice');
        App::getSmarty()->assign('person3','Julia, Warszawa');
        App::getSmarty()->assign('person4','Andrzej, Sosnowiec');
        App::getSmarty()->assign('person5','Wiktoria, Gdynia');

        App::getSmarty()->assign('description1','"Bardzo dobra jakość rowerów, bardzo polecam."');
        App::getSmarty()->assign('description2','"Wypożyczenie na jeden dzień, ceny są rozsądne."');
        App::getSmarty()->assign('description3','"Przyjazni pracownicy, pomocne wskazówki."');
        App::getSmarty()->assign('description4','"Rowery są nowe, ale potrzebują czyszczenia."');
        App::getSmarty()->assign('description5','"Wypożyczenie bezproblemowe, polecam!"');

        App::getSmarty()->display("mainView.tpl");
    }
}
