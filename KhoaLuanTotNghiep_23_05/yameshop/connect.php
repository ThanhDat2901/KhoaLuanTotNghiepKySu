<?php
    $filepath = realpath(dirname(__FILE__));
    include ($filepath.'/../config/config.php');

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dbyameshop";

//  $host   = DB_HOST;
//  $user   = DB_USER;
//  $pass   = DB_PASS;
//  $dbname = DB_NAME;
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
