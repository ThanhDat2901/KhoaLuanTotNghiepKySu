<?php
require 'init.php'; 

// if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
//     echo "Giỏ hàng của bạn đang trống.";
//     exit;
// }


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
<div id="about" class="shop" style="margin-top:10vh">
<?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
    <div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">

<div class="container text-center mt-4">
<div class="row">
    <div class="col-sm-12 " style="background-color: #e9ecef;">
        <div class="breadcrumb" style="margin-top: 10px;">
            <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Thông tin giỏ hàng của bạn</strong>
            </div>
    </div>

</div>   
<div class="row">
    <div class="col-12 text-center">
    <br>
    <h3>Bạn chưa chọn sản phẩm.</h3>
    <div>
        <img src="images/giohangrong.png" alt="">
    </div>
        <p>Hãy nhanh tay chọn ngay sản phẩm yêu thích.</p>
    </div>
</div>

</div>

</div>


<?php else: ?> 
    
    
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
                <td>
                    <a href="remove_from_cart.php?id=<?=$item['IDChiTiet']?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>


</div>
<p>Tổng tiền: <?=number_format(calculateTotal($_SESSION['cart'], $pr), 0, ',', '.')?></p>





<div class="container-fluid mb-4">
    <div class="row">
    <div class="col-sm-12 " style="background-color: #e9ecef;">
        <div class="breadcrumb" style="margin-top: 10px;">
            <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Thông tin giỏ hàng của bạn</strong>
            </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h4 style="text-transform:uppercase;">Chi tiết đơn hàng</h4>
                <table class="table" style="color:#111;">
                    <tbody>
                        <tr>
                            <td rowspan="2" style="width:100px;padding-left:0; padding-right:0;">
                                <img class="img-fluid" src="https://cdn2.yame.vn/pimg/cart-thumb/5a85fcbb-8c58-6800-556d-001ac2f69796.jpg?w=70&amp;h=100&amp;c=true" alt="Áo Sơ Mi Cổ Mở Tay Ngắn Sợi Modal Ít Nhăn Trơn Dáng Rộng Đơn Giản WRINKLE FREE 04">
                                <div>
                                    <form action="/cart/RemoveItem" id="formRemoveItem" method="POST">
                                        <input type="hidden" name="__ProductUpc" value="0022631001">
                                        <a href="javascript:void(0);" class="js-removeFromCart"><span class="icon-delete"></span> Xóa</a>
                                    </form>
                                </div>
                            </td>
                            <td style="padding-left:0; padding-right:0;">
                                <p class="mb-1">
                                    <a href="/shop/Wrinkle-free-vai-khong-can-ui/ao-so-mi-cuban-soi-poly-wrinkle-free-04-0022631?c=Đen" style="font-size:14px;">Áo Sơ Mi Cổ Mở Tay Ngắn Sợi Modal Ít Nhăn Trơn Dáng Rộng Đơn Giản WRINKLE FREE 04 - Đen, S</a>
                                </p>
                                <p class="mb-0">
                                    <span>Số lượng <b>3</b></span> * <span class="text-black">267,000 đ</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:0; padding-right:0;">
                                <div style="display:none;">
                                    <span style="font-size:11px;">Mã giảm giá</span>
                                    <form action="/cart/SetVoucher" method="POST" class="form-inline">
                                        <input type="hidden" name="__ProductUpc" value="0022631001">
                                        <input type="hidden" name="__Qty" value="3">
                                        <div class="form-group mb-2">
                                            <input class="form-control-sm" type="text" placeholder="" style="width:150px;" name="__txtVoucher">
                                        </div>
                                        <button type="submit" class="btn-sm btn-outline-secondary mb-2" style="height:31px;">Thêm mã</button>
                                    </form>
                                </div>
                                = <b>801,000 <span>đ</span></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" style="padding-left:0; padding-right:0;">
                                Giao hàng
                            </td>
                            <td>
                                <div style="font-size:16px; color:#f00;">Miễn phí (-19,000đ)</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" style="padding-left:0; padding-right:0;">
                            Tổng:
                            </td>
                            <td>
                                <div id="grandTotal" style="font-size:16px; color:#f00;"><b>801,000 <span>đ</span></b></div>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6">
            <h4 style="text-transform:uppercase;">Người mua/nhận hàng</h4>
            <form id="formPlaceOrder" action="/cart/PlaceOrder" method="POST">
                <input name="__RequestVerificationToken" type="hidden" value="VtXJhrH_4rfgzUc7l0eplSyx6Jz9KkPejoEODV2PPsdrcdt2xssxRJ3I-lkvYF5EiEQOFMizrOPD5-F2Kwjw6Aw5XbTXGdK1sL5nXmikEX01">
                <div class="form-group">
                    <label for="txtCustomerName">Tên</label>
                    <input type="text" class="required form-control" id="txtCustomerName" name="txtCustomerName" placeholder="Tên người nhận" fdprocessedid="0pn2sf">
                </div>
                <div class="form-group">
                    <label for="txtPhone">Điện thoại liên lạc</label>
                    <input type="text" class="required form-control" id="txtPhone" name="txtPhone" placeholder="Số điện thoại" fdprocessedid="90fv7">
                    <input type="hidden" name="txtEmail" value="" id="txtEmail">
                </div>
                <div>
                    <div class="radio">
                        <label>
                        <input type="radio" name="chosePickupAddress" checked="checked" value="shipToHome">&nbsp;&nbsp;Nhận hàng tại nhà/công ty/bưu điện
                        </label>
                    </div>
                </div>
                <div class="form-group" id="pnlAddress">
                    <input type="text" class="required form-control" id="txtAddressLine" name="txtAddressLine" placeholder="Địa chỉ nhận hàng" fdprocessedid="poq27">
                </div>
                <div class="form-group">
                    <label for="txtNote">Ghi chú</label>
                    <textarea rows="2" class="form-control" id="txtNote" name="txtNote"></textarea>
                </div>
            </form>
            <button class="js-btnPlaceOrder btn btn-info fw" style="width:100%; " fdprocessedid="745y">Đặt hàng</button>
            <hr>
            <a href="/" class="btn btn-warning fw" style="width:100%;">Cần sản phẩm khác? Chọn thêm...</a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php 
	include 'inc/footer.php';
	
 ?>