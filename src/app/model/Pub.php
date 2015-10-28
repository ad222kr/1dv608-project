<?php

namespace model;

require_once("src/common/exceptions/BeerDoesNotExistException.php");
require_once("src/common/exceptions/BeerAlreadyExistsException.php");

class Pub {

    private $id;
    private $name;
    private $address;
    private $webpageURL;
    private $beers = array();

    public function __construct($id, $name, $address, $webpageURL) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->webpageURL = $webpageURL;
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
        foreach ($this->beers as $beer) {
            if ($beer->getId() == $toBeAdded->getId()){

                throw new \BeerAlreadyExistsException("Beer already exists, cannot add it again");
            }
        }
        $this->beers[$toBeAdded->getId()] = $toBeAdded;
    }

    public function getBeer($key) {
        // TODO:_ check for errors etc,exception
        if (isset($this->beers[$key]))
            return $this->beers[$key];

        // heroku dont like
        throw new \BeerDoesNotExistException("Beer does not exist in the database");
    }

    public function getBeers() {
        return $this->beers;
    }

    public function isSame(\model\Pub $other) {
        return $this->id === $other->getId();
    }




}