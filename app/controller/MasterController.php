<?php

namespace controller;


require_once("app/model/DAL/BaseDAL.php");
require_once("app/model/DAL/BeerDAL.php");
require_once("app/model/DAL/PubDAL.php");
require_once("app/view/LayoutView.php");
require_once("app/view/NavigationView.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");
require_once("app/model/Pub.php");



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

        header('Content-Type: text/html; charset=utf-8');
        // lol
        $pDAL = new \model\PubDAL();

        foreach ($pDAL->getPubs() as $pub) {
            echo $pub->getAddress();
            echo "едц";
        }
    }


    public function doControl() {
    }

    public function getView() {
        return $this->currentView;
    }
}