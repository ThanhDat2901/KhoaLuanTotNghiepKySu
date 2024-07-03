<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDNguoiDung = $_GET['IDNguoiDung'];
    $TenNguoiDung = $_GET['TenNguoiDung'];
    $SDTMoi = $_GET['SDT'];

    $connect->query("UPDATE thongtinnguoidung
                    SET TenNguoiDung = '$TenNguoiDung', SDT = '$SDT'
                    WHERE IDNguoiDung = '$IDNguoiDung'");

    // Để gửi phản hồi thành công về phía client
    echo json_encode(array('status' => 'success', 'message' => 'Information updated successfully'));
?>