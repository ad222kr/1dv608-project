<?php

namespace controller;

require_once("src/app/view/IView.php");
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

    private $navView;
    private $layoutView;

    public function __construct() {
        $this->navView = new \view\NavigationView();
        $this->layoutView = new \view\LayoutView($this->navView);
    }

    public function run() {

        $beer = new \model\Beer("Punk IPA", 5.6, "Brewdog", "Skottland", 33, "Flaska");
        $bDAL = new \model\BeerDAL();
        $bDAL->addBeer($beer);

        switch($this->navView->getAction()) {
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
            default:
                $view = new \view\HomeView();
                $html = $view->response();

        }




        $this->layoutView->render($html);

    }
}