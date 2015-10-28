<?php

namespace model;
require_once("src/common/exceptions/DataBaseException.php");

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

        // Ensure mysqli reporting is setup correctly
        mysqli_report(MYSQLI_REPORT_STRICT);

        $this->conn = $this->getConnection();

    }

    private function getConnection() {
        try {
            $url = parse_url(getenv(\Settings::DATABASE_ENV_PATH));

            $host = $url[self::$hostKey];
            $un= $url[self::$usernameKey];
            $pw = $url[self::$passwordKey];
            $db = substr($url[self::$dbnameKey], 1);


            $mysqli = new \mysqli($host, $un, $pw, $db);
            $mysqli->set_charset("utf8");

            return $mysqli;
        } catch (\mysqli_sql_exception $e) {
            error_log($e->getMessage() - "\n", 3, \Settings::ERROR_LOG);
            if (\Settings::DEBUG_MODE) {
                throw $e;
            } else {
                echo $e->getMessage();
                die();
            }
        }


    }
}