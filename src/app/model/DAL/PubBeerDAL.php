<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 17:50
 */

namespace model;

require_once("src/app/model/PubBeerRepository.php");
require_once("src/app/model/PubBeer.php");


class PubBeerDAL extends BaseDAL {

    private static $table = "pub_beer";

    public function __construct() {
        parent::__construct();
    }

    public function getPubBeers() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $stmt->execute();

            $stmt->bind_result($beerID, $pubID, $price);

            $ret = new PubBeerRepository();

            while($stmt->fetch()) {
                $ret->add(new PubBeer($beerID, $pubID, $price));
            }

            return $ret;

        } catch (\DataBaseException $e) {

        }

    }

    public function addPubBeer(PubBeer $pubBeer) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO " . self::$table . " VALUES(?, ?, ?)");

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $pubId = $pubBeer->getPubId();
            $beerId = $pubBeer->getBeerId();
            $price = $pubBeer->getPrice();

            var_dump($pubId);
            var_dump($beerId);
            var_dump($price);

            $stmt->bind_param("ssd", $pubId, $beerId, $price);
            $stmt->execute();
        } catch (\DataBaseException $e) {
            echo $e->getMessage();
        }
    }
}