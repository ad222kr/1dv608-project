<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-22
 * Time: 23:00
 */

namespace model;


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