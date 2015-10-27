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
    public static $admin   = "admin";
    public static $pubs    = "pubs";
    public static $beers   = "beers";
    public static $showAll = "show_all";
    public static $showBeer = "show_beer";
    public static $showPub = "show_pub";
    public static $showAllPubs = "show_pubs";
    public static $showAllBeers = "show_beers";
    public static $pubID = "pub_id";
    public static $beerID = "beer_id";


    /**
     * Gets unordered list for the <nav> thats on the left side
     * @return string
     */
    public function getLeftNavMenu() {
        $html  = '<ul class="nav navbar-nav">';
        $html .= "<li ". $this->isActiveClass(self::$pubs) ."><a href='?".self::$action."=".self::$pubs."&".self::$showAll."'>Visa pubar</a></li>";
        $html .= "</ul>";
        return $html;
    }

    /**
     * Gets unordered list for the <nav> thats on the right side
     * Login and register
     * @return string
     */
    public function getRightNavMenu() {
        $html  = '<ul class="nav navbar-nav navbar-right">';
        $html .= "<li ". $this->isActiveClass(self::$admin) ."><a href='?".self::$action."=".self::$admin."'>Administrera</a></li>";
        $html .= "</ul>";
        return $html;
    }

    private function isActiveClass($actionName) {
        $currentAction = $this->getAction();
        if($currentAction === $actionName){
            return 'class="active"';
        }
    }


    /**
     * Checks the $_GET-var "action". If not set to anything, return "home";
     * @return string
     */
    private function getAction() {
        if (isset($_GET[self::$action]))
            return $_GET[self::$action];

        return self::$pubs; // standard action, homepage
    }

    public function userWantsToDoPubs() {
        return $this->getAction() == self::$pubs;
    }

    public function userWantsToDoAdmin() {
        return $this->getAction() == self::$admin;
    }

    public function userWantsToSeePub() {
        return isset($_GET[self::$pubID]);
    }

    public function userWantsToSeeBeer() {
        return isset($_GET[self::$beerID]);
    }

    public function getURLToPub($pubId) {
        return "?".self::$action."=".self::$pubs."&".self::$pubID."=".$pubId;
    }

    public function getURLToBeer($beerID) {
        return "?".self::$action."=".self::$beers."&".self::$beerID."=".$beerID;
    }

    public function getPubId() {
        if (isset($_GET[self::$pubID]))
            return $_GET[self::$pubID];

        return null;
    }

    public function getBeerId() {
        if (isset($_GET[self::$beerID]))
            return $_GET[self::$beerID];
        return null;
    }

    public function reloadPage() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        die();
    }


}