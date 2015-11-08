<?php

namespace view;

/**
 * Class NavigationView
 * Used for getting URLs to different views in the application.
 * @package view
 */

class NavigationView {

    /**
     * Represents the action
     * @var string
     */
    private static $action = "action";

    /**
     * Administration-action
     * @var string
     */
    private static $admin   = "admin";

    private static $addPub  = "add_pub";

    private static $addBeer = "add_beer";


    /**
     * Pubs-action
     * @var string
     */
    private static $pubs    = "pubs";

    /**
     * Beers-action
     * @var string
     */
    private static $beers   = "beers";

    /**
     * Show all action. Used together with beers/pubs example: ?action=pubs&show_all
     * @var string
     */
    private static $showAll = "show_all";

    /**
     * Used for both showing pub_id and determening if user wants to see a pub
     * if pub_id isset, the user wants to view a pub
     * @var string
     */
    private static $pubID = "pub_id";

    /**
     * See NavigationView::$pubId
     * @var string
     */
    private static $beerID = "beer_id";


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


    /**
     * Checks the name of the action against the current one to determine what
     * navigation-link should have the class active
     * @param $actionName
     * @return string
     */
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

    /**
     * @return bool
     */
    public function userWantsToDoPubsAndBeers() {
        return $this->getAction() == self::$pubs || $this->getAction() == self::$beers;
    }

    /**
     * @return bool
     */
    public function userWantsToDoAdmin() {
        return $this->getAction() == self::$admin;
    }

    /**
     *
     */

    /**
     * @return bool
     */
    public function userWantsToSeePub() {
        return isset($_GET[self::$pubID]);
    }

    /**
     * @return bool
     */
    public function userWantsToSeeBeer() {
        return isset($_GET[self::$beerID]);
    }

    public function adminWantsToAddPub() {
        return isset($_GET[self::$addPub]);
    }

    public function adminWantsToAddBeer() {
        return isset($_GET[self::$addBeer]);
    }

    /**
     * @param $pubId
     * @return string
     */
    public function getURLToPub($pubId) {
        return "?".self::$action."=".self::$pubs."&".self::$pubID."=".$pubId;
    }

    public function getURLToAddPub() {
        return "?".self::$action."=".self::$admin."&".self::$addPub;
    }

    public function getURLToAddBeer() {
        return "?".self::$action."=".self::$admin."&".self::$addBeer;
    }

    /**
     * @param $beerID
     * @return string
     */
    public function getURLToBeer($beerID) {
        return "?".self::$action."=".self::$beers."&".self::$beerID."=".$beerID;
    }

    public function redirectToBeer($beerId) {
        header("Location: ?action=beers&beer_id=". $beerId);
    }

    public function redirectToPub($pubId) {
        header("Location: ?action=pubs&pub_id=" . $pubId);
    }

    /**
     * Returns the beer-id specified in the url, if not, return null.
     * @return null | string
     */
    public function getPubId() {
        if (isset($_GET[self::$pubID]))
            return $_GET[self::$pubID];

        return null;
    }

    /**
     * See NavigationView::getPubId
     * @return null | string
     */
    public function getBeerId() {
        if (isset($_GET[self::$beerID]))
            return $_GET[self::$beerID];
        return null;
    }

}