<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $TenNguoiDung = $_GET['TenNguoiDung'];
    $SDT = $_GET['SDT'];
    $DiaChi = $_GET['DiaChi'];
    $Email = $_GET['Email'];
    $MatKhau = $_GET['MatKhau'];

    $checkEmailQuery = $connect->query("SELECT * FROM thongtinnguoidung WHERE Email = '" . $Email . "'");
    if ($checkEmailQuery->num_rows > 0) {
        echo "Email đã tồn tại";
    } else {
        $connect->query("INSERT INTO thongtinnguoidung(TenNguoiDung,DiaChi, SDT, Email, MatKhau) VALUES ('" . $TenNguoiDung . "','" . $DiaChi . "','" . $SDT . "','" . $Email . "','" . $MatKhau . "')");
    }
