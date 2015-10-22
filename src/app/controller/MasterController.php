<?php

namespace controller;


require_once("app/model/Service.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");
require_once("app/model/Pub.php");
require_once("app/view/AddBeerView.php");
require_once("app/view/HomeView.php");
require_once("app/controller/BeerController.php");
require_once("app/view/NavigationView.php");
require_once("app/view/LayoutView.php");

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