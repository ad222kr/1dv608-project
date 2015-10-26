<?php

namespace model;

require_once("src/app/model/DAL/BaseDAL.php");
require_once("src/app/model/DAL/PubDAL.php");
require_once("src/app/model/DAL/BeerDAL.php");
require_once("src/app/model/DAL/PubBeerDAL.php");


class Service {

    private $beerDAL;
    private $pubDAL;
    private $pubBeerDAL;

    public function __construct() {
        $this->beerDAL = new BeerDAL();
        $this->pubDAL = new PubDAL();
        $this->pubBeerDAL = new PubBeerDAL();
    }

    public function getPubs() {
        $pubs = $this->pubDAL->getPubs();
        $beers = $this->getBeers();
        $pubBeers = $this->getPubBeers();

        foreach($pubs as $pub) {
            foreach($beers as $beer) {
                foreach ($pubBeers as $pubBeer) {
                    if ($pub->getID() === $pubBeer->getPubID() && $beer->getID() === $pubBeer->getBeerID()) {
                        $beer->setPrice($pubBeer->getPrice());
                        $pub->addBeer($beer);
                    }
                }
            }
        }

        return $pubs;
    }

    private function getBeers() {
        return $this->beerDAL->getBeers();
    }

    private function getPubBeers() {
        return $this->pubBeerDAL->getPubBeers();
    }

    public function closeConnection() {
        $this->beerDAL->close();
        $this->pubDAL->close();
        $this->pubBeerDAL->close();
    }



}