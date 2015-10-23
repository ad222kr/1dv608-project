<?php
//TODO: fix DAL-classes so they work with the new tables, gonna have varchar as PK instead of int

require_once("src/app/controller/IController.php");
require_once("src/app/view/IView.php");
require_once("src/app/controller/MasterController.php");
//require_once("src/common/exceptions/BeerAlreadyExistsException.php");
//require_once("src/common/exceptions/BeerDoesNotExistException.php");

if (Settings::DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}

$mc = new \controller\MasterController();

$mc->run();

