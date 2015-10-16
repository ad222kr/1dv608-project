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

        // just some testcode atm
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);
        if (!$stmt) {
            throw new \Exception($this->conn->error);
        }

        $stmt->execute();

        $stmt->bind_result($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingType);

        $ret = array();

        while ($stmt->fetch()) {
            $ret[] = new Beer($id, $name, $abv, $manufacturer, $imageURL, $country, $volume, $servingType);
        }

        return $ret;
    }

}