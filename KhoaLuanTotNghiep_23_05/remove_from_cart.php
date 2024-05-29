<?php
require 'init.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit; 
}

$id = $_GET['id'];

$isFound = false;
foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['IDChiTiet'] == $id) {
        // Nếu tìm thấy sản phẩm, xóa nó khỏi giỏ hàng
        unset($_SESSION['cart'][$key]);
        $isFound = true;
        break; 
    }
}

if (!$isFound) {
    header("Location: index.php");
    exit; 
}

header("Location: cart.php");
exit; 
?>