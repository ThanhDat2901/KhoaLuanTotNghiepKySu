<?php
require 'init.php'; 

// if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
//     echo "Giỏ hàng của bạn đang trống.";
//     exit;
// }

require 'classes/nguoidung.php';
require 'classes/product.php';
require 'classes/hinhanh.php';
require 'classes/phanquyen.php';
require 'classes/hoadon.php';
require 'classes/chitiethoadon.php';
require 'classes/giohang.php';
$nguoidung = new nguoidung();
$phanquyen = new phanquyen();
$hoadon = new hoadon();
$chitiethoadon = new chitiethoadon();
$pr = new product();
$ha = new hinhanh();
$gh = new giohang();
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST['products']) && !empty($_POST['products'])) {
//         $formData = $_POST['products'];
//         // Tiến hành xử lý dữ liệu ở đây
//     } else {
//         $formData="NULL";
//         // Xử lý khi không nhận được dữ liệu
//     }
// }
$totalAmount =0;
if (isset($_SESSION['selected_products']) && !empty($_SESSION['selected_products'])) {

    $formData = $_SESSION['selected_products'];
    function calculateTotal($cart, $pr)
    {
        $total = 0;
        foreach ($cart as $itemParts) {
            $item = explode(',', $itemParts); 
            if (isset($item[0]) && !empty($item[0])) {
            $product = $pr->getproductbyIdChiTietSanPham($item[0])->fetch_assoc();
            $total += $product['GiaCuoi'] * $item[2];
            }
        }
        return $total;
    }
    $totalAmount = calculateTotal($formData, $pr);
} else {
    $formData="NULL";
    $totalAmount =0;
}


  $errorscity='';
  $errorsdistrict='';
  $errorsward='';
  $errorshousenumber='';
  $cleaned_guest_id='';
  if($_SERVER["REQUEST_METHOD"]  == "POST"){
  if(isset($_POST['ThemHoaDon'])){

    if (!isset($_SESSION['login_detail'])) {
        if (!isset($_SESSION['guest_id'])) {
            $_SESSION['guest_id'] = uniqid('guest_', true);
           
        }
    $md5_hash = md5($_SESSION['guest_id']);
    $IDNguoiDung = crc32(substr($md5_hash, 0, 8)); 

    } else {
        $IDNguoiDung  = $_SESSION['user_id'];
    }
    $username = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $Phone = $_POST['Phone'];
    $NgayLap = date('Y-m-d H:i:s'); 
    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $housenumber = $_POST['housenumber'];
    $txtNote = $_POST['txtNote'];
    $bac = range(1, 25);
    $trung = range(26, 44);
    $nam = range(45, 63);
    if (in_array((int)$city, $bac)) {
        $shippingFee = 39000; 
    } elseif (in_array((int)$city, $trung)) {
        $shippingFee = 29000; 
    } elseif (in_array((int)$city, $nam)) {
        $shippingFee = 19000; 
    } else {
        $shippingFee = 0;
    }
    $totalAmount2 = calculateTotal($_SESSION['selected_products'], $pr);
    $Thanhtien = $totalAmount2 + $shippingFee;


    $cityName =$nguoidung->getNameAdressById('cities',$city); 
    $districtName = $nguoidung->getNameAdressById('districts',$district); 
    $wardName = $nguoidung->getNameAdressById('wards',$ward); 
  

        $fullAddress = $housenumber . ', ' . $wardName . ', ' . $districtName . ', ' . $cityName;

        // $insertnguoidung = $nguoidung->insert_nguoidungGuest($IDNguoiDung);
        // if (is_int($insertnguoidung)) {
        //     // $insertphanquyen = $phanquyen->PhanQuyenNguoiDung(3,$insertnguoidung);
        //     $inserthoadon = $hoadon->insert_HoaDonGuest(1,$username,$Phone,$userEmail,$fullAddress,$NgayLap,$txtNote,$Thanhtien);

        //     session_unset();
        //     session_destroy();
        //       header('Location: thanhtoanthanhcong.php'); 
        //     exit();
        // } else {
        //     $error = '$insertnguoidung;';
        // }

            // $insertphanquyen = $phanquyen->PhanQuyenNguoiDung(3,$insertnguoidung);
        $inserthoadon = $hoadon->insert_HoaDonGuest($IDNguoiDung,$username,$Phone,$userEmail,$fullAddress,$NgayLap,$txtNote,$Thanhtien);
        
        // $insertchitiethoadon = $chitiethoadon->insert_ChiTietHoaDonGuest();
        if (isset($_SESSION['selected_products']) && !empty($_SESSION['selected_products'])) {
            foreach ($_SESSION['selected_products'] as $itemParts) {
                $item = explode(',', $itemParts); 
                $insertchitiethoadon = $chitiethoadon->insert_ChiTietHoaDonGuest($inserthoadon,$item[0],$item[2]);
                $xoagiohang = $gh->XoaSanPhamKhoiGioHang($item[0],$IDNguoiDung);
                if ($insertchitiethoadon !== true) {
                }
            }
        }
        // session_unset();
        // session_destroy();
        header('Location: thanhtoanthanhcong.php'); 
        exit();


    }   
  }
?>

<?php include 'inc/header.php' ;?>  
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const citySelect = document.getElementById("city");
    const districtSelect = document.getElementById("district");
    const wardSelect = document.getElementById("ward");
    const houseNumberInput = document.getElementById("housenumber");
    const shippingFeeDisplay = document.getElementById("shippingFeeDisplay");

    const grandTotal= document.getElementById("grandTotal");
    // Load cities
    fetch("yameshop/getCity.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(city => {
                let option = document.createElement("option");
                option.value = city.id;
                option.text = city.name;
                citySelect.add(option);
            });
        });
        // Function to calculate shipping fee based on city ID
        function calculateShippingFee(cityId) {
            let shippingFee = 0;
            const bac = Array.from({length: 25}, (_, i) => i + 1);
            const trung = Array.from({length: 19}, (_, i) => i + 26);
            const nam = Array.from({length: 19}, (_, i) => i + 45);
            if (bac.includes(parseInt(cityId))) {
                shippingFee = 39000; 
            } else if (trung.includes(parseInt(cityId))) {
                shippingFee = 29000; 
            } else if (nam.includes(parseInt(cityId))) {
                shippingFee = 19000; 
            } else{
                shippingFee=0;
            }

            return shippingFee;
        }
        function updateGrandTotal(shippingFee) {
            const grandTotalElement = document.getElementById("grandTotal");
            const currentTotal = parseFloat(grandTotalElement.dataset.total);
            const newTotal = currentTotal + shippingFee;
            grandTotalElement.innerHTML = "<b>" + numberWithCommas(newTotal) + "<span>đ</span></b>";
        }
            // Event listener for city select box
        citySelect.addEventListener("change", function() {
            const selectedCityId = this.value;
            const shippingFee = calculateShippingFee(selectedCityId);

            // Update shipping fee display
            shippingFeeDisplay.innerHTML = numberWithCommas(shippingFee) + " đ";
            
            console.log(shippingFee);
            updateGrandTotal(shippingFee);
        });    
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    // Load districts when city is selected
    citySelect.addEventListener("change", function() {
        districtSelect.innerHTML = "<option value=''>Chọn quận/huyện</option>";
        wardSelect.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect.disabled = true;
        districtSelect.disabled = false;

        fetch(`yameshop/getDistrict.php?city_id=${citySelect.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    let option = document.createElement("option");
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect.add(option);
                });
            });
    });

    // Load wards when district is selected
    districtSelect.addEventListener("change", function() {
        wardSelect.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect.disabled = false;

        fetch(`yameshop/getWard.php?district_id=${districtSelect.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(ward => {
                    let option = document.createElement("option");
                    option.value = ward.id;
                    option.text = ward.name;
                    wardSelect.add(option);
                });
            });
    });
    wardSelect.addEventListener("change", function() {
            houseNumberInput.disabled = false;
        });

    });
    function changeQuantity(productId, action) {
        // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {productId: productId, action: action},
            success: function(response) {
                // Nếu cập nhật thành công, tải lại trang
                console.log(response);
                location.reload();
            },
        });
    }
