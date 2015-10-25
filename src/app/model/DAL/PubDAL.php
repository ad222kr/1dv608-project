<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-16
 * Time: 23:02
 */

namespace model;


class PubDAL extends BaseDAL {

    private static $table = "pub"; // change when real table is setup

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
        $pubs = new PubRepository();


        while ($stmt->fetch()) {
            $pubs->add(new Pub($id, $name, $address, $webpageURL));
        }

        return $pubs;

    }

}