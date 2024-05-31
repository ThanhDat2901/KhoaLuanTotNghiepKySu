<?php
require 'init.php'; 
require 'classes/nguoidung.php';
require 'classes/hinhanh.php';
require 'classes/hoadon.php';
require 'classes/chitiethoadon.php';
require 'classes/giohang.php';
require 'classes/product.php';
$gh = new giohang();
$nguoidung = new nguoidung();
$hoadon = new hoadon();
$chitiethoadon = new chitiethoadon();
$ha = new hinhanh();
$pr = new product();

if(isset($_SESSION['login_detail'])){
    $IDNguoiDung=$_SESSION['user_id'];
    $soluongsanphamtronggiohang = $gh->DemSoLuongSanPhamTrongGioHangByNguoiDung($_SESSION['user_id']);
}

// $perPage = 4;
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $offset = ($page - 1) * $perPage;
// $limit = $perPage;
// $data = $gh->DanhSachSanPhamGioHangPhanTrang($IDNguoiDung,$limit, $offset);
// $totalProducts = $gh->countAll($IDNguoiDung);
// $totalPages = ceil($totalProducts / $perPage);

$data = $gh->DanhSachSanPhamGioHangKhongPhanTrang($IDNguoiDung);
function calculateTotal($cart, $pr)
{
    $total = 0;
    foreach ($cart as $item) {
        if (isset($item['IDChiTiet']) && !empty($item['IDChiTiet'])) {
        $product = $pr->getproductbyIdChiTietSanPham($item['IDChiTiet'])->fetch_assoc();
        $total += $product['GiaCuoi'] * $item['SoLuong'];
        }
    }
    return $total;
}


if($_SERVER["REQUEST_METHOD"]  == "POST"){



}


?>

<?php include 'inc/header.php' ;?>  
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const shippingFeeDisplay = document.getElementById("shippingFeeDisplay");
    const grandTotal= document.getElementById("grandTotal");
    const totalPrice= document.getElementById("totalPrice");
    


    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="product_checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            
        });
        updateSelectedProductCount();
        updateTotal();
    });

    const checkboxes = document.querySelectorAll('input[name="product_checkbox"]');
    const selectedProductCount = document.getElementById("selectedProductCount");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedProductCount();
            updateTotal();
            // let count = document.querySelectorAll('input[name="product_checkbox"]:checked').length;
            // selectedProductCount.textContent = " Tổng thanh toán ("+count+ " sản phẩm):";
        });
    });

    document.getElementById('delete-selected').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('input[name="product_checkbox"]:checked');
    if (checkboxes.length > 0) {
        if (confirm('Bạn có chắc chắn muốn xóa các sản phẩm đã chọn?')) {
            const id = [];
            checkboxes.forEach(checkbox => {
                id.push(checkbox.value);
            });
            // Gửi yêu cầu AJAX để xóa sản phẩm
            $.ajax({
                url: 'remove_from_cart.php',
                type: 'POST',
                data: {id: id}, 
                success: function(response) {
                    // Nếu xóa thành công, tải lại trang
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi khi xóa sản phẩm.');
                }
            });
        }
    } else {
        alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
    }
});

    });
    function updateTotal() {
        var checkboxes = document.querySelectorAll('input[name="product_checkbox"]:checked');
        var total = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            var row = checkboxes[i].closest('tr');
            var priceElement = row.querySelector('.product_price');
            if (priceElement) {

                var priceString = priceElement.textContent.trim().replace(/[\.,]/g, '');
                var price = parseInt(priceString);
                total += price;
            }
        }
        totalPrice.innerHTML =  formatCurrency2(total) +'<span style="font-size: smaller; vertical-align: super;">đ</span>';
    }
    function formatCurrency2(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function updateSelectedProductCount() {
        let count = document.querySelectorAll('input[name="product_checkbox"]:checked').length;
        selectedProductCount.textContent = "Tổng thanh toán (" + count + " sản phẩm):";
    }
    function changeQuantity(productId, action) {
        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {productId: productId, action: action},
            success: function(response) {
                // Nếu cập nhật thành công, tải lại trang
                location.reload();
            }
        });
    }
    function confirmRemoval(itemId) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('id' + itemId).submit();
        }
    });
}

</script>

<div id="about" class="shop" style="margin-top:10vh">
<?php if(empty($data)): ?>
    <div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">

<div class="container text-center mt-4">
    <div class="row">
        <div class="col-sm-12 " style="background-color: #e9ecef;">
            <div class="breadcrumb" style="margin-top: 10px;">
                <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Quản lý giỏ hàng </strong>
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
    

