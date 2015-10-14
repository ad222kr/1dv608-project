<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set("Europe/Stockholm");

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}


var_dump(getenv("CLEARDB_DATABASE_URL"));
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new \mysqli($server, $username, $password, $db);


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

echo "conn established";

$statement = $conn->prepare("SELECT * FROM testtable");

$statement->execute();

$statement->bind_result($id, $name);

while($statement->fetch()) {
    echo $id;
    echo $name;
}



