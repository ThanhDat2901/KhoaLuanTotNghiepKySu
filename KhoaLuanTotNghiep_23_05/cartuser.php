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
}

$perPage = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$limit = $perPage;
$data = $gh->DanhSachSanPhamGioHangPhanTrang($IDNguoiDung,$limit, $offset);
$totalProducts = $gh->countAll($IDNguoiDung);
$totalPages = ceil($totalProducts / $perPage);



if($_SERVER["REQUEST_METHOD"]  == "POST"){



}


?>

<?php include 'inc/header.php' ;?>  
<script>
    document.addEventListener("DOMContentLoaded", function() {

    const shippingFeeDisplay = document.getElementById("shippingFeeDisplay");

    const grandTotal= document.getElementById("grandTotal");
    // Load cities


    });
    function changeQuantity(productId, action) {
        // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
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
                                <input type="checkbox" name="product_checkbox" value="<?=$product['IDSanPham']?>" style="vertical-align: middle;transform: scale(1.7);">
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
                            <td style="text-align: center;vertical-align: middle;">    
                                <b><?=number_format($product['GiaCuoi'] * $item['SoLuong'], 0, ',', '.')?> <span>đ</span></b>
                            </td>
                            <td style="text-align: center;vertical-align: middle;">
                                <form action="remove_from_cart.php" id="id<?=$item['IDChiTiet']?>" method="POST">
                                    <input type="hidden" name="id" value="<?=$item['IDChiTiet']?>"> <!-- Changed input name to 'id' -->
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmRemoval(<?=$item['IDChiTiet']?>)"><i class="fa-solid fa-trash"></i> Xóa</a>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
            </table>
        </div>
        <div colspan="9">
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
    </div>  
    </div>
    
</div>
<?php endif; ?>


<div class="text-center text-lg-start bg-white text-black ">
    <div style="background-color: #ffffff;bottom: 0;width: 100%;position:fixed ;z-index:999">
        <div class="container text-center" style="width:100%">
            <div class="">
                <div class="row d-flex " style="height:10vh">
                    <div class="col-2 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
						<a href="index.php"><img src="//res.yame.vn/Content/images/yame-f-logo-white.png?v=20231127_2" alt="Yame.vn" style="width: 170px;margin-top: 2px;margin-left: 10px;"></a>
                    </div>
					<div class="col justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
						<nav class="navbar navbar-expand-lg ">
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                <li class="nav-item dropdown" >
                                                        <a class="nav-link dropdown-toggle" href="#" id="bo-suu-tap-dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bộ Sưu Tập</a>
                                                        <ul class="dropdown-menu" aria-labelledby="bo-suu-tap-dropdown">
                                                        <?php foreach($databosuutap as  $bosuutapitem ):?> 
                                                            <li><a class="dropdown-item white-text" href="danhsachsanphambosuutap.php?id=<?=$bosuutapitem['IDBoSuuTap']?>"><?php echo $bosuutapitem['TenBoSuuTap'] ?></a></li>
                                                            <?php endforeach ;?>
                                                        </ul>
                                                </li>
                                                 <li class="nav-item"  style="margin-left: 10px;">

                                                </li>
									</ul>
									
								</div>
						</nav>
                	</div>
					                    
					
                </div>
            </div>

        </div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
	
 ?>
