<?php

namespace controller;


require_once("src/app/model/Service.php");
require_once("config/Settings.php");
require_once("src/app/model/Beer.php");
require_once("src/app/model/Pub.php");
require_once("src/app/view/AddBeerView.php");
require_once("src/app/view/HomeView.php");
require_once("src/app/controller/BeerController.php");
require_once("src/app/view/NavigationView.php");
require_once("src/app/view/LayoutView.php");

/**
 * Class MasterController
 * Main entry point for the app. Does not implement the IController-interface
 * since it does not need to return any views.
 * @package controller
 */

class MasterController {

    public function run() {
        $navView = new \view\NavigationView();
        $layoutView = new \view\LayoutView($navView);

        $beer = new \model\Beer("Punk IPA", 5.6, "Brewdog", "Skottland", 33, "Flaska");
        $bDAL = new \model\BeerDAL();
        $bDAL->addBeer($beer);

        if ($navView->userWantsToAddBeer()) {
            $view = new \view\AddBeerView();
            $controller = new \controller\BeerController($view);
            $html = $controller->getView()->response();

        } else {
            $view = new \view\HomeView();
            $html = $view->response();
        }


        $layoutView->render($html);

    }
}