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
    private $manufacturer;
    private $imageURL;
    private $price;

    public function __construct($id, $name, $abv, $manufacturer, $imageURL) {
        //TODO: Validation
        $this->id = $id;
        $this->name = $name;
        $this->abv = $abv;
        $this->manufacturer = $manufacturer;
        $this->imageURL = $imageURL;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getManufacturer() {
        return $this->manufacturer;
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