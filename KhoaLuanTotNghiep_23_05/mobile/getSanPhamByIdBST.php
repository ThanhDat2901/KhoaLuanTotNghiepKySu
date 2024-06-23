<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$IDBoSuuTap = $_GET['IDBoSuuTap'];

$sql = $conn->prepare("SELECT * FROM sanpham,bosuutap,chitietbosuutap 
                        WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
                        and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
                        and sanpham.isdel=0
                        and bosuutap.IDBoSuuTap= ?");
$sql->execute([$IDBoSuuTap]);
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$product) {
    foreach ($product as $key => &$value) {
        $value = strip_tags($value);
        $value = str_replace(array("\r", "\n"), '', $value);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>