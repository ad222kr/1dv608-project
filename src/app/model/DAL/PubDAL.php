<?php


namespace model;

require_once("src/app/model/PubRepository.php");

/**
 * Class responsible for fetching data from the pubs table
 *
 * Class PubDAL
 * @package model
 */
class PubDAL extends BaseDAL {

    /**
     * @var string
     */
    private static $table = "pubs";


    public function __construct() {
        parent::__construct();
    }

    /**
     * Gets all the posts
     *
     * @return PubRepository
     * @throws \DataBaseException
     * @throws \Exception
     * @throws \PubAlreadyExistsException
     */
    public function getPubs() {

        try {
            $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);

            if (!$stmt) {
                throw new \DataBaseException($this->conn->error);
            }

            $stmt->execute();

            $stmt->bind_result($id, $name, $address, $webpageURL);

            //TODO: Not return array
            $pubs = new \model\PubRepository();


            while ($stmt->fetch()) {
                $pub = new Pub($name, $address, $webpageURL, $id);
                $pubs->add($pub);
            }

            return $pubs;

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
     * Gets one post by ID
     *
     * @param $id
     * @return mixed
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function getPubByID($id) {

        try {
            $stmt = $this->conn->prepare("SELECT * FROM " . self::$table . "WHERE pubid=?");
            $stmt->bind_param("s", $id);
            if (!$stmt) {
                throw new \DataBaseException($this->conn->error);
            }

            $stmt->execute();

            $stmt->bind_result($id, $name, $address, $webpageURL);

            $stmt->fetch();

            return Pub($id, $name, $address, $webpageURL);
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
     * Inserts a row inte the table pubs
     *
     * @param Pub $pub
     * @throws \DataBaseException
     * @throws \Exception
     */
    public function addPub(Pub $pub) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO " .self::$table. " VALUES(?, ?, ?, ?)");

            if (!$stmt)
                throw new \DataBaseException($this->conn->error);

            $id = $pub->getId();
            $name = $pub->getName();
            $address = $pub->getAddress();
            $webpage = $pub->getWebpageURL();
            $stmt->bind_param("ssss", $id, $name, $address, $webpage);;



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