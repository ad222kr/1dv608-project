<?php

namespace model;

require_once("src/common/exceptions/AbvMissingException.php");
require_once("src/common/exceptions/BreweryMissingException.php");
require_once("src/common/exceptions/CountryMissingException.php");
require_once("src/common/exceptions/ImageURLMissingException.php");
require_once("src/common/exceptions/NameMissingException.php");
require_once("src/common/exceptions/VolumeMissingException.php");




class Beer {

    /**
     * Unique identifier for the beer
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Alcohol by volume
     * @var double
     */
    private $abv;

    /**
     * @var string
     */
    private $brewery;

    /**
     * @var string
     */
    private $imageURL;

    /**
     * @var string
     */
    private $country;

    /**
     * @var int
     */
    private $volume;

    /**
     * Wheter the beer is served on bottle or tap
     * @var string
     */
    private $servingType;

    /**
     * @var double
     */
    private $price;

    public function __construct($name, $abv, $brewery, $country, $volume, $servingType,
                                 $imageURL="images/user_uploaded/no_picture_beer.jpg", $id="") {
        if (empty($name))
            throw new \NameMissingException();
        if (empty($abv))
            throw new \AbvMissingException();
        if (empty($brewery))
            throw new \BreweryMissingException();
        if (empty($country))
            throw new \VolumeMissingException();
        if (empty($servingType))
            throw new \ServingTypeMissingException();

        $this->name = $name;
        $this->abv = $abv;
        $this->brewery = $brewery;
        $this->imageURL = $imageURL;
        $this->country = $country;
        $this->volume = $volume;
        $this->servingType = $servingType;

        // New beer if id is empty, generate new one.
        if (empty($id)) {
            $this->id = $this->buildUniqueID();
        } else {
            $this->id = $id;
        }
    }

    /**
     * Takes the name, volume and servingtype of the beer and builds a unique ID
     * that identifies the beer in the db. Removes ÅÄÖ characters.
     * @return string, formatted id
     */
    private function buildUniqueID() {

        $name = str_replace(" ", "_", $this->name);
        $name = iconv("UTF-8", "ASCII//TRANSLIT", $name);
        $name = preg_replace('/[^a-zA-Z0-9]/', '', $name);


        return strtolower(htmlentities($name . "_" . $this->volume . "_" . $this->servingType, ENT_QUOTES));
    }

    public function getCountry() {
        return $this->country;
    }

    public function getVolume() {
        return $this->volume;
    }

    public function getServingType() {
        return $this->servingType;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getBrewery() {
        return $this->brewery;
    }

    public function getImageURL() {
        return $this->imageURL;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getAbv() {
        return $this->abv;
    }

    public function setPrice($value) {
        $this->price = $value;
    }

    public function isSame(\model\Beer $other) {
        return $this->id === $other->getId();
    }
}