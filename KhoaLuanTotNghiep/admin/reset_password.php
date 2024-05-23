<?php
// Import các file cần thiết
require_once 'classes/nguoidung.php'; // Thay đổi đường dẫn tùy theo cấu trúc của bạn

// Kiểm tra xem có tham số id trong URL không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Lấy ID người dùng từ tham số URL
    $userID = $_GET['id'];

    // Tạo một đối tượng người dùng
    $user = new nguoidung();

    // Gọi phương thức reset mật khẩu
    $resetResult = $user->resetPassword($userID);

    if ($resetResult) {
        // Mật khẩu đã được reset thành công
        echo "Mật khẩu đã được reset thành công.";
    } else {
        // Đã xảy ra lỗi trong quá trình reset mật khẩu
        echo "Đã xảy ra lỗi trong quá trình reset mật khẩu. Vui lòng thử lại sau.";
    }
} else {
    // Nếu không có tham số id trong URL, hiển thị thông báo lỗi
    echo "Không tìm thấy ID người dùng.";
}
?>
