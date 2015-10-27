<?php

namespace controller;

require_once("src/app/view/BaseFormView.php");

require_once("src/app/model/Service.php");

require_once("config/Settings.php");

require_once("src/app/model/Beer.php");

require_once("src/app/model/Pub.php");

require_once("src/app/view/AddBeerView.php");

require_once("src/app/controller/PubController.php");

require_once("src/app/view/NavigationView.php");

require_once("src/app/view/LayoutView.php");

require_once("src/app/view/AddPubView.php");

require_once("src/app/view/AddBeerView.php");

require_once("src/app/view/ListPubsView.php");

require_once("src/app/view/PubView.php");

require_once("src/app/view/BeerView.php");



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
        $this->navView = new \view\NavigationView();
        $this->layoutView = new \view\LayoutView($this->navView);
        $this->service = new \model\Service();
    }

    public function run() {

        try {

            $navView = new \view\NavigationView();
            $layoutView = new \view\LayoutView($navView);
            $service = new \model\Service();

            if ($this->navView->userWantsToDoPubs()) {

                $pubs = $this->service->getPubs();
                $listPubsView = new \view\ListPubsView($pubs, $this->navView);
                $pubController = new \controller\PubController($listPubsView, $this->navView, $pubs);

                $pubController->doControl();

                $html = $pubController->getView()->response();
            } elseif ($this->navView->userWantsToSeeBeer()) {

                $beerID = $this->navView->getBeerId();
                $beer = $service->getBeerById($beerID);

                $beerView = new \view\BeerView($beer);

                $html = $beerView->response();
            }

            $layoutView->render($html);
        } catch (\Exception $e) {
            error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                echo $e->getMessage();
                //redirect to error or flashmessage error maybe?
                die();
            }
        }

    }
}