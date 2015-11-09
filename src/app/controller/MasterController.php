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



/**
 * Class MasterController
 * Main entry point for the app. Does not implement the IController-interface
 * since it does not need to return any views.
 * @package controller
 */

class MasterController {

    /**
     * @var \view\NavigationView
     */
    private $navView;

    /**
     * @var \view\LayoutView
     */
    private $layoutView;

    public function __construct() {
        $this->navView = new \view\NavigationView();
        $this->layoutView = new \view\LayoutView($this->navView);

    }

    /**
     * @throws \Exception
     */
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

    /**
     * Does the control for pub-actions and returns the html-response of the view of pubcontroller
     *
     * @return string - HTML-response of the view
     */
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

    /**
     * Does the control for admin-actions and returns the html-response of the view of admincontroller
     *
     * @return string - HTML-response of the view
     */
    private function doAdmin() {

        $adminController = new \controller\AdminController($this->navView);
        $adminController->doControl();

        return $adminController->getView()->response();
    }
}