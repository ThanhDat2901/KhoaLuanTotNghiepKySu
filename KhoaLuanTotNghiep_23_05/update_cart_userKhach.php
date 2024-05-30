<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId']) && isset($_POST['action'])) {
    $IDChiTiet = $_POST['productId'];
    $action = $_POST['action'];

    if ($action === 'increase') {
        // Tăng số lượng sản phẩm
        if (isset($_SESSION['cart'][$IDChiTiet])) {
            $_SESSION['cart'][$IDChiTiet]['SoLuong']++;
            echo 'success';
        }
    } elseif ($action === 'decrease') {
        // Giảm số lượng sản phẩm
        if (isset($_SESSION['cart'][$IDChiTiet]) && $_SESSION['cart'][$IDChiTiet]['SoLuong'] > 1) {
            $_SESSION['cart'][$IDChiTiet]['SoLuong']--;
            echo 'success';
        }
    }


    // header('Location: cart.php'); 
} else {
    http_response_code(400);
    echo 'Invalid request';
}
?>