<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$city_id = $_GET['city_id'];
$name  = $_GET['name'];
$likeName = "%$name%";
$sql = $conn->prepare("SELECT * FROM districts WHERE city_id = ? and name LIKE ?");
$sql->execute([$city_id, $likeName]);
$data = $sql->fetch(PDO::FETCH_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
