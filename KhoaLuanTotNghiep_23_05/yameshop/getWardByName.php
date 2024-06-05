<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$district_id = $_GET['district_id'];
$name  = $_GET['name'];
$likeName = "%$name%";
$sql = $conn->prepare("SELECT * FROM wards WHERE district_id = ? and name LIKE ?");
$sql->execute([$district_id, $likeName]);
$data = $sql->fetch(PDO::FETCH_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
