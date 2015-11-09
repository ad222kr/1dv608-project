<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-03
 * Time: 13:02
 */

namespace model;

/**
 * Class AdminFacade
 * A Facade for the admin-actions. Talks to the DAL-classes to save posts in the db.
 * @package model
 */
class AdminFacade {

    /**
     * @var BeerDAL
     */
    private $beerDAL;

    /**
     * @var PubDAL
     */
    private $pubDAL;

    /**
     * @var PubBeerDAL
     */
    private $pubBeerDAL;

    public function __construct() {
        $this->beerDAL = new BeerDAL();
        $this->pubDAL = new PubDAL();
        $this->pubBeerDAL = new PubBeerDAL();
    }

    /**
     * @param Beer $beer
     * @throws \DataBaseException
     */
    public function addBeer(Beer $beer) {
        $this->beerDAL->addBeer($beer);
    }

    /**
     * @param Pub $pub
     * @throws \DataBaseException
     */
    public function addPub (Pub $pub) {
        $this->pubDAL->addPub($pub);
    }

    /**
     * @return PubRepository
     * @throws \DataBaseException
     */
    public function getPubs() {
        return $this->pubDAL->getPubs();
    }

    /**
     * @param PubBeer $pubBeer
     * @throws \DataBaseException
     */
    public function addPubBeer(PubBeer $pubBeer) {
        $this->pubBeerDAL->addPubBeer($pubBeer);
    }
}