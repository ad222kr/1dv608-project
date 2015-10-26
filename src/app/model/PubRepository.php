<?php

namespace model;
require_once("src/app/common/exceptions/PubAlreadyExistsException.php");
require_once("src/app/common/exceptions/PubDoesNotExistsException.php");


class PubRepository {

    private $pubs = array();

    public function add(\model\Pub $toBeAdded) {
        foreach($this->pubs as $pub) {
            if ($toBeAdded->isSame($pub))
                throw new \PubAlreadyExistsException("Pub already exists");
        }
        $this->pubs[$toBeAdded->getId()] = $toBeAdded;
    }

    public function get() {
        return $this->pubs;
    }

    public function getPubFromID($uniqueID) {
        if (isset($this->pubs[$uniqueID]))
            return $this->pubs[$uniqueID];

        throw new \PubDoesNotExistsException();

    }

}