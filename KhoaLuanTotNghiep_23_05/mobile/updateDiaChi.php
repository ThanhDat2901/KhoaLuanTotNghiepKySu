<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDNguoiDung = $_GET['IDNguoiDung'];
    $DiaChi = $_GET['DiaChi'];

    $connect->query("UPDATE thongtinnguoidung
                    SET DiaChi = '$DiaChi'
                    WHERE IDNguoiDung = '$IDNguoiDung'");

    // Để gửi phản hồi thành công về phía client
    echo json_encode(array('status' => 'success', 'message' => 'Address updated successfully'));
?>