<?php
require 'init.php'; 


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
    $totalAmount =0;
}

$thongtinnguoidung = $nguoidung->ShowThongTinNguoiDungById($_SESSION['user_id']);
$detailnguoidung = $thongtinnguoidung->fetch_assoc();
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
    if(isset($_POST['ThemHoaDonDiaChiHienTai'])){

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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $NgayLap = date('Y-m-d H:i:s'); 
        $city = $_POST['city2'];
        $district = $_POST['district2'];
        $ward = $_POST['ward2'];
        $housenumber = $_POST['housenumber2'];
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

    const citySelect2 = document.getElementById("city2");
    const districtSelect2 = document.getElementById("district2");
    const wardSelect2 = document.getElementById("ward2");
    const houseNumberInput2 = document.getElementById("housenumber2");

    const shippingFeeDisplay = document.getElementById("shippingFeeDisplay");

    const lala = document.getElementById("idnguoidungdetail").value; 
    const grandTotal= document.getElementById("grandTotal");
    const addressOptionRadios = document.querySelectorAll('input[name="addressOption"]');
    const newAddressForm = document.querySelector('.new-address-form');
    const currentAddressForm = document.querySelector('.current-address-form');
    addressOptionRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.value === 'enterNewAddress') {
                newAddressForm.style.display = 'block';
                currentAddressForm.style.display = 'none';
            } else {
                newAddressForm.style.display = 'none';
                currentAddressForm.style.display = 'block';
                // Gọi hàm để load địa chỉ hiện tại từ CSDL
                loadCurrentAddress();
            }
        });
    });
    function loadCurrentAddress() {
        setTimeout(() => {
        fetch(`yameshop/getNguoiDungById.php?IDNguoiDung=${lala}`)
        .then(response => response.json())
        .then(data => {
            if (data ) {
                const fullAddress = data['DiaChi'];
                const parts = fullAddress.split(',');
                const housenumber = parts[0].trim();
                const ward = parts[1].trim();
                const district = parts[2].trim();
                const city = parts[3].trim();
            
                fetchCityDistrictWard(city, district, ward, housenumber);
            } else {
                console.error('Dữ liệu không hợp lệ.');
            }
            })
            .catch(error => console.error('Lỗi khi tải địa chỉ hiện tại:', error));
        }, 500);
    }
    function fetchCityDistrictWard(city, district, ward, housenumber) {
        setTimeout(() => {
        fetch(`yameshop/getCityByName.php?name=${city}`)
            .then(response => response.json())
            .then(cityData => {
                document.getElementById('city2').value = cityData['id'];
                citySelect2.dispatchEvent(new Event('change'));

                fetchDistrict(cityData['id'], district, ward, housenumber);
            });
        }, 500);
    }
    function fetchDistrict(cityId, district, ward, housenumber) {
        setTimeout(() => {
        fetch(`yameshop/getDistrictByName.php?city_id=${cityId}&name=${district}`)
            .then(response => response.json())
            .then(districtData => {
                document.getElementById('district2').value = districtData['id'];
                districtSelect2.dispatchEvent(new Event('change'));

                fetchWard(districtData['id'], ward, housenumber);
            });
        }, 500);
    }
    function fetchWard(districtId, ward, housenumber) {
        setTimeout(() => {
        fetch(`yameshop/getWardByName.php?district_id=${districtId}&name=${ward}`)
            .then(response => response.json())
            .then(wardData => {
                document.getElementById('ward2').value = wardData['id'];
                wardSelect2.dispatchEvent(new Event('change'));

                document.getElementById('housenumber2').value = housenumber;
            });
        }, 500);
    }
    // function loadCurrentAddress() {
    // fetch(`yameshop/getNguoiDungById.php?IDNguoiDung=${lala}`)
    // .then(response => response.json())
    // .then(data => {
    //     if (data ) {
    //         console.log(data);
    //         console.log(data['DiaChi']);
    //         const fullAddress = data['DiaChi'];
    //         const parts = fullAddress.split(',');
    //         const housenumber = parts[0].trim();
    //         const ward = parts[1].trim();
    //         const district = parts[2].trim();
    //         const city = parts[3].trim();

    //         fetch(`yameshop/getCityByName.php?name=${city}`)
    //         .then(response2 => response2.json())
    //         .then(data2 => {
    //             document.getElementById('city2').value = data2['id'];
    //             citySelect2.dispatchEvent(new Event('change')); 

    //             fetch(`yameshop/getDistrictByName.php?city_id=${data2['id']}&name=${district}`)
    //                 .then(response3 => response3.json())
    //                 .then(data3 => {
    //                     document.getElementById('district2').value = data3['id'];                   
    //                     districtSelect2.dispatchEvent(new Event('change'));
    //                     fetch(`yameshop/getWardByName.php?district_id=${data3['id']}&name=${ward}`)
    //                         .then(response4 => response4.json())
    //                         .then(data4 => {
    //                             document.getElementById('ward2').value = data4['id'];                   
    //                             // districtSelect2.dispatchEvent(new Event('change'));
    //                             wardSelect2.dispatchEvent(new Event('change'));
    //                         });
    //                 });
    //         });
    
    //         // document.getElementById('city2').value = city;
    //         // document.getElementById('district2').value = district;
    //         // document.getElementById('ward2').value = ward;
    //         document.getElementById('housenumber2').value = housenumber;

    //         // citySelect2.dispatchEvent(new Event('change'));
    //         // districtSelect2.dispatchEvent(new Event('change'));


    //     } else {
    //         console.error('Dữ liệu không hợp lệ.');
    //         console.log(data);
    //         console.log(data.Diachi);
    //     }
    // })
    // .catch(error => console.error('Lỗi khi tải địa chỉ hiện tại:', error));
    // }

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
        fetch("yameshop/getCity.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(city => {
                let option = document.createElement("option");
                option.value = city.id;
                option.text = city.name;
                citySelect2.add(option);
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





   
        citySelect2.addEventListener("change", function() {
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
    citySelect2.addEventListener("change", function() {
        districtSelect2.innerHTML = "<option value=''>Chọn quận/huyện</option>";
        wardSelect2.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect2.disabled = true;
        districtSelect2.disabled = false;

        fetch(`yameshop/getDistrict.php?city_id=${citySelect2.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    let option = document.createElement("option");
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect2.add(option);
                });
            });
    });

    // Load wards when district is selected
    districtSelect2.addEventListener("change", function() {
        wardSelect2.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect2.disabled = false;

        fetch(`yameshop/getWard.php?district_id=${districtSelect2.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(ward => {
                    let option = document.createElement("option");
                    option.value = ward.id;
                    option.text = ward.name;
                    wardSelect2.add(option);
                });
            });
    });
    wardSelect2.addEventListener("change", function() {
            houseNumberInput2.disabled = false;
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
    <div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">

<div class="container text-center mt-4">
    <div class="row">
        <div class="col-sm-12 " style="background-color: #e9ecef;">
            <div class="breadcrumb" style="margin-top: 10px;">
                <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Thông tin giao hàng</strong>
                </div>
        </div>

    </div>   
    <div class="row">
        <div class="col-12 text-center">
        <br>
        <h3>Bạn chưa chọn sản phẩm để thanh toán.</h3>
        <div>
            <img src="images/giohangrong.png" alt="">
        </div >
            <p>Hãy nhanh tay chọn ngay sản phẩm yêu thích.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div style="width: 200px;">
            <a href="cartuser.php" class="btn btn-warning fw" style="width:100%;">Giỏ hàng</a> 
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
            <strong class="text-black">Thông tin giao hàng</strong>
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
                                    <a href="#" style="font-size:14px;text-decoration: none;color:black"><?=$product['TenSanPham']?>- <?=$product['TenMau']?>, <?=$product['TenSize']?></a>
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
               
                <label for="addressOption"> <h4 style="text-transform:uppercase;">Chọn phương thức giao hàng:</h4></label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="useCurrentAddress" name="addressOption" value="useCurrentAddress">
                    <label class="form-check-label" for="useCurrentAddress">Sử dụng địa chỉ hiện tại</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="enterNewAddress" name="addressOption" value="enterNewAddress" checked>
                    <label class="form-check-label" for="enterNewAddress">Nhập lại địa chỉ mới</label>
                </div>
            </div>  

        <div class=" new-address-form" style="line-height: 2.5;">
            <h4 style="text-transform:uppercase;">Địa chỉ mới</h4>
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
                        <span> <i class="fa-solid fa-circle-dot" style="color: #338dbc;"></i></span> Nhận hàng tại nhà/công ty/bưu điện
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
                    <textarea rows="2" class="form-control" id="txtNote" name="txtNote" ></textarea>
                </div>
                <div class="form-group">
                    <div class="flex-fill mb-0">
                        <label>Phương thức thanh toán</label>
                        <div class="content-box" style="border: 1px solid #ccc; padding: 10px;">
                            <div class="radio-wrapper content-box-row">
                                <label class="radio-label" for="payment_method_id_941686">
                                    <div class="radio-container" style="display: flex; justify-content: space-between; align-items: center;">
                                      <span> <i class="fa-solid fa-circle-dot" style="color: #338dbc;"></i></span>
                                        <img class="main-img" style="margin-left: 10px;" src="https://hstatic.net/0/0/global/design/seller/image/payment/cod.svg?v=6">
                                        <span class="radio-label-primary" style="margin-left: 10px;">Thanh toán khi giao hàng (COD)</span>
                                        <span class="quick-tagline hidden"></span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="ThemHoaDon" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" fdprocessedid="745y">Đặt hàng</button>
            </form>
            

            <hr>
            <a href="cartuser.php" class="btn btn-warning fw" style="width:100%;">Cần sản phẩm khác? Chọn thêm...</a>
        </div>
        <div class=" current-address-form" style="line-height: 2.5;display: none;">
            <h4 style="text-transform:uppercase;">Địa chỉ hiện tại</h4>
            <form name="ThemHoaDonDiaChiHienTai" action="" method="POST">
                <input name="__RequestVerificationToken" type="hidden" value="VtXJhrH_4rfgzUc7l0eplSyx6Jz9KkPejoEODV2PPsdrcdt2xssxRJ3I-lkvYF5EiEQOFMizrOPD5-F2Kwjw6Aw5XbTXGdK1sL5nXmikEX01">
                <input id="idnguoidungdetail" type="hidden" value='<?=$detailnguoidung['IDNguoiDung'] ?>'>
                <div class="form-group">
                    <label for="userName">Họ và tên</label>
                    <input type="text" class="required form-control" value='<?=$detailnguoidung['TenNguoiDung'] ?>' id="userName" name="userName" placeholder="Tên người nhận" fdprocessedid="0pn2sf">
                </div>
                <div class="form-group">
                    <label for="Phone">Số điện thoại </label>
                    <input type="text" class="required form-control"  value='<?=$detailnguoidung['SDT'] ?>' id="Phone" name="Phone" placeholder="Số điện thoại" fdprocessedid="90fv7">
                </div>
                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="text" class="required form-control" value='<?=$detailnguoidung['Email'] ?>' id="userEmail" name="userEmail" placeholder="Email" fdprocessedid="90fv7">
                </div>
                <div>
                    <div class="radio">
                        <label>
                        <span> <i class="fa-solid fa-circle-dot" style="color: #338dbc;"></i></span> Nhận hàng tại nhà/công ty/bưu điện
                        </label>
                    </div>
                </div>
                <div class="row">
                                            <div class="form-group col-md-4">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="city2">Tỉnh/Thành phố</label>
                                                    <select id="city2" class="form-control" name="city2" required >
                                                        <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                                    </select>
                                                    <span class="text-danger" style="color:red"><?= $errorscity?></span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="district2">Quận/Huyện</label>
                                                    <select id="district2" class="form-control" name="district2" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsdistrict?></span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="ward2">Xã/Phường</label>
                                                    <select id="ward2" class="form-control" name="ward2" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsward?></span>
                                                </div>
                                            </div>
                                        </div> 
                                            <div class="form-group ">
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="housenumber2">Tên đường, tòa nhà, số nhà</label>
                                                    <input type="text" id="housenumber2" class="form-control" name="housenumber2" required disabled>
                                                    <span class="text-danger" style="color:red"><?= $errorshousenumber?></span>
                                                </div>
                                            </div>
                                                                     
                <div class="form-group">
                    <label for="txtNote">Ghi chú</label>
                    <textarea rows="2" class="form-control" id="txtNote" name="txtNote" ></textarea>
                </div>
                <div class="form-group">
                    <div class="flex-fill mb-0">
                        <label>Phương thức thanh toán</label>
                        <div class="content-box" style="border: 1px solid #ccc; padding: 10px;">
                            <div class="radio-wrapper content-box-row">
                                <label class="radio-label" for="payment_method_id_941686">
                                    <div class="radio-container" style="display: flex; justify-content: space-between; align-items: center;">
                                      <span> <i class="fa-solid fa-circle-dot" style="color: #338dbc;"></i></span>
                                        <img class="main-img" style="margin-left: 10px;" src="https://hstatic.net/0/0/global/design/seller/image/payment/cod.svg?v=6">
                                        <span class="radio-label-primary" style="margin-left: 10px;">Thanh toán khi giao hàng (COD)</span>
                                        <span class="quick-tagline hidden"></span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="ThemHoaDonDiaChiHienTai" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" fdprocessedid="745y">Đặt hàng</button>
            </form>
            

            <hr>
            <a href="cartuser.php" class="btn btn-warning fw" style="width:100%;">Cần sản phẩm khác? Chọn thêm...</a>
        </div>

        </div>




    </div>
</div>
<?php endif; ?>
<?php 
	include 'inc/footer.php';
	
 ?>