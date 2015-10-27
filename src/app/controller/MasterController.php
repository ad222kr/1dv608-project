<?php

namespace controller;

use view\ListPubsView;
use view\PubView;

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
require_once("src/app/view/PubView.php");
require_once("src/app/view/BeerView.php");

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

    private $pubs;

    private $beers;

    public function __construct() {
        $this->navView = new \view\NavigationView();
        $this->layoutView = new \view\LayoutView($this->navView);
        $this->service = new \model\Service();
        $this->pubs = $this->service->getPubs();
        $this->listPubsView = new \view\ListPubsView($this->pubs, $this->navView);
    }

    public function run() {

        $navView = new \view\NavigationView();
        $layoutView = new \view\LayoutView($navView);
        $service = new \model\Service();

        $html = "FAIUL";

        if ($this->navView->userWantsToDoPubs()) {
            $pubController = new \controller\PubController($this->listPubsView, $this->navView, $this->pubs);
            $pubController->doControl();
            $html = $pubController->getView()->response();
        } elseif ($this->navView->userWantsToSeeBeer()) {
            $beerID = $this->navView->getBeerId();
            $beer = $service->getBeerById($beerID);
            $beerView = new \view\BeerView($beer);
            $html = $beerView->response();
        }

        $layoutView->render($html);
    }
}