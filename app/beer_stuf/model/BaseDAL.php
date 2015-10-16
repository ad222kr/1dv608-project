<?php

namespace model;

abstract class BaseDAL {
    /**
     * @var string, key for url to server hosting database
     */
    private static $hostKey = "host";

    /**
     * @var string, key for username to database
     */
    private static $usernameKey = "user";

    /**
     * @var string, key for password to database
     */
    private static $passwordKey = "pass";

    /**
     * @var string, key for database-name
     */
    private static $dbnameKey = "path";

    /**
     * @var mysqli, the connection to the database
     */
    protected $conn;


    public function __construct() {
        $this->conn = $this->getConnection();

    }

    private function getConnection() {
        $url = parse_url(getenv(\Settings::DATABASE_ENV_PATH));

        $host = $url[self::$hostKey];
        $un= $url[self::$usernameKey];
        $pw = $url[self::$passwordKey];
        $db = substr($url[self::$dbnameKey], 1);

        $mysqli = new \mysqli($host, $un, $pw, $db);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }

        return $mysqli;

    }

}