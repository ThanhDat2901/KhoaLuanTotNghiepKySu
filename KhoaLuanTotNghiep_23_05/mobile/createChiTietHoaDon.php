<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDHoaDon = $_GET['IDHoaDon'];
    $IDChiTiet = $_GET['IDChiTiet'];
    $SoLuong = $_GET['SoLuong'];

    $connect->query("INSERT INTO chitiethoadon (IDHoaDon, IDChiTiet, SoLuong)   
            VALUES ('$IDHoaDon', '$IDChiTiet', '$SoLuong')");

    $connect->query("UPDATE chitietsanpham
                        SET SoLuong = SoLuong - '$SoLuong'
                        WHERE IDChiTiet = '$IDChiTiet'");
