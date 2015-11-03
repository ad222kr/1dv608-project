<?php

namespace model;

class Beer {

    private $id;
    private $name;
    private $abv;
    private $brewery;
    private $imageURL;
    private $country;
    private $volume;
    private $servingType;
    private $price;

    //TODO: remember to remove default for price. Will get price via Join in sql. Fix nicer way of making standardUrl.
    public function __construct($name, $abv, $brewery, $country, $volume, $servingType,
                                 $imageURL="images/user_uploaded/no_picture_beer.jpg", $id="") {
        //TODO: Validation
        $this->name = $name;
        $this->abv = $abv;
        $this->brewery = $brewery;
        $this->imageURL = $imageURL;
        $this->country = $country;
        $this->volume = $volume;
        $this->servingType = $servingType;
        if (empty($id)) {
            $this->id = $this->buildUniqueID();
        } else {
            $this->id = $id;
        }
    }

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