<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$IDSanPham = $_GET['IDSanPham'];

$sql = $conn->prepare("SELECT * FROM sanpham WHERE IDSanPham = ?");
$sql->execute([$IDSanPham]);
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$product) {
    foreach ($product as $key => &$value) {
        $value = strip_tags($value);
        $value = str_replace(array("\r", "\n"), '', $value);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>