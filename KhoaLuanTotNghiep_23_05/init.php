<?php 
    // Khởi động session
session_start();

// Kiểm tra nếu session tồn tại
if(isset($_SESSION['last_activity'])) {
    // Thời gian hiện tại
    $now = time();
    // Thời gian của session trước đó
    $session_last_activity = $_SESSION['last_activity'];
    // Số giây mà session được phép tồn tại (30 phút)
    $session_timeout = 3600;

    // Nếu thời gian hiện tại trễ hơn thời gian của session trước đó cộng thêm thời gian timeout
    if($now > ($session_last_activity + $session_timeout)) {
        // Xóa hết dữ liệu của session
        session_unset();
        // Xóa session cookie
        session_destroy();
    } else {
        // Nếu session vẫn còn hợp lệ, cập nhật thời gian của session
        $_SESSION['last_activity'] = $now;
    }
} else {
    // Nếu session không tồn tại, thiết lập thời gian hiện tại cho session
    $_SESSION['last_activity'] = time();
}
?>