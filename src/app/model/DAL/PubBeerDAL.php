<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 17:50
 */

namespace model;


class PubBeerDAL extends BaseDAL {

    private static $table = "pub_beer";

    public function __construct() {
        parent::__construct();
    }

    public function getPubBeers() {
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);

        if (!$stmt)
            throw new \Exception($this->conn->error);

        $stmt->execute();

        $stmt->bind_result($beerID, $pubID, $price);


    }
}