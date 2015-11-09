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

/**
 * Class responsible for fetching posts from the relational table pub_beer
 *
 * Class PubBeerDAL
 * @package model
 */

class PubBeerDAL extends BaseDAL {

    /**
     * @var string
     */
    private static $table = "pub_beer";

    public function __construct() {
        parent::__construct();
    }

    /**
     * Gets all posts from the table
     *
     * @return PubBeerRepository
     * @throws \DataBaseException
     * @throws \Exception
     */
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
     * Adds a post to the table
     *
     * @param PubBeer $pubBeer
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function addPubBeer(PubBeer $pubBeer) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO " . self::$table . " VALUES(?, ?, ?)");

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $pubId = $pubBeer->getPubId();
            $beerId = $pubBeer->getBeerId();
            $price = $pubBeer->getPrice();

            $stmt->bind_param("ssd", $pubId, $beerId, $price);
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