<div class="container mb-4">
    <div class="row">
    <div class="col-sm-12 " style="background-color: #e9ecef;">
        <div class="breadcrumb" style="margin-top: 10px;">
            <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Thông tin giỏ hàng của bạn</strong>
            </div>
    </div>
    </div>
    <div class="row" style="margin-top: 2vh;">

        <div class="col-sm-12 ">
            <h4 style="text-transform:uppercase;">Chi tiết giỏ hàng</h4>         
                <table class="table table-xl table-hover" style="table-layout: fixed;">
                    <thead>
                        <tr>
                        <th scope="col" style="width: 150px;text-align: center; vertical-align: middle;">Hình ảnh </th>
                        <th scope="col"  style="width: 450px;text-align: center; vertical-align: middle;">Tên sản phẩm</th>
                        <th scope="col" style="text-align: center; vertical-align: middle;width: 200px;">Đơn giá</th>
                        <th scope="col"style="text-align: center; vertical-align: middle;">Số lượng</th>
                        <th scope="col"style="text-align: center; vertical-align: middle;">Số tiền</th>
                        <th scope="col"style="text-align: center; vertical-align: middle;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $item): ?>
                    <?php $product = $pr->getproductbyIdChiTietSanPham($item['IDChiTiet'])->fetch_assoc(); ?>
                        <tr>
                            <td  style="text-align: center;">
                                <input type="checkbox" name="product_checkbox" value="<?=$product['IDChiTiet']?>" style="vertical-align: middle;transform: scale(1.7);">
                                <img class="img" src="<?=$product['HinhAnh']?>" style="width: 70px;height: 100px;" alt="#">
                            </td>
                            <td style="vertical-align: middle;">

                                    <a href="detail.php?id=<?=$product['IDSanPham']?>" style="font-size:14px;text-decoration: none;color:black"><?=$product['TenSanPham']?>- <?=$product['TenMau']?>, <?=$product['TenSize']?></a>

                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                            <?php if ($product['GiaCuoi'] < $product['GiaDau']) {

                                    echo '<span>' . 
                                            '<span style="color: red;text-decoration: line-through;">' . 
                                                '<span style="font-size: smaller; vertical-align: super;">đ</span>' . 
                                                number_format($product['GiaDau'], 0, ',', '.') . 
                                            '</span>' . 
                                        '</span>' . 
                                        '<span style="margin-left: 10px;">' . // Adding left margin to create space
                                            '<span style="color: black;">' . 
                                                '<span style="font-size: smaller; vertical-align: super;">đ</span>' . 
                                                number_format($product['GiaCuoi'], 0, ',', '.') . 
                                            ' </span>' . 
                                        '</span>';
                               
                                } else {

                                echo '<span style="color: black">' . number_format($product['GiaCuoi'], 0, ',', '.') . ' đ</span>';
                                } ?>

<!-- <span class="text-black"><?=number_format($product['GiaCuoi'], 0, ',', '.')?>đ</span>  -->
                            </td>
                            <td style="text-align: center;vertical-align: middle;">
                                <p class="mb-0">
                                    <span> 
                                    <button class="btn btn-sm btn-outline-dark" onclick="changeQuantity(<?=$item['IDChiTiet']?>, 'decrease')" style="vertical-align: middle;"><i class="fa-solid fa-minus"></i></button>
                                    <span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$item['SoLuong']?></b></span>
                                    <button class="btn btn-sm btn-outline-dark" onclick="changeQuantity(<?=$item['IDChiTiet']?>, 'increase')" style="vertical-align: middle;"><i class="fa-solid fa-plus"></i></button>
                                    </span>
                                </p>
                            </td>
                            <td style="text-align: center;vertical-align: middle;" class="product_price">    
                                <b><?=number_format($product['GiaCuoi'] * $item['SoLuong'], 0, ',', '.')?> <span>đ</span></b>
                            </td>
                            <td style="text-align: center;vertical-align: middle;">
                                <form action="remove_from_cart.php" id="id<?=$item['IDChiTiet']?>" method="POST">
                                    <input type="hidden" name="id" value="<?=$item['IDChiTiet']?>">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmRemoval(<?=$item['IDChiTiet']?>)"><i class="fa-solid fa-trash"></i> Xóa</a>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
            </table>
        </div>
        <!-- <div colspan="9">
            <div class="pagination justify-content-center " style="margin-left:10vh; margin-top:8vh">
                    <?php if ($totalPages > 1) : ?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination d-flex justify-content-center">
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
            </div>
        </div>   -->
    </div>
    
</div>
<?php endif; ?>


    <div id="movable-div" class="text-center text-lg-start bg-white text-black" style="background-color: #ffffff;width: 100%;z-index:999;">
        <div class="container text-center" style="width:100%">
            <div class="">
                <div class="row d-flex " style="height:10vh">
                    <div class="col-2 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
                        <h5>  <input type="checkbox" id="select-all" name="" value="" style="vertical-align: middle;transform: scale(1.7);"> Chọn tất cả(<?=$soluongsanphamtronggiohang?>) </h5>
                	</div>   
                    <div class="col-1 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
                        <h5><button type="button" id="delete-selected" class="btn btn-danger fw" style="width: 100%; height: 50px; text-transform: uppercase; font-size: 20px;">Xóa</button></h5>
                    </div>
                    <div class="col-3 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
                        <h5 id="selectedProductCount"> Tổng thanh toán (0 sản phẩm):</h5>
                	</div>  

                    <div class="col-2 justify-content-start align-items-center m-lg-2  text-align-center text-center">
                        <h5 style="color: red;" id="totalPrice">
                                0<span style="font-size: smaller; vertical-align: super;">đ</span>
                        </h5>
                	</div>  
                    <div class="col-2 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
                        <h5> <button type="" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px;" fdprocessedid="745y">Mua hàng</button></h5>
                	</div>                         
					
                </div>
            </div>

        </div>
    </div>

<?php 
	include 'inc/footer.php';
	
 ?>
