<?php

namespace controller;

require_once("app/model/DAL/BaseDAL.php");
require_once("app/model/DAL/BeerDAL.php");
require_once("app/view/LayoutView.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");


class MasterController {

    /**
     * @throws \Exception
     */
    public function run() {

        $layoutView = new \view\LayoutView();


        $bDAL = new \model\BeerDAL();
        $b = new \model\Beer("Corona", 4.5, "Unknown", "Mexico", 33, "Flaska");
        

        $str = "<ul>";

        foreach ($bDAL->getBeers() as $beer) {
            $str .= "<li><ul>";
            $str .= "<li>" . $beer->getName() . "</li>";
            $str .= "<li>" . $beer->getBrewery() . "</li>";
            $str .= "<li><img src=" . $beer->getImageURL() . " alt='beer.jpg' height='80' width='40'> </li>";
            $str .= "<li>" . $beer->getQueryString() . " </li>";

            $str .= "</ul></li>";

        }



        $str .= "</ul>";



        $layoutView->render("APPLOL", $str);



    }



}