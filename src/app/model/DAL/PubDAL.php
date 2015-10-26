<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-16
 * Time: 23:02
 */

namespace model;

require_once("src/app/model/PubRepository.php");


class PubDAL extends BaseDAL {

    private static $table = "pubs"; // change when real table is setup

    public function __construct() {
        parent::__construct();
    }

    public function getPubs() {
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);

        if (!$stmt) {
            throw new \Exception($this->conn->error);
        }

        $stmt->execute();

        $stmt->bind_result($id, $name, $address, $webpageURL);

        //TODO: Not return array
        $pubs = new \model\PubRepository();


        while ($stmt->fetch()) {
            $pub = new Pub($id, $name, $address, $webpageURL);
            $pubs->add($pub);
        }

        return $pubs;

    }

    public function getPubByID($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table . "WHERE pubid=?");
        $stmt->bind_param("s", $id);
        if (!$stmt) {
            throw new \Exception($this->conn->error);
        }

        $stmt->execute();

        $stmt->bind_result($id, $name, $address, $webpageURL);

        $stmt->fetch();

        return new Pub($id, $name, $address, $webpageURL);
    }

}