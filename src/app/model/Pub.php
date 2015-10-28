<?php

namespace model;

require_once("src/common/exceptions/BeerDoesNotExistException.php");
require_once("src/common/exceptions/BeerAlreadyExistsException.php");

class Pub {

    private $id;
    private $name;
    private $address;
    private $webpageURL;
    private $beers;

    public function __construct($id, $name, $address, $webpageURL) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->webpageURL = $webpageURL;
        $this->beers = new BeerRepository();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**

     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getWebpageURL() {
        return $this->webpageURL;
    }

    public function addBeer(Beer $toBeAdded) {
        $this->beers->add($toBeAdded);
    }

    // Not used yet. Maybe fix solution to use this instead of
    public function getBeer($id) {
        // TODO:_ check for errors etc,exception
        $this->beers->getById($id);
    }

    public function getBeers() {
        return $this->beers->get();
    }

    public function isSame(\model\Pub $other) {
        return $this->id === $other->getId();
    }




}