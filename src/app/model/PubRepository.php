<?php

namespace model;
require_once("src/common/exceptions/PubAlreadyExistsException.php");
require_once("src/common/exceptions/PubDoesNotExistsException.php");

/**
 * Class PubRepository
 * A collection of pubs
 * @package model
 */

class PubRepository {

    /**
     * @var array
     */
    private $pubs = array();

    /**
     * @param Pub $toBeAdded
     * @throws \PubAlreadyExistsException
     */
    public function add(\model\Pub $toBeAdded) {
        foreach($this->pubs as $pub) {
            if ($toBeAdded->isSame($pub))
                throw new \PubAlreadyExistsException("Pub already exists");
        }
        $this->pubs[$toBeAdded->getId()] = $toBeAdded;
    }

    /**
     * Gets the pubs
     *
     * @return array
     */
    public function get() {
        return $this->pubs;
    }

    /**
     * Gets one pub by ID
     *
     * @param $uniqueID
     * @return \model\Pub
     * @throws \PubDoesNotExistsException
     */
    public function getPubFromID($uniqueID) {
        if (isset($this->pubs[$uniqueID]))
            return $this->pubs[$uniqueID];

        throw new \PubDoesNotExistsException();
    }
}