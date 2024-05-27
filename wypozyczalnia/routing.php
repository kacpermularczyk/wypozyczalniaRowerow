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
Utils::addRoute('addBikeView', 'ForWorkerCtrl');
Utils::addRoute('deleteBikeView', 'ForWorkerCtrl');
Utils::addRoute('editBikeView', 'ForWorkerCtrl');
Utils::addRoute('deleteUserView', 'ForAdminCtrl');
Utils::addRoute('addRoleToUserView', 'ForAdminCtrl');
Utils::addRoute('disableRoleToUserView', 'ForAdminCtrl');
Utils::addRoute('addRoleView', 'ForAdminCtrl');
Utils::addRoute('disableRoleView', 'ForAdminCtrl');

Utils::addRoute('login', 'LogCtrl');
Utils::addRoute('logout', 'LogCtrl');
Utils::addRoute('register', 'RegCtrl');
Utils::addRoute('addBike', 'ForWorkerCtrl');
Utils::addRoute('deleteBike', 'ForWorkerCtrl');
Utils::addRoute('editBike', 'ForWorkerCtrl');
Utils::addRoute('deleteUser', 'ForAdminCtrl');
Utils::addRoute('addRoleToUser', 'ForAdminCtrl');
Utils::addRoute('disableRoleToUser', 'ForAdminCtrl');
Utils::addRoute('addRole', 'ForAdminCtrl');
Utils::addRoute('disableRole', 'ForAdminCtrl');