<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$city_id = $_GET['city_id'];

$sql = $conn->prepare("SELECT * FROM districts WHERE city_id = ?");
$sql->execute([$city_id]);

echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
