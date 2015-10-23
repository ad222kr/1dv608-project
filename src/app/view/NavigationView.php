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

    public static $addBeer = "add_beer";
    public static $updateBeer = "update_beer";
    public static $showBeer = "show_beer";
    public static $addPub = "add_pub";
    public static $showPub = "show_pub";
    public static $showPubs = "show_pubs";

    public function getNavMenu() {
        $html  = '<ul class="nav navbar-nav navbar-right">';
        $html .= "<li><a href='?'>Hem</a></li>";
        $html .= "<li><a href='?".self::$action."=".self::$showPub."'>Visa pubar</a></li>";
        $html .= "<li><a href='?".self::$action."=".self::$addPub."'>Lägg till pub</a></li>";
        $html .= "</ul>";
        return $html;

    }

    /**
     * Checks the $_GET-var "action". If not set to anything, return "home";
     * @return string
     */
    public function getAction() {
        if (isset($_GET[self::$action]))
            return $_GET[self::$action];

        return ""; // return empty string, switch takes care on default to show homepage


    }

    private function getURLToBeer($queryString) {
        return "?" . self::$showBeer . "=$queryString";
    }

    private function getURLToPub($queryString) {
        return "?" . self::$showPub . "=$queryString";
    }

    public function userWantsToSeeBeer() {
        return isset($_GET[self::$showBeer]);
    }

    public function userWantsToSeeSpecificPub() {
        return isset($_GET[self::$showPub]);
    }

    public function userWantsToAddBeer() {
        return isset($_GET[self::$addBeer]);
    }
}