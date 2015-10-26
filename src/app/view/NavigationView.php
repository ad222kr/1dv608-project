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
    public static $showPubs = "show_pubs";
    public static $signIn = "sign_in";
    public static $register = "register";
    public static $pubID = "pub_id";
    public static $beerID = "beer_id";


    /**
     * Gets unordered list for the <nav> thats on the left side
     * @return string
     */
    public function getLeftNavMenu() {
        $html  = '<ul class="nav navbar-nav">';
        $html .= "<li ". $this->isActiveClass(self::$showPubs) ."><a href='?".self::$action."=".self::$showPubs."'>Visa pubar</a></li>";
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
        $html .= "<li ". $this->isActiveClass(self::$signIn) ."><a href='?".self::$action."=".self::$signIn."'>Logga in</a></li>";
        $html .= "<li ". $this->isActiveClass(self::$register) ."><a href='?".self::$action."=".self::$register."'>Registrera</a></li>";
        $html .= "</ul>";
        return $html;
    }


    public function isActiveClass($actionName) {
        $currentAction = $this->getAction();
        if($currentAction === $actionName){
            return 'class="active"';
        }
    }

    /**
     * Checks the $_GET-var "action". If not set to anything, return "home";
     * @return string
     */
    public function getAction() {
        if (isset($_GET[self::$action]))
            return $_GET[self::$action];

        return self::$showPubs;
    }

    public function userWantsToSeePub() {
        return isset($_GET[self::$pubID]);
    }

    public function getURLToPub($pubId) {
        return "?".self::$action."=".self::$showPubs."&".self::$pubID."=".$pubId;
    }

    public function getPubId() {
        if (isset($_GET[self::$pubID]))
            return $_GET[self::$pubID];

        return null;
    }

    public function reloadPage() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }


}