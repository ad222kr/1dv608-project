<?php

namespace controller;

use model\BeerDAL;
use view\LayoutView;

require_once("src/model/BaseDAL.php");
require_once("src/model/BeerDAL.php");
require_once("src/view/LayoutView.php");
require_once("Settings.php");

class MasterController {

    public function run() {

        $layoutView = new LayoutView();
        $beerDAL = new BeerDAL();

        $testLOL = $beerDAL->getBeers();

        $str = "<ul>";

        foreach ($testLOL as $test) {
            $str .= "<li>$test</li>";
        }

        $str .= "</ul>";

        $layoutView->render("APPLOL", $str);
    }

}