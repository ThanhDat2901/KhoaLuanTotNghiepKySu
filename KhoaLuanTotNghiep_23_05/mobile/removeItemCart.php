<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDChiTiet = $_GET['IDChiTiet'];
    $IDNguoiDung = $_GET['IDNguoiDung'];

    $connect->query("DELETE FROM giohang WHERE IDChiTiet = '$IDChiTiet' AND IDNguoiDung = '$IDNguoiDung'");
