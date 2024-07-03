<?php
// cancel_order.php
require_once '../init.php';
require '../classes/hoadon.php';
require '../classes/chitiethoadon.php';
require '../classes/chitietsanpham.php';
$hoadon = new hoadon();
$cthd = new chitiethoadon();
$ctsp = new chitietsanpham();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDHoaDon = $_POST['IDHoaDon'];
    $LyDoHuy = $_POST['LyDoHuy'];

    $huydonhang= $hoadon->HuyDonHang($IDHoaDon,$LyDoHuy);
    $datacthd = $cthd->show_ChiTietHoaDon_ByIdHoaDon($IDHoaDon);
    foreach ($datacthd as $item) {
        $updatesoluong = $ctsp->update_chitietsoluongsanpham($item['IDChiTiet'], $item['SoLuong']);
    }
    header("Location: donmua.php");
    exit;
}

?>