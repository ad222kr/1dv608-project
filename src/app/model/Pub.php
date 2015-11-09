<?php

namespace model;

require_once("src/common/exceptions/BeerDoesNotExistException.php");
require_once("src/common/exceptions/BeerAlreadyExistsException.php");
require_once("src/common/exceptions/AddressMissingException.php");
require_once("src/common/exceptions/WebpageURLMissingException.php");


class Pub {

    private $id;
    private $name;
    private $address;
    private $webpageURL;
    private $beers;

    public function __construct($name, $address, $webpageURL, $id="") {

        if (empty($name))
            throw new \NameMissingException();
        if (empty($address))
            // Here should check with a regex that address is valid swedish
            throw new \AddressMissingException();
        if (empty($webpageURL))
            // Should probably check with a regex that url is valid...
            throw new \WebpageURLMissingException();

        $this->name = $name;
        $this->address = $address;
        $this->webpageURL = $webpageURL;

        // if no id, new pub. get it a unique id
        if (empty($id)) {
            $this->id = $this->buildUniqueID($name);
        } else {
            $this->id = $id;
        }

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

    public function getBeer($id) {
        $this->beers->getById($id);
    }

    public function getBeers() {
        return $this->beers->get();
    }

    public function isSame(\model\Pub $other) {
        return $this->id === $other->getId();
    }

    private function buildUniqueID($name) {

        $name = str_replace(" ", "_", $this->name);
        $name = iconv("UTF-8", "ASCII//TRANSLIT", $name);
        $name = preg_replace('/[^a-zA-Z0-9]/', '', $name);

        return strtolower(htmlentities($name, ENT_QUOTES));
    }

}