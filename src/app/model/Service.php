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
        $beers = $this->beerDAL->getBeers();
        $pubBeers = $this->getPubBeers();

        // Goes through the pubs..
        foreach($pubs->get() as $pub) {
            // and each beer..
            foreach($beers->get() as $beer) {
                // lastly each "post" in the relational table
                foreach ($pubBeers->get() as $pubBeer) {
                    // checks for a connection between beer and pub
                    if ($pub->getId() === $pubBeer->getPubId() && $beer->getId() === $pubBeer->getBeerId()) {
                        $beer->setPrice($pubBeer->getPrice());
                        $pub->addBeer($beer);
                    }
                }
            }
        }
        return $pubs;
    }

    public function getBeers() {

    }

    private function getPubBeers() {
        return $this->pubBeerDAL->getPubBeers();
    }
}