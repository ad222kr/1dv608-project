<?php

namespace controller;
use view\AddBeerView;
use view\HomeView;

require_once("app/model/Service.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");
require_once("app/model/Pub.php");
require_once("app/view/AddBeerView.php");
require_once("app/view/HomeView.php");



class MasterController implements IController {

    /**
     * @var \view\IView
     */
    private $currentView;
    /**
     * @var \controller\IController
     */
    private $currentController;

    /**
     * @var \view\NavigationView
     */
    private $navigationView;

    public function __construct(\view\NavigationView $navigationView) {
        $this->navigationView = $navigationView;

    }


    public function doControl() {

        if ($this->navigationView->userWantsToAddBeer()) {
            $this->currentView = new AddBeerView();
        } else {
            $this->currentView = new HomeView();
        }

        var_dump($_POST);
    }

    public function getView() {
        return $this->currentView;
    }
}