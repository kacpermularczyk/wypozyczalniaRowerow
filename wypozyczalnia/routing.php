<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('mainView'); #default action
//App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('mainView', 'MainCtrl');
//Utils::addRoute('action_name', 'controller_class_name');

Utils::addRoute('loginView', 'LogCtrl');
Utils::addRoute('registerView', 'RegCtrl');
Utils::addRoute('reservationView', 'ReservCtrl');

Utils::addRoute('login', 'LogCtrl');
Utils::addRoute('logout', 'LogCtrl');