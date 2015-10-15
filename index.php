<?php

require_once("src/controller/MasterController.php");

error_reporting(E_ALL);
ini_set('display_errors', 'On');


$mc = new \controller\MasterController();

$mc->run();






