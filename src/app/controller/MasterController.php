<?php

namespace controller;



use model\BeerRepository;
use model\Service;

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



    public function __construct() {
        $this->navView = new \view\NavigationView();
        $this->layoutView = new \view\LayoutView($this->navView);

    }

    public function run() {

        try {
            if ($this->navView->userWantsToDoPubsAndBeers()) {
                $html = $this->doPub();
            }  elseif ($this->navView->userWantsToDoAdmin()) {
                $html = $this->doAdmin();
            }
            $this->layoutView->render($html);
        } catch (\Exception $e) {
            error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                // show generic error view here
                echo $e->getMessage();
            }
        }
    }

    public function doPub() {
        // Service class that talks to the db. Instance created here since admin-controller has
        // its own class called AdminFacade, dont want to create service-object if admin-action
        $service = new \model\Service();

        $pubs = $service->getPubs();
        $beers = $service->getBeers();

        $listPubsView = new \view\ListPubsView($pubs, $this->navView);
        $pubController = new \controller\PubController($listPubsView, $this->navView, $beers);

        $pubController->doControl();

        return $pubController->getView()->response();
    }

    private function doAdmin() {

        $adminController = new \controller\AdminController($this->navView);
        $adminController->doControl();

        return $adminController->getView()->response();
    }
}