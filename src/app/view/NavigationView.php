<?php

namespace view;

/**
 * Class NavigationView
 * Used for getting URLs to different views in the application.
 * Does not implement IView since it does'nt need a render-function.
 * @package view
 */

class NavigationView {

    private static $action = "action";
    private static $addBeerID = "add_beer";
    private static $updateBeerID = "update_beer";
    private static $beerID = "show_beer";
    private static $addPubID = "add_pub";
    private static $pubID = "show_pub";
    private static $pubsID = "show_pubs";

    public function getNavMenu() {
        $html  = "<nav><ul>";
        $html .= "<li><a href='?'>Hem</a></li>";
        $html .= "<li><a href='?".self::$action."=".self::$pubsID."'>Visa pubar</a></li>";
        $html .= "<li><a href='?".self::$action."=".self::$addPubID."'>Lägg till pub</a></li>";
        $html .= "</ul></nav>";
        return $html;

    }

    private function getLinkElem($hrefValue, $title) {

    }

    public function getLinkToHome() {
        return "<a href='?'>Hem</a>";
    }

    public function getLinkToAddBeer() {
        return "<a href='?" . self::$addBeerID . "'>Lägg till en öl</a>";
    }


    public function getLinkToPubList() {
        return "<a href='?" . self::$pubsID . "'>Visa pubar/uteställen</a>";
    }

    public function getURLToBeer($queryString) {
        return "?" . self::$beerID . "=$queryString";
    }

    public function getURLToPub($queryString) {
        return "?" . self::$pubID . "=$queryString";
    }

    public function userWantsToSeeBeer() {
        return isset($_GET[self::$beerID]);
    }

    public function userWantsToSeeSpecificPub() {
        return isset($_GET[self::$pubID]);
    }

    public function userWantsToAddBeer() {
        return isset($_GET[self::$addBeerID]);
    }
}