<?php
include('connect.php');
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
$offset = ($page - 1) * $pageSize;
$sql = $conn->prepare("SELECT * FROM sanpham where isdel=0 LIMIT '$offset', '$pageSize'");
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