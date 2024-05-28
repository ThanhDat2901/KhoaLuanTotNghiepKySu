<?php
// Kết nối đến file init.php hoặc các file cần thiết khác nếu cần
require 'init.php';

// Kiểm tra xem có ID sản phẩm được truyền từ trang HTML không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Nếu không có hoặc trống, chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo lỗi
    header("Location: index.php");
    exit; // Dừng kịch bản PHP
}

// Lấy ID sản phẩm từ tham số GET
$id = $_GET['id'];

// Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
$isFound = false;
foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['IDChiTiet'] == $id) {
        // Nếu tìm thấy sản phẩm, xóa nó khỏi giỏ hàng
        unset($_SESSION['cart'][$key]);
        $isFound = true;
        break; // Dừng vòng lặp khi đã tìm thấy sản phẩm
    }
}

if (!$isFound) {
    // Nếu không tìm thấy sản phẩm, chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo lỗi
    header("Location: index.php");
    exit; // Dừng kịch bản PHP
}

// Chuyển hướng người dùng đến trang giỏ hàng sau khi xóa sản phẩm
header("Location: cart.php");
exit; // Dừng kịch bản PHP
?>