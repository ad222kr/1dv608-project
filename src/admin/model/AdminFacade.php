<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-03
 * Time: 13:02
 */

namespace model;


class AdminFacade {

    private $beerDAL;
    private $pubDAL;
    private $pubBeerDAL;

    public function __construct() {
        $this->beerDAL = new BeerDAL();
        $this->pubDAL = new PubDAL();
        $this->pubBeerDAL = new PubBeerDAL();
    }

    public function addBeer(Beer $beer) {
        $this->beerDAL->addBeer($beer);
    }

    public function addPub (Pub $pub) {
        $this->pubDAL->addPub($pub);
    }

    public function getPubs() {
        return $this->pubDAL->getPubs();
    }

    public function addPubBeer(PubBeer $pubBeer) {
        $this->pubBeerDAL->addPubBeer($pubBeer);
    }
}