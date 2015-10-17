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

    public function getBeerByQueryStringInformation($string) {
        return $this->beerDAL->getBeer($string);
    }



}