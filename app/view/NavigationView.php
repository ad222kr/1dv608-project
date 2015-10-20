<?php

namespace view;

/**
 * Class NavigationView
 * Used for getting URLs to different views in the application.
 * Does not implement IView since it does'nt need a render-function.
 * @package view
 */

class NavigationView {

    /**
     * Used to build URL for adding a beer
     * @var string
     */
    private static $addBeerID = "add_beer";

    /**
     * Used to build URL for updating a beer;
     * @var string
     */
    private static $updateBeerURL = "update-beer";

    /**
     * Used to build URL to a specific beer
     * @var string
     */
    private static $beerURL = "beer";

    /**
     * Used to build URL to a specific pub
     * @var string
     */
    private static $pubID = "pub";

    /**
     * Used to build URL to view a list of pubs
     * @var string
     */
    private static $pubsID = "pubs";

    public function getLinkToHome() {
        return "<a href='?'>Tillbaka</a>";
    }

    public function getLinkToAddBeer() {
        return "<a href='?" . self::$addBeerID . "'>Lägg till en öl</a>";
    }

    public function getLinkToPubList() {
        return "<a href='?" . self::$pubsID . "'>Visa pubar/uteställen</a>";
    }

    public function getURLToBeer($queryString) {
        return "?" . self::$beerURL . "=$queryString";
    }

    public function getURLToPub($queryString) {
        return "?" . self::$pubID . "=$queryString";
    }

    public function userWantsToSeeBeer() {
        return isset($_GET[self::$beerURL]);
    }

    public function userWantsToSeeSpecificPub() {
        return isset($_GET[self::$pubID]);
    }

    public function userWantsToAddBeer() {
        return isset($_GET[self::$addBeerID]);
    }
}