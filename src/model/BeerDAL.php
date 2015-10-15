<?php

namespace model;

class BeerDAL extends BaseDAL{

    private static $table = "testtable"; // change when real table is setup

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

        $stmt->bind_result($pk, $name);

        $ret = array();

        while ($stmt->fetch()) {
            $ret[] = $name;
        }

        return $ret;
    }

}