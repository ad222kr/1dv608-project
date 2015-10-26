<?php

namespace controller;

use model\Service;
use view\LayoutView;
use view\NavigationView;

require_once("src/app/view/BaseFormView.php");

require_once("src/app/model/Service.php");

require_once("config/Settings.php");

require_once("src/app/model/Beer.php");

require_once("src/app/model/Pub.php");


require_once("src/app/view/AddBeerView.php");



require_once("src/app/controller/BeerController.php");

require_once("src/app/controller/PubController.php");

require_once("src/app/view/NavigationView.php");

require_once("src/app/view/LayoutView.php");

require_once("src/app/view/AddPubView.php");

require_once("src/app/view/AddBeerView.php");
require_once("src/app/view/ListPubsView.php");

//TODO: move exception requires to classes that use them.
//TODO: try to implement autoloader if time allows.

/**
 * Class MasterController
 * Main entry point for the app. Does not implement the IController-interface
 * since it does not need to return any views.
 * @package controller
 */

class MasterController {

    /**
     * @var NavigationView
     */
    private $navView;

    /**
     * @var LayoutView
     */
    private $layoutView;

    /**
     * Talks to the DAL
     * @var Service
     */
    private $service;

    public function __construct() {
        $this->navView = new NavigationView();
        $this->layoutView = new LayoutView($this->navView);
        $this->service = new Service();
    }

    public function run() {

        switch($this->navView->getAction()) {
            case \view\NavigationView::$showAllPubs:
                $view = new \view\ListPubsView($this->service->getPubs(), $this->navView);
                $controller = new PubController($view, $this->navView);
                $controller->doControl();
                $html = $controller->getView()->response();

                break;
            case \view\NavigationView::$showPub:

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

        }

        $this->layoutView->render($html);
    }
}