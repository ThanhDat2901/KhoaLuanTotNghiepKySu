<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDNguoiDung = $_GET['IDNguoiDung'];
    $MatKhau = $_GET['MatKhau'];

    $connect->query("UPDATE thongtinnguoidung
                    SET MatKhau = '$MatKhau'
                    WHERE IDNguoiDung = '$IDNguoiDung'");

    // Để gửi phản hồi thành công về phía client
    echo json_encode(array('status' => 'success', 'message' => 'Password updated successfully'));
?>