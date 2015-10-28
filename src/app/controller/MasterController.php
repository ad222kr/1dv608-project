<?php

namespace controller;



require_once("src/app/model/Service.php");
require_once("config/Settings.php");


require_once("src/app/model/Beer.php");
require_once("src/app/model/Pub.php");
require_once("src/app/controller/PubController.php");
require_once("src/app/view/NavigationView.php");
require_once("src/app/view/LayoutView.php");
require_once("src/app/view/ListPubsView.php");
require_once("src/app/view/PubView.php");
require_once("src/app/view/BeerView.php");
// admin

require_once("src/admin/controller/AdminController.php");

require_once("src/admin/view/AdminView.php");
require_once("src/admin/view/BaseFormView.php");

require_once("src/admin/view/AddBeerView.php");

require_once("src/admin/view/AddPubView.php");

//exceptions











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
            if ($this->navView->userWantsToDoPubs()) {
                $html = $this->doPub();

            } elseif ($this->navView->userWantsToSeeBeer()) {

                $html = $this->viewBeer();

            } elseif ($this->navView->userWantsToDoAdmin()) {
                $html = $this->doAdmin();
            }

            $this->layoutView->render($html);
        } catch (\BeerDoesNotExistException $e) {
            // 404 or flashmessage?
        } catch (\PubDoesNotExistsException $e) {
            // 404 or flashmessage
        } catch (\Exception $e) {
            error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                echo $e->getMessage();
            }
        }
    }

    public function doPub() {
        $pubs = $this->service->getPubs();
        $listPubsView = new \view\ListPubsView($pubs, $this->navView);
        $pubController = new \controller\PubController($listPubsView, $this->navView, $pubs);
        $pubController->doControl();

        return $pubController->getView()->response();
    }

    public function viewBeer() {
        $beerID = $this->navView->getBeerId();
        $beer = $this->service->getBeerById($beerID);
        $beerView = new \view\BeerView($beer);

        return $beerView->response();
    }

    private function doAdmin() {

        $adminController = new \controller\AdminController();
        $adminController->doControl();

        return $adminController->getView()->response();
    }
}