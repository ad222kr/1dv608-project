<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-17
 * Time: 12:21
 */

namespace model;

require_once("app/model/DAL/BaseDAL.php");
require_once("app/model/DAL/PubDAL.php");
require_once("app/model/DAL/BeerDAL.php");


class Service {

    private $beerDAL;
    private $pubDAL;

    public function __construct() {
        $this->beerDAL = new BeerDAL();
        $this->pubDAL = new PubDAL();
    }

    public function getBeerById($id) {
        assert(is_int($id));
        return $this->beerDAL->getBeerById($id);
    }

    public function getBeers() {
        return $this->beerDAL->getBeers();
    }

    public function getPubs() {
        return $this->pubDAL->getPubs();
    }

    public function getPubById($id) {
        //TODO: populate Pub with beers that have connection via BeerCatalog here
        assert(is_int($id));
        return $this->pubDAL->getPubs();
    }

    private function getBeerCatalog() {
        //TODO: get relation-table
    }



}