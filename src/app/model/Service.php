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
        $pubRepository = $this->pubDAL->getPubs();
        $beerRepository = $this->beerDAL->getBeers();
        $pubBeers = $this->getPubBeers();

        // Goes through the pubs..
        foreach($pubRepository->get() as $pub) {
            // and each beer..
            foreach($beerRepository->get() as $beer) {
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
        return $pubRepository;
    }

    public function getBeers() {
        return $this->beerDAL->getBeers();
    }
    public function getBeerById($id) {
        return $this->beerDAL->getBeerById($id);
    }

    private function getPubBeers() {
        return $this->pubBeerDAL->getPubBeers();
    }
}