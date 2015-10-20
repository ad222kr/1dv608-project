<?php

namespace model;

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

    private static $table = "beers"; // change when real table is setup

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
            $ret[] = new Beer($name, $abv, $manufacturer, $country, $volume, $servingType, $id,  $imageURL);
        }

        return $ret;
    }

    public function getBeerById($beerId) {

        $stmt = $this->conn->prepare("call get_beer_by_id(?)");

        if (!$stmt)
            throw new \Exception($this->conn->error);

        $stmt->bind_param('i', $beerId);

        $stmt->execute();



        $stmt->bind_result($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingtype);
        $stmt->fetch();

        return new Beer($name, $abv, $manufacturer, $country, $volume, $servingtype, $imageURL, $id);

    }

    public function addBeer(\model\Beer $beer) {
        $stmt = $this->conn->prepare("CALL insert_beer(?, ?, ?, ?, ?, ?, ?, @output)");

        if (!$stmt)
            throw new \Exception($this->conn->error);

        $name = $beer->getName();
        $abv = $beer->getAbv();
        $manufacturer = $beer->getBrewery();
        $imageurl = $beer->getImageURL();
        $country = $beer->getCountry();
        $volume = $beer->getVolume();
        $servingType = $beer->getServingType();

        $stmt->bind_param('sdsssds', $name, $abv, $manufacturer, $imageurl, $country, $volume, $servingType);

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

        $stmt->bind_param("isdsssds", $id, $name, $abv, $manufacturer, $imageurl, $country, $volume, $servingType);

        $stmt->execute();

    }

}