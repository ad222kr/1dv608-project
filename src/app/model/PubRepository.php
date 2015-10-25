<?php

namespace model;
require_once("src/app/common/exceptions/PubAlreadyExistsException.php");

class PubRepository {

    private $pubs = array();

    public function add(\model\Pub $toBeAdded) {
        foreach($this->pubs as $pub) {
            if ($toBeAdded->isSame($pub))
                throw new \PubAlreadyExistsException("Pub already exists");
        }
        $pubs[$toBeAdded->getId()] = $toBeAdded;
    }

}