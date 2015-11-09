<?php

namespace model;

require_once("src/app/model/BeerRepository.php");

/**
 * Class responsible for fetching data from the table beers in the db
 *
 * Class BeerDAL
 * @package model
 */
class BeerDAL extends BaseDAL{

    /**
     * @var string
     */
    private static $table = "beers";

    public function __construct() {
        parent::__construct();
    }

    /**
     * Gets all the posts from the beer-table
     *
     * @return BeerRepository
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function getBeers() {

        try{
            $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);
            if ($stmt === FALSE) {
                throw new \DataBaseException($this->conn->error);
            }

            $stmt->execute();

            $stmt->bind_result($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingType);

            $ret = new BeerRepository();

            while ($stmt->fetch()) {
                $ret->add(new Beer( $name, $abv, $manufacturer, $country, $volume, $servingType, $imageURL, $id));
            }

            return $ret;
        } catch (\DataBaseException $e) {
            error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
            if (\Settings::DEBUG_MODE) {
                echo $e->getMessage();
                throw $e;
            } else {
                echo "Something went wrong when connecting to the database";
                //show error msg
                die();
            }
        }
    }

    /**
     * Gets a single posts from the beer-table by ID
     *
     * @param $beerId
     * @return Beer
     * @throws \BeerDoesNotExistException
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function getBeerById($beerId) {

        try{
            $stmt = $this->conn->prepare("SELECT * FROM " . self::$table . " WHERE beerid=?;");

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $stmt->bind_param('s', $beerId);

            $stmt->execute();

            $stmt->bind_result($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingtype);

            $stmt->fetch();

            // Since getting a single beer is done via the DAL and not the pub-class this
            // exception is thrown here
            if ($id == null) throw new \BeerDoesNotExistException();

            return new Beer($name, $abv, $manufacturer, $country, $volume, $servingtype, $imageURL, $id);

        } catch (\DataBaseException $e){
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
                echo "Something went wrong when connecting to the database";
                die();
            }
        }
    }

    /**
     * Adds a beer to the table beers
     *
     * @param Beer $beer
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function addBeer(\model\Beer $beer) {

        try {
            $stmt = $this->conn->prepare("CALL insert_beer(?, ?, ?, ?, ?, ?, ?, ?)");

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $id = $beer->getId();
            $name = $beer->getName();
            $abv = $beer->getAbv();
            $manufacturer = $beer->getBrewery();
            $imageurl = $beer->getImageURL();
            $country = $beer->getCountry();
            $volume = $beer->getVolume();
            $servingType = $beer->getServingType();

            $stmt->bind_param('ssdsssds', $id, $name, $abv, $manufacturer, $imageurl, $country, $volume, $servingType);

            $stmt->execute();


        } catch (\DataBaseException $e) {
            echo $e->getMessage();
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
                echo "Something went wrong when connecting to the database";
                die();
            }
        }
    }

    /**
     * Updates a post in the table beers
     *
     * @param Beer $beer
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function updateBeer(\model\Beer $beer) {

        try {
            $stmt = $this->conn->prepare("CALL update_beer(?, ?, ?, ?, ?, ?, ?, ?)");

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $id = $beer->getId();
            $name = $beer->getName();
            $abv = $beer->getAbv();
            $manufacturer = $beer->getBrewery();
            $imageurl = $beer->getImageURL();
            $country = $beer->getCountry();
            $volume = $beer->getVolume();
            $servingType = $beer->getServingType();

            $stmt->bind_param("ssdsssds", $id, $name, $abv, $manufacturer, $imageurl, $country, $volume, $servingType);

            $stmt->execute();


        } catch (\DataBaseException $e) {
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                error_log($e->getMessage() . "\n", 3, \Settings::ERROR_LOG);
                echo "Something went wrong when connecting to the database";
                die();
            }
        }
    }
}