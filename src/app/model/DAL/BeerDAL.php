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

        $stmt = $this->conn->prepare("call get_beers()");
        if (!$stmt) {
            throw new \Exception($this->conn->error);
        }
        var_dump($stmt);

        $stmt->execute();

        $stmt->bind_result($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingType);


        // TODO: not returning an array
        $ret = array();

        while ($stmt->fetch()) {
            $ret[] = new Beer($id, $name, $abv, $manufacturer, $country, $volume, $servingType, $imageURL);
        }

        return $ret;
    }

    public function getBeersByPubID($pubID) {
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);

        if (!$stmt)
            throw new \Exception($this->conn->error);

        $stmt->execute();

        $stmt->bind_result($beerID, $name, $abv, $brewery, $imageURL, $country, $volume, $servingType);


        $beers = new \model\BeerRepository();


        while($stmt->fetch()) {
            $beers->add(new Beer($beerID, $name, $abv, $brewery, $imageURL, $country, $volume, $servingType));
        }

        return $beers;
    }

    public function getBeerById($beerId) {

        $stmt = $this->conn->prepare("call get_beer_by_id(?)");

        if (!$stmt)
            throw new \Exception($this->conn->error);

        $stmt->bind_param('s', $beerId);

        $stmt->execute();



        $stmt->bind_result($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingtype);
        $stmt->fetch();

        return new Beer($name, $abv, $manufacturer, $country, $volume, $servingtype, $imageURL, $id);

    }

    public function addBeer(\model\Beer $beer) {
        $stmt = $this->conn->prepare("CALL insert_beer(?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt)
            throw new \Exception($this->conn->error);

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
    }

    public function updateBeer(\model\Beer $beer) {
        $stmt = $this->conn->prepare("CALL update_beer(?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt)
            throw new \Exception($this->conn->error);

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

    }

}