<?php

namespace controller;



require_once("app/model/Service.php");
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





    }


    public function doControl() {
        $pDAL = new \model\PubDAL();
        $bDAL = new \model\BeerDAL();
        $bDAL->updateBeer(new \model\Beer("Sonny Bljat IPA", 4.5, "BredCat", "Sverige", 33, "flawska", "images/user_uploaded/no_picture_beer.jpg",
            35, 22));
        return $bDAL->getBeers();
    }

    public function getView() {
        return $this->currentView;
    }
}