<?php

namespace model;

require_once("src/app/model/DAL/BaseDAL.php");
require_once("src/app/model/DAL/PubDAL.php");
require_once("src/app/model/DAL/BeerDAL.php");
require_once("src/app/model/DAL/PubBeerDAL.php");

/**
 * Class Service
 * Responsible for talking to the DAL-classes. Like the AdminFacade but with readonly access
 * @package model
 */

class Service {

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
     * @return PubRepository
     * @throws \DataBaseException
     * @throws \Exception
     */
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

    /**
     * @return BeerRepository
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function getBeers() {
        return $this->beerDAL->getBeers();
    }

    /**
     * @param $id
     * @return Beer
     * @throws \BeerDoesNotExistException
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function getBeerById($id) {
        return $this->beerDAL->getBeerById($id);
    }

    /**
     * @return PubBeerRepository
     * @throws \DataBaseException
     * @throws \Exception
     */
    private function getPubBeers() {
        return $this->pubBeerDAL->getPubBeers();
    }
}