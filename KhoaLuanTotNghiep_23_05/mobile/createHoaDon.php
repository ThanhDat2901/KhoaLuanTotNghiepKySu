<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDNguoiDung = $_GET['IDNguoiDung'];
    $TenNguoiDung = $_GET['TenNguoiDung'];
    $SDT = $_GET['SDT'];
    $Email = $_GET['Email'];
    $DiaChi = $_GET['DiaChi'];
    $GhiChu = $_GET['GhiChu'];
    $ThanhTien = $_GET['ThanhTien'];
    $TrangThai = 1;

    // Lấy ngày hiện tại
    $NgayLap = date("Y-m-d H:i:s");

    // Mặc định isDel là 0
    $isDel = 0;

    $connect->query("INSERT INTO hoadon (IDNguoiDung, TenNguoiDung, SDT, Email, DiaChi, NgayLap, GhiChu, ThanhTien, TrangThai, isDel) 
            VALUES ('$IDNguoiDung', '$TenNguoiDung', '$SDT', '$Email', '$DiaChi', '$NgayLap', '$GhiChu', '$ThanhTien', '$TrangThai', '$isDel')");
