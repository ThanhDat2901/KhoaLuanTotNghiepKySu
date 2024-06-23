<?php
include('connect.php');

$sql = $conn->prepare("SELECT * FROM hoadon where isdel=0");
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>