</script>

<div id="about" class="shop" style="margin-top:10vh">
<?php if (empty($formData)): ?>
    <?php var_dump($formData) ?>
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
    

<div class="container mb-4">
    <div class="row">
    <div class="col-sm-12 " style="background-color: #e9ecef;">
        <div class="breadcrumb" style="margin-top: 10px;">
            <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Thông tin giỏ hàng của bạn</strong>
            <?php var_dump($formData) ?>
            </div>
    </div>
    </div>
    <div class="row" style="margin-top: 2vh;">

        <div class="col-sm-12 col-md-6">
            <h4 style="text-transform:uppercase;">Chi tiết đơn hàng</h4>
                <table class="table" style="color:#111;">
                    <tbody>
                    <?php foreach ($formData as $itemParts): ?>
                        
                    <?php $item = explode(',', $itemParts);    ?>
                    <?php $product = $pr->getproductbyIdChiTietSanPham($item[0])->fetch_assoc(); ?>
                        <tr>
                            <td rowspan="2" style="width:100px;padding-left:0; padding-right:0;">
                                <img class="img" src="<?=$product['HinhAnh']?>" style="width: 70px;height: 100px;" alt="#">
                            </td>
                            <td style="padding-left:0; padding-right:0;">
                                <p class="mb-1">
                                    <a href="detail.php?id=<?=$product['IDSanPham']?>" style="font-size:14px;text-decoration: none;color:black"><?=$product['TenSanPham']?>- <?=$product['TenMau']?>, <?=$product['TenSize']?></a>
                                </p>
                                <p class="mb-0">
                                    <span> Số lượng:               
                                    <span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$item[2]?></b></span>
                                    * <span class="text-black"><?=number_format($product['GiaCuoi'], 0, ',', '.')?>đ</span> </span>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left:0; padding-right:0;">
                                Tạm tính: <b><?=number_format($product['GiaCuoi'] * $item[2], 0, ',', '.')?> <span>đ</span></b>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="text-right" style="padding-left:0; padding-right:0;">
                                Phí vận chuyển
                            </td>
                            <td>
                                <div id="shippingFeeDisplay" style="font-size:16px; color:#f00;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" style="padding-left:0; padding-right:0;">
                            Tổng:
                            </td>
                            <td>

                                <div id="grandTotal" style="font-size:16px; color:#f00;" data-total="<?= $totalAmount?>"><b> <?=number_format($totalAmount, 0, ',', '.')?><span>đ</span></b></div>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6" style="line-height: 2.5;">
            <h4 style="text-transform:uppercase;">Người mua/nhận hàng</h4>
            <form name="ThemHoaDon" action="" method="POST">
                <input name="__RequestVerificationToken" type="hidden" value="VtXJhrH_4rfgzUc7l0eplSyx6Jz9KkPejoEODV2PPsdrcdt2xssxRJ3I-lkvYF5EiEQOFMizrOPD5-F2Kwjw6Aw5XbTXGdK1sL5nXmikEX01">
                <div class="form-group">
                    <label for="userName">Họ và tên</label>
                    <input type="text" class="required form-control" id="userName" name="userName" placeholder="Tên người nhận" fdprocessedid="0pn2sf">
                </div>
                <div class="form-group">
                    <label for="Phone">Số điện thoại </label>
                    <input type="text" class="required form-control" id="Phone" name="Phone" placeholder="Số điện thoại" fdprocessedid="90fv7">
                </div>
                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="text" class="required form-control" id="userEmail" name="userEmail" placeholder="Email" fdprocessedid="90fv7">
                </div>
                <div>
                    <div class="radio">
                        <label>
                        <input type="radio" name="chosePickupAddress" checked="checked" value="shipToHome">&nbsp;&nbsp;Nhận hàng tại nhà/công ty/bưu điện
                        </label>
                    </div>
                </div>
                <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="city">Tỉnh/Thành phố</label>
                                                    <select id="city" class="form-control" name="city" required >
                                                        <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                                    </select>
                                                    <span class="text-danger" style="color:red"><?= $errorscity?></span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="district">Quận/Huyện</label>
                                                    <select id="district" class="form-control" name="district" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsdistrict?></span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="ward">Xã/Phường</label>
                                                    <select id="ward" class="form-control" name="ward" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsward?></span>
                                                </div>
                                            </div>
                                        </div> 
                                            <div class="form-group ">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="housenumber">Tên đường, tòa nhà, số nhà</label>
                                                    <input type="text" id="housenumber" class="form-control" name="housenumber" required disabled>
                                                    <span class="text-danger" style="color:red"><?= $errorshousenumber?></span>
                                                </div>
                                            </div>
                                                                     
                <div class="form-group">
                    <label for="txtNote">Ghi chú</label>
                    <textarea rows="2" class="form-control" id="txtNote" name="txtNote" required></textarea>
                </div>
                <button type="submit" name="ThemHoaDon" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px;" fdprocessedid="745y">Đặt hàng</button>
            </form>
            

            <hr>
            <a href="danhsachsanpham.php" class="btn btn-warning fw" style="width:100%;">Cần sản phẩm khác? Chọn thêm...</a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php 
	include 'inc/footer.php';
	
 ?>