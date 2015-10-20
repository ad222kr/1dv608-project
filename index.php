<?php

require_once("app/controller/IController.php");
require_once("app/view/IView.php");
require_once("app/controller/MasterController.php");
require_once("app/view/NavigationView.php");
require_once("app/view/LayoutView.php");

error_reporting(E_ALL);
ini_set('display_errors', 'On');


echo "test";
$nv = new \view\NavigationView();
$lv = new \view\LayoutView($nv);
$mc = new \controller\MasterController($nv);

$mc->doControl();
$currentView = $mc->getView();



$lv->render($currentView->render());







