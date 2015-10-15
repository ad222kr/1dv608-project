<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$url = parse_url(getenv("1DV608_PROJECT_DATABASE_URL"));
var_dump($url);

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);



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



