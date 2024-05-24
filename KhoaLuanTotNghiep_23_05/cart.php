<?php
require 'init.php'; // Import các file và khởi tạo đối tượng cần thiết

// Kiểm tra xem session giỏ hàng đã được tạo chưa
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Nếu giỏ hàng trống, bạn có thể chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo
    echo "Giỏ hàng của bạn đang trống.";
    exit;
}


require 'classes/product.php';
require 'classes/hinhanh.php';

$pr = new product();
$ha = new hinhanh();

// Hàm tính tổng số tiền trong giỏ hàng
function calculateTotal($cart, $pr)
{
    $total = 0;
    foreach ($cart as $item) {
        $product = $pr->getproductbyIdChiTietSanPham($item['IDChiTiet'])->fetch_assoc();
        $total += $product['GiaCuoi'] * $item['SoLuong'];
    }
    return $total;
}
?>

<?php include 'inc/header.php' ;?>  
<div id="about" class="shop" style="margin-top:12vh">

    <div class="container">
<table class="table">
    <thead>
        <tr>
            <th scope="col">Tên sản phẩm</th>
			<th scope="col">Tên size</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <?php $product = $pr->getproductbyIdChiTietSanPham($item['IDChiTiet'])->fetch_assoc(); ?>
            <tr>
                <td><?=$product['TenSanPham']?></td>
				<td><?=$product['TenSize']?></td>
                <td><?=$item['SoLuong']?></td>
                <td><?=number_format($product['GiaCuoi'] * $item['SoLuong'], 0, ',', '.')?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>


</div>
<p>Tổng tiền: <?=number_format(calculateTotal($_SESSION['cart'], $pr), 0, ',', '.')?></p>

<?php 
	include 'inc/footer.php';
	
 ?>