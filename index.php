<?php

require_once("app/controller/MasterController.php");

error_reporting(E_ALL);
ini_set('display_errors', 'On');


$mc = new \controller\MasterController();

$mc->run();






