<?php
// Include file chứa class KM
include '../classes/product.php';
// Tạo một đối tượng của lớp product
$product = new product();

// Kiểm tra nếu tồn tại dữ liệu GiaDau và IDKhuyenMai từ yêu cầu POST
if (isset($_POST['GiaDau']) && isset($_POST['IDKhuyenMai']) && !empty($_POST['GiaDau']) && !empty($_POST['IDKhuyenMai'])) {
    // Lấy giá trị GiaDau và IDKhuyenMai từ yêu cầu POST
    $GiaDau = $_POST['GiaDau'];
    $IDKhuyenMai = $_POST['IDKhuyenMai'];

    // Gọi hàm tính toán giá sau khi khuyến mãi từ class hoặc thực hiện tính toán trực tiếp tại đây
    // Ví dụ: $GiaCuoi = calculateDiscountedPrice($GiaDau, $IDKhuyenMai);
    $GiaCuoi = calculateDiscountedPrice($product, $GiaDau, $IDKhuyenMai);
    // Trả về kết quả giá sau khi khuyến mãi
    echo $GiaCuoi;
} else {
    // Trường hợp không có dữ liệu GiaDau hoặc IDKhuyenMai từ yêu cầu POST hoặc chúng rỗng
    echo "Không có dữ liệu hợp lệ để tính toán.";
}

// Hàm tính toán giá sau khi khuyến mãi, bạn cần thay thế hàm này bằng hàm thực sự của bạn
function calculateDiscountedPrice($product, $GiaDau, $IDKhuyenMai) {
    $TienKhuyenMai = $product->getdiscountbyId($IDKhuyenMai);
    $GiaCuoi = $GiaDau - ($GiaDau * $TienKhuyenMai / 100);
    return $GiaCuoi;
}
?>