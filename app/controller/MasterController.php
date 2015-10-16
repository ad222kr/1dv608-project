<?php

namespace controller;

use view\LayoutView;
use view\NavigationView;

require_once("app/model/DAL/BaseDAL.php");
require_once("app/model/DAL/BeerDAL.php");
require_once("app/view/LayoutView.php");
require_once("app/view/NavigationView.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");


class MasterController implements IController {

    private $currentView;
    private $navigationView;


    public function doControl() {
        $this->navigationView = new NavigationView();
    }

    public function getView() {
        return $this->view;
    }
}