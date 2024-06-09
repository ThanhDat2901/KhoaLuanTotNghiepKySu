<?php
// cancel_order.php
require 'init.php';
require 'classes/hoadon.php';
$hoadon = new hoadon();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDHoaDon = $_POST['IDHoaDon'];
    $LyDoHuy = $_POST['LyDoHuy'];
    // Thực hiện cập nhật trạng thái đơn hàng trong cơ sở dữ liệu

    $huydonhang= $hoadon->HuyDonHang($IDHoaDon,$LyDoHuy);
    // if ($huydonhang) {
    //     // echo "Đơn hàng đã được hủy thành công";
    //     header("Location: donmua.php");
    //     exit; 
    // } else {
    //     echo "Lỗi: ";
    // }
    header("Location: donmua.php");
    exit;
}
?>