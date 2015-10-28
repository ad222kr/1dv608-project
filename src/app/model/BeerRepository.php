<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 17:35
 */

namespace model;

/**
 * Class BeerRepository
 * Collection of the beers fetched from the database
 * @package model
 */

class BeerRepository {
    private $beers = array();

    public function add(\model\Beer $toBeAdded) {
        foreach($this->beers as $beer) {
            if ($beer->isSame($toBeAdded))
                throw new \Exception("same beer"); // todo custom exception
        }
        $this->beers[$toBeAdded->getId()] = $toBeAdded;
    }

    public function getById($id) {
        if (isset($this->beers[$id]))
            return $this->beers[$id];

        // heroku dont like
        throw new \BeerDoesNotExistException("Beer does not exist in the database");
    }

    public function get() {
        return $this->beers;
    }


}