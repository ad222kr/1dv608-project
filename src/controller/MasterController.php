<?php

namespace controller;

use model\BeerDAL;
use view\LayoutView;

require_once("src/model/BaseDAL.php");
require_once("src/model/BeerDAL.php");
require_once("src/view/LayoutView.php");
require_once("Settings.php");
require_once("src/model/Beer.php");

class MasterController {

    public function run() {

        $layoutView = new LayoutView();
        $beerDAL = new BeerDAL();


        $str = "<ul>";


        $str .= "</ul>";

        $layoutView->render("APPLOL", $str);
        foreach ($beerDAL->getBeers() as $beer) {
            echo $beer->getName();
            echo "<br />";
            echo $beer->getAbv();
            echo "<br />";
            echo $beer->getManufacturer();
            echo "<img src='no_picture_beer.jpg' >";
            echo "<br />";
        }

    }

}