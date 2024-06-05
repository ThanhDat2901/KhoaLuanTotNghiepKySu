<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$IDNguoiDung  = $_GET['IDNguoiDung'];

$sql = $conn->prepare("SELECT * FROM thongtinnguoidung WHERE IDNguoiDung  = ?");
$sql->execute([$IDNguoiDung]);
$data = $sql->fetch(PDO::FETCH_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>