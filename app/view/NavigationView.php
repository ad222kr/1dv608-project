<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-16
 * Time: 17:29
 */

namespace view;


class NavigationView {

    /**
     * Used to build URL for adding a beer
     * @var string
     */
    private static $addBeerURL = "add-beer";

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

    public function getLinkToHome() {
        return "<a href='?'>Tillbaka</a>";
    }

    public function getLinkToAddBeer() {
        return "<a href='?=" . self::$adminURL . "'></a>";
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



}