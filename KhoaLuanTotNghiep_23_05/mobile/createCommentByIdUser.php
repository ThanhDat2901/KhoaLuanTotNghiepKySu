<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDNguoiDung = $_GET['IDNguoiDung'];
    $IDSanPham = $_GET['IDSanPham'];
    $Rate = $_GET['Rate'];
    $NoiDung = $_GET['NoiDung'];
    $IDHoaDon = $_GET['IDHoaDon'];

    $connect->query("INSERT INTO comment (IDNguoiDung, IDSanPham, Rate, NoiDung, ThoiGian, isDel, IDHoaDon)   
            VALUES ('$IDNguoiDung', '$IDSanPham', '$Rate', '$NoiDung', '2024-06-25 09:19:40', '0', '$IDHoaDon')");
            
    echo json_encode(array('status' => 'success', 'message' => 'Comment added successfully'));
?>