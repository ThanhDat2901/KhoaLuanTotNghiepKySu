<!-- <?php
session_start();

if (isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];
    
    // Cập nhật số lượng sản phẩm trong session cart
    $_SESSION['cart'][$index]['SoLuong'] = $quantity;

    // Trả về thông tin cập nhật nếu cần (ví dụ: tổng tiền mới)
    // echo calculateNewTotal();
}
?> -->


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId']) && isset($_POST['action'])) {
    $productId = $_POST['productId'];
    $action = $_POST['action'];

    if ($action === 'increase') {
        // Tăng số lượng sản phẩm
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['SoLuong']++;
        }
    } elseif ($action === 'decrease') {
        // Giảm số lượng sản phẩm
        if (isset($_SESSION['cart'][$productId]) && $_SESSION['cart'][$productId]['SoLuong'] > 1) {
            $_SESSION['cart'][$productId]['SoLuong']--;
        }
    }

    // Trả về kết quả thành công
    echo 'success';
    header('Location: cart.php'); 
} else {
    // Trả về lỗi nếu yêu cầu không hợp lệ
    http_response_code(400);
    echo 'Invalid request';
}
?>