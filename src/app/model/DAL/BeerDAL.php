<?php

namespace model;

require_once("src/app/model/BeerRepository.php");


class BeerDAL extends BaseDAL{

    /*
     *  CREATE TABLE `beers` (
       `Id` int(11) NOT NULL AUTO_INCREMENT,
       `Name` varchar(80) NOT NULL,
       `Abv` double NOT NULL,
       `Manufacturer` varchar(80) NOT NULL,
       `ImageURL` varchar(255) NOT NULL DEFAULT 'assets/uploaded-beer-pics/no_picture_beer.jpg',
        PRIMARY KEY (`Id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

     */

    private static $table = "beers";

    public function __construct() {
        parent::__construct();
    }

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

            $this->conn->close();

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

            $this->conn->close();

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