<?php

require_once("src/app/controller/MasterController.php");

if (Settings::DEBUG_MODE) {
    ini_set('display_errors','On');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}



$mc = new \controller\MasterController();


$mc->run();

