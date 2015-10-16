<?php

namespace controller;

use model\BeerDAL;
use view\LayoutView;

require_once("app/model/BaseDAL.php");
require_once("app/model/BeerDAL.php");
require_once("app/view/LayoutView.php");
require_once("config/Settings.php");
require_once("app/model/Beer.php");

class MasterController {

    public function run() {

        $layoutView = new LayoutView();

        echo "<img src='images/user_uploaded/no_picture_beer.jpg' >";
        echo "<br />";
        $str = "<ul>";


        $str .= "</ul>";

        $layoutView->render("APPLOL", $str);



    }

}