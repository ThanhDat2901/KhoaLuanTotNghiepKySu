<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDHoaDon = $_GET['IDHoaDon'];
    $LyDoDoi = $_GET['LyDoDoi'];

    $query = "UPDATE hoadon SET TrangThai = 9, LyDoDoi = '$LyDoDoi' WHERE IDHoaDon = $IDHoaDon";

    if ($connect->query($query) === TRUE) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi: " . $connect->error;
    }

    $connect->close();
?>