<?php

$hostName = "localhost";
$dbUser = "id21920262_vitalik";
$dbPassword = "Politech-vitalik1";
$dbName = "id21920262_politech";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>