<?php
require 'init.php';
require 'classes/hoadon.php';
require 'classes/comment.php';
$hoadon = new hoadon();
$comment = new comment();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDHoaDon = $_POST['IDHoaDonDanhGia'];
    $Rate = $_POST['ratingValue'];
    $NoiDung = $_POST['reviewContent']; 

    if (isset($_SESSION['login_detail'])) {
        $IDNguoiDung  = $_SESSION['user_id'];
    }

    $sanphaminhoadon = $hoadon->show_SanPhamTrongHoaDon($IDHoaDon);
    $product = $sanphaminhoadon->fetch_assoc();
    $IDSanPham = $product['idsp'];
    
    $ThoiGian = date('Y-m-d H:i:s'); 
    $insertDanhGia = $comment->ThemDanhGia($IDNguoiDung,$IDSanPham,$Rate,$NoiDung,$ThoiGian,$IDHoaDon);

    header("Location: donmua.php");
    exit;
}
?>