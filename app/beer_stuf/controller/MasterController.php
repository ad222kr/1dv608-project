<?php

namespace controller;

use model\BeerDAL;

require_once("app/model/BaseDAL.php");
require_once("app/model/BeerDAL.php");
require_once("app/view/LayoutView.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");

class MasterController {

    public function run() {

        $layoutView = new \view\LayoutView();


        $bDAL = new BeerDAL();

        $str = "<ul>";

        foreach ($bDAL->getBeers() as $beer) {
            $str .= "<li><ul>";
            $str .= "<li>" . $beer->getName() . "</li>";
            $str .= "<li>" . $beer->getBrewery() . "</li>";
            $str .= "<li><img src=" . $beer->getImageURL() . " alt='beer.jpg' height='80' width='40'> </li>";
            $str .= "</ul></li>";

        }



        $str .= "</ul>";



        $layoutView->render("APPLOL", $str);



    }

}