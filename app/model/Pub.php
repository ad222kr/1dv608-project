<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-16
 * Time: 22:24
 */

namespace model;


class Pub {

    private $id;
    private $name;
    private $address;
    private $webpageURL;
    private $beers;

    public function __construct($name, $address, $webpageURL, $id=0) {
        //TODO: Add validation

        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->webpageURL = $webpageURL;
        $this->beers = array();
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
                throw new \Exception("Beer already exists, cannot add it again");
            }
        }
        //
        $this->beers[$toBeAdded->getId()] = $beer;
    }


    public function getBeer($key) {
        // TODO:_ check for errors etc,e xception
        if (isset($this->beers[$key]))
            return $this->beers[$key];

        return null; // throw exception?
    }

    public function getBeers() {
        return $this->beers;
    }

    public function getQueryString() {
        return strtolower($this->name);
    }




}