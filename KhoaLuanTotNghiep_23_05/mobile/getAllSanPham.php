<?php
include('connect.php');

$sql = $conn->prepare("SELECT * FROM sanpham where isdel=0");
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$product) {
    foreach ($product as $key => &$value) {
        $value = strip_tags($value); 
        $value = str_replace(array("\r", "\n"), '', $value);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>