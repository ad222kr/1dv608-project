<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-15
 * Time: 19:50
 */

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


    //TODO: remember to remove default for price. Will get price via Join in sql.
    public function __construct($id, $name, $abv, $brewery, $imageURL, $country, $volume, $servingType,
                                $price=20) {
        //TODO: Validation
        $this->id = $id;
        $this->name = $name;
        $this->abv = $abv;
        $this->brewery = $brewery;
        $this->imageURL = $imageURL;
        $this->country = $country;
        $this->volume = $volume;
        $this->servingType = $servingType;
        $this->price = $price;
    }

    public function getQueryString() {
        return htmlentities($this->name . "_" . $this->volume . "_" . $this->servingType, ENT_QUOTES);
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

    /**
     * Price is set by a setter since different beers have different prices
     * at different pubs
     * @param double $price,
     */
    public function setPrice($price) {
        $this->price = $price;
    }




}