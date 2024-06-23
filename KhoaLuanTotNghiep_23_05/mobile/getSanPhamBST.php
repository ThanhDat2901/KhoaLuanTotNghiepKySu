<?php
include('connect.php');

$sql = $conn->prepare("SELECT sanpham.*, bosuutap.IDBoSuuTap AS IDBST, bosuutap.TenBoSuuTap AS NAMEBST
                        FROM sanpham
                        INNER JOIN chitietbosuutap ON sanpham.IDSanPham = chitietbosuutap.IDSanPham
                        INNER JOIN bosuutap ON chitietbosuutap.IDBoSuuTap = bosuutap.IDBoSuuTap");
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$product) {
    foreach ($product as $key => &$value) {
        $value = strip_tags($value);
        $value = str_replace(array("\r", "\n"), '', $value);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
