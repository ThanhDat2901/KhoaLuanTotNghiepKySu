<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $IDHoaDon = $_GET['IDHoaDon'];
    $LyDoHuy = $_GET['LyDoHuy'];

    // Update TrangThai of hoadon to 7
    $queryUpdateHoaDon = "UPDATE hoadon SET TrangThai = 7, LyDoHuy = '$LyDoHuy' WHERE IDHoaDon = '$IDHoaDon'";

    // Update SoLuong in chitietsanpham by adding SoLuong in chitiethoadon
    $queryUpdateChiTietSanPham = "UPDATE chitietsanpham AS ctsp
        INNER JOIN chitiethoadon AS cthd ON ctsp.IDChiTiet = cthd.IDChiTiet
        SET ctsp.SoLuong = ctsp.SoLuong + cthd.SoLuong
        WHERE cthd.IDHoaDon = '$IDHoaDon'";

    if ($connect->query($queryUpdateHoaDon) === TRUE && $connect->query($queryUpdateChiTietSanPham) === TRUE) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi: " . $connect->error;
    }

    $connect->close();
?>