<?php

namespace controller;

require_once("src/app/model/Service.php");
require_once("config/Settings.php");
require_once("src/app/model/Beer.php");
require_once("src/app/model/Pub.php");
require_once("src/app/view/AddBeerView.php");
require_once("src/app/view/HomeView.php");
require_once("src/app/controller/BeerController.php");
require_once("src/app/controller/PubController.php");
require_once("src/app/view/NavigationView.php");
require_once("src/app/view/LayoutView.php");
require_once("src/app/view/PubView.php");
require_once("src/common/exceptions/BeerDoesNotExistException.php");
require_once("src/common/exceptions/BeerAlreadyExistsException.php");




//TODO: move exception requires to classes that use them.
//TODO: try to implement autoloader if time allows.

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

        $pub = new \model\Pub("Test", "Test", "Test");
        $beer = new \model\Beer("TBeer", 3.5, "tBrew", "tC", 33, "flaska");
        $pub->addBeer($beer);
        $pub->addBeer($beer);

        switch($navView->getAction()) {
            case \view\NavigationView::$showPubs:
                $html = "Show Pubs!";
                //todo: Show pubs
                break;
            case \view\NavigationView::$showPub:
                $html = "Show Pub!";
                //todo: Show pub
                break;
            case \view\NavigationView::$addPub:
                $html = "Add Pub!";
                //todo: add pub
                break;

            case \view\NavigationView::$showBeer:
                $html = "Show Beer";
                //todo: show beer
                break;
            case \view\NavigationView::$addBeer:
                $view = new \view\AddBeerView();
                $controller = new \controller\BeerController($view);
                $html = $controller->getView()->response();
                break;
            case \view\NavigationView::$updateBeer:
                $html = "update beer!";
                //todo: update beer;
                break;
            case \view\NavigationView::$register:
                $html = "register";
                //todo: fix register
                break;
            case \view\NavigationView::$signIn:
                $html = "login";
                //todo: fix login
            default:
                // No need for a controller here, just show "homepage"
                $view = new \view\HomeView();
                $html = $view->response();
                break;
        }

        $layoutView->render($html);
    }
}