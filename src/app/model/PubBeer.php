<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 17:50
 */

namespace model;

require_once("src/common/exceptions/PriceMissingException.php");


class PubBeer {
    private $beerID;
    private $pubID;
    private $price;

    public function __construct( $pubID, $beerID, $price) {
        if (empty($price)) {
            throw new \PriceMissingException();
        }
        $this->beerID = $beerID;
        $this->pubID = $pubID;
        $this->price = $price;
    }

    public function getBeerId() {
        return $this->beerID;
    }

    public function getPubId() {
        return $this->pubID;
    }

    public function getPrice() {
        return $this->price;
    }
}