<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 17:54
 */

namespace model;

/**
 * Class PubBeerRepository
 * Collection of the PubBeers (relational table) fetched from the database
 * @package model
 */

class PubBeerRepository {

    private $pubBeers = array();

    public function add(\model\PubBeer $toBeAdded) {
        $this->pubBeers[] = $toBeAdded;
    }

    public function get() {
        return $this->pubBeers;
    }

}