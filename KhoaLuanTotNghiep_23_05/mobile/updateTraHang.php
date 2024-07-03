<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDHoaDon = $_GET['IDHoaDon'];
    $LyDoTra = $_GET['LyDoTra'];

    $query = "UPDATE hoadon SET TrangThai = 8, LyDoTra = '$LyDoTra' WHERE IDHoaDon = $IDHoaDon";

    if ($connect->query($query) === TRUE) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi: " . $connect->error;
    }

    $connect->close();
?>