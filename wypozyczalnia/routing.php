<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('mainView'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('mainView', 'MainCtrl');
//Utils::addRoute('action_name', 'controller_class_name');

Utils::addRoute('loginView', 'LogCtrl');
Utils::addRoute('registerView', 'RegCtrl');
Utils::addRoute('reservationView', 'ReservCtrl');

Utils::addRoute('bikesOnly', 'ReservCtrl'); //AJAX
Utils::addRoute('tableOnly', 'ForAdminCtrl', ['admin']); //AJAX
Utils::addRoute('rentalsOnly', 'ForWorkerCtrl', ['worker']); //AJAX
Utils::addRoute('rentalsOnlyUser', 'ForUserCtrl', ['worker']); //AJAX
Utils::addRoute('rentalsToAcceptOnly', 'ForWorkerCtrl', ['worker']); //AJAX

Utils::addRoute('addBikeView', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('deleteBikeView', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('editBikeView', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('deleteUserView', 'ForAdminCtrl', ['admin']);
Utils::addRoute('addRoleToUserView', 'ForAdminCtrl', ['admin']);
Utils::addRoute('disableRoleToUserView', 'ForAdminCtrl', ['admin']);
Utils::addRoute('addRoleView', 'ForAdminCtrl', ['admin']);
Utils::addRoute('disableRoleView', 'ForAdminCtrl', ['admin']);
Utils::addRoute('acceptRentalsView', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('rentalsView', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('userRentalsView', 'ForUserCtrl', ['user']);
Utils::addRoute('adminPanelView', 'ForAdminCtrl', ['admin']);

Utils::addRoute('login', 'LogCtrl');
Utils::addRoute('logout', 'LogCtrl', ['user']);
Utils::addRoute('register', 'RegCtrl');
Utils::addRoute('addBike', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('deleteBike', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('editBike', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('deleteUser', 'ForAdminCtrl', ['admin']);
Utils::addRoute('addRoleToUser', 'ForAdminCtrl', ['admin']);
Utils::addRoute('disableRoleToUser', 'ForAdminCtrl', ['admin']);
Utils::addRoute('addRole', 'ForAdminCtrl', ['admin']);
Utils::addRoute('disableRole', 'ForAdminCtrl', ['admin']);
Utils::addRoute('reservation', 'ReservCtrl', ['user']);

Utils::addRoute('accept', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('decline', 'ForWorkerCtrl', ['worker']);

Utils::addRoute('inTerm', 'ForWorkerCtrl', ['worker']);
Utils::addRoute('notInTerm', 'ForWorkerCtrl', ['worker']);