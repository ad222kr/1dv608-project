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

    /**
     * @var array
     */
    private $pubBeers = array();

    /**
     * @param PubBeer $toBeAdded
     */
    public function add(\model\PubBeer $toBeAdded) {
        $this->pubBeers[] = $toBeAdded;
    }

    /**
     * @return array
     */
    public function get() {
        return $this->pubBeers;
    }

}