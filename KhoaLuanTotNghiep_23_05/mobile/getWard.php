<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$district_id = $_GET['district_id'];

$sql = $conn->prepare("SELECT * FROM wards WHERE district_id = ?");
$sql->execute([$district_id]);

echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
