<?php
header("Access-Control-Allow-Origin: *");
include('connect.php');

$IDKhuyenMai = $_GET['IDKhuyenMai'];

$sql = $conn->prepare("SELECT * FROM sanpham,chuongtrinhkhuyenmai 
                        WHERE sanpham.IDKhuyenMai = chuongtrinhkhuyenmai.IDKhuyenMai 
                        and sanpham.isDel=0 
                        and chuongtrinhkhuyenmai.IDKhuyenMai = ?");
$sql->execute([$IDKhuyenMai]);
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$product) {
    foreach ($product as $key => &$value) {
        $value = strip_tags($value);
        $value = str_replace(array("\r", "\n"), '', $value);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>