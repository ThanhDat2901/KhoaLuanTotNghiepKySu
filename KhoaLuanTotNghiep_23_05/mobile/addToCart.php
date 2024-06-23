<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDChiTiet = $_GET['IDChiTiet'];
    $IDNguoiDung = $_GET['IDNguoiDung'];
    $SoLuong = $_GET['SoLuong'];

    $connect->query("INSERT INTO giohang(IDChiTiet, IDNguoiDung, SoLuong) VALUES ('" . $IDChiTiet . "','" . $IDNguoiDung . "','" . $SoLuong . "')");
