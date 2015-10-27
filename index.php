<?php
require_once("src/app/controller/IController.php");

require_once("src/app/view/IView.php");

require_once("src/app/controller/MasterController.php");



if (Settings::DEBUG_MODE) {
    ini_set('display_errors','On');
    error_reporting(E_ALL);
}

$mc = new \controller\MasterController();

$mc->run();

