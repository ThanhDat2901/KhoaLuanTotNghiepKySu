<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$IDLoai = $_GET['IDLoai'];

$sql = $conn->prepare("SELECT * FROM sanpham,loaisanpham WHERE sanpham.IDLoai = loaisanpham.IDLoai and  sanpham.isdel=0  and loaisanpham.IDLoai= ?");
$sql->execute([$IDLoai]);
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$product) {
    foreach ($product as $key => &$value) {
        $value = strip_tags($value);
        $value = str_replace(array("\r", "\n"), '', $value);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>