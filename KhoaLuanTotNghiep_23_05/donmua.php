<?php
require 'init.php';


require 'classes/hoadon.php';
require 'classes/comment.php';
$hoadon = new hoadon();
$comment = new comment();
// $chitiethoadon = new chitiethoadon();
if (isset($_SESSION['login_detail'])) {
$IDNguoiDung  = $_SESSION['user_id'];
}

$danhsachhoadonchoxacnhan = $hoadon->DanhSachHoaDonByIDNguoiDung($IDNguoiDung);
$danhsachhoadonchoxacnhan2 = $hoadon->DanhSachHoaDonByIDNguoiDung($IDNguoiDung);
$kiemtrachoxacnhan = $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,1);
$kiemtradaxacnhan = $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,2);
$kiemtrachuanbihang = $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,3);
$kiemtradagiaohangdonvivanchuyen = $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,4);
$kiemtradanggiaohang = $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,5);

$kiemtradagiaohang = $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,6);
$kiemtradahuy= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,7);

$kiemtratrahang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,8);
$kiemtradoihang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,9);
$kiemtraxacnhantrahang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,10);
$kiemtraxacnhandoihang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,11);
$kiemtradonvivanchuyendoitra= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,12);
$kiemtradatrahang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,13);
$kiemtradadoihang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,14);
$kiemtrakhongchapnhantrahang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,15);
$kiemtrakhongchapnhandoihang= $hoadon->KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,16);
// $danhsachhoadonchoxacnhan = $hoadon->DanhSachHoaDonByIDNguoiDung($IDNguoiDung,1);
?>

<?php include 'inc/header.php' ;?>  

<style>
    .nav-link:hover {
    /* background-color: #f0f0f0;  */
    border-radius: 4px; 
    }
    .navbar-nav .nav-link.active {
        border-bottom: 1px solid red;
    }
    #cancelPopup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 500px; 
        z-index: 1000;
    }

    #cancelPopup h3 {
        margin-top: 0;
        text-align: center;
    }
    #cancelPopup h5 {
        text-align: center;
        background-color: #d0ebff; /* Background color */
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }

    #cancelPopup p {
        text-align: center;
    }

    #cancelForm {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    #cancelForm label {
        display: flex;
        align-items: center;
        margin: 5px 0;
        width: 100%;
    }

    #cancelForm input[type="radio"] {
        margin-right: 10px;
    }

    #cancelForm button {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    #cancelForm button:hover {
        background-color: #0056b3;
    }

    #cancelForm button[type="button"]:last-of-type {
        background-color: #6c757d;
    }

    #cancelForm button[type="button"]:last-of-type:hover {
        background-color: #5a6268;
    }


 /* TRẢ HÀNG */
 #cancelPopupTraHang {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 500px; 
        z-index: 1000;
    }

    #cancelPopupTraHang h3 {
        margin-top: 0;
        text-align: center;
    }
    #cancelPopupTraHang h5 {
        text-align: center;
        background-color: #d0ebff; 
        padding: 10px; 
        border-radius: 5px; 
    }

    #cancelPopupTraHang p {
        text-align: center;
    }

    #cancelFormTraHang {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    #cancelFormTraHang label {
        display: flex;
        align-items: center;
        margin: 5px 0;
        width: 100%;
    }

    #cancelFormTraHang input[type="radio"] {
        margin-right: 10px;
    }

    #cancelFormTraHang button {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    #cancelFormTraHang button:hover {
        background-color: #0056b3;
    }

    #cancelFormTraHang button[type="button"]:last-of-type {
        background-color: #6c757d;
    }

    #cancelFormTraHang button[type="button"]:last-of-type:hover {
        background-color: #5a6268;
    }

     /* Đổi HÀNG */
 #cancelPopupDoiHang {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 500px; 
        z-index: 1000;
    }

    #cancelPopupDoiHang h3 {
        margin-top: 0;
        text-align: center;
    }
    #cancelPopupDoiHang h5 {
        text-align: center;
        background-color: #d0ebff; 
        padding: 10px; 
        border-radius: 5px; 
    }

    #cancelPopupDoiHang p {
        text-align: center;
    }

    #cancelFormDoiHang {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    #cancelFormDoiHang label {
        display: flex;
        align-items: center;
        margin: 5px 0;
        width: 100%;
    }

    #cancelFormDoiHang input[type="radio"] {
        margin-right: 10px;
    }

    #cancelFormDoiHang button {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    #cancelFormDoiHang button:hover {
        background-color: #0056b3;
    }

    #cancelFormDoiHang button[type="button"]:last-of-type {
        background-color: #6c757d;
    }

    #cancelFormDoiHang button[type="button"]:last-of-type:hover {
        background-color: #5a6268;
    }
    /*danhgia*/
    #cancelPopupDanhGia {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 500px; 
        z-index: 1000;
    }

    #cancelPopupDanhGia h3 {
        margin-top: 0;
        text-align: center;
    }

    #cancelPopupDanhGia p {
        text-align: center;
    }

    #cancelFormDanhGia {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    #cancelFormDanhGia label {
        display: flex;
        align-items: center;
        margin: 5px 0;
        width: 100%;
    }

    #cancelFormDanhGia input[type="radio"] {
        margin-right: 10px;
    }

    #cancelFormDanhGia button {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    #cancelFormDanhGia button:hover {
        background-color: #0056b3;
    }

    #cancelFormDanhGia button[type="button"]:last-of-type {
        background-color: #6c757d;
    }

    #cancelFormDanhGia button[type="button"]:last-of-type:hover {
        background-color: #5a6268;
    }
    .popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 20px;
    border-radius: 10px;
    z-index: 1000;
    }
    .rating {
    display: inline-block;
    font-size: 0;
    }
    .star {
        width: 30px; /* Định kích thước của hình ảnh sao */
        height: auto;
        cursor: pointer;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll('.star');
        var menuLinks = document.querySelectorAll('.navbar-nav .nav-link');
        let rating3 = 0;
            stars.forEach(star => {
            star.addEventListener('click', function() {
                const clickedValue = parseInt(this.getAttribute('data-value'));
                rating3 = clickedValue;
                stars.forEach(star => {
                        const starValue = parseInt(star.getAttribute('data-value'));
                        if (starValue <= clickedValue) {
                            star.src = './images/ngoisaovang.png'; // Đổi hình ảnh thành màu vàng
                        } else {
                            star.src = './images/ngoisao.png'; // Đổi hình ảnh thành màu xám
                        }
                    });
                });
            });
            // Lặp qua từng thẻ <a> để bắt sự kiện click
            menuLinks.forEach(function(link) {
                // Bắt sự kiện click
                link.addEventListener('click', function(event) {
                    // Lấy ra ID của phần tử cần hiển thị dựa trên thuộc tính data-content-id
                    menuLinks.forEach(function(link) {
                            link.classList.remove('active');
                        });
                    link.classList.add('active');
                    var contentId = link.getAttribute('data-content-id');
                    // Hiển thị phần tử tương ứng và ẩn các phần tử khác
                    showContent(contentId);
                });
            });

            function showContent(contentId) {
                // Lấy ra tất cả các phần tử cần hiển thị hoặc ẩn
                var allContents = document.querySelectorAll('.col .form-xac-nhan, .col .form-chuan-bi, .col .form-giao-hang, .col .form-da-giao-hang, .col .form-da-huy-hang, .col .form-doi-tra-hang');
                // Lặp qua từng phần tử
                allContents.forEach(function(content) {
                    // Ẩn tất cả các phần tử
                    content.style.display = 'none';
                });
                // Hiển thị phần tử có ID tương ứng
                document.querySelector('.' + contentId).style.display = 'block';
            } 
           
    });
    function showPopup(message, duration) {
                var popup = document.getElementById('popup');
                var popupMessage = document.getElementById('popupMessage');
                
                popupMessage.textContent = message;
                popup.style.display = 'block';
                
                setTimeout(function() {
                    popup.style.display = 'none';
                }, duration);
                } 

            function showCancelPopup(IDHoaDon) {
                document.getElementById('IDHoaDon').value = IDHoaDon;
                document.getElementById('cancelPopup').style.display = 'block';
            }

            function closeCancelPopup() {
                document.getElementById('cancelPopup').style.display = 'none';
            }

            function submitCancel() {
                var formData = new FormData(document.getElementById('cancelForm'));

                fetch('huydonhang.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    console.log(response);
                    showPopup('Đơn hàng đã được hủy thành công', 2000);
                    closeCancelPopup();
                    setTimeout(function() {
                        location.reload(); 
                    }, 2500);
                    // location.reload(); 
                })
                .catch(error => console.error('Error:', error));
            }


            /* TRẢ HÀNG */
            function showCancelPopupTraHang(IDHoaDonTraHang) {
                document.getElementById('IDHoaDonTraHang').value = IDHoaDonTraHang;
                document.getElementById('cancelPopupTraHang').style.display = 'block';
            }

            function closeCancelPopupTraHang() {
                document.getElementById('cancelPopupTraHang').style.display = 'none';
            }

            function submitCancelTraHang() {
                var formData = new FormData(document.getElementById('cancelFormTraHang'));
                formData.append('action', 'doi_tra_hang');
                fetch('senemailtrahang.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) 
                .then(data => {
                    console.log(data); 
                    if (data.message) {
                        showPopup(data.message, 3000); 
                        closeCancelPopupTraHang();
                        setTimeout(function() {
                            location.reload(); 
                        }, 3500);
                    } else {
                        console.error('Unexpected response format:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
            }



            /*--------------------------------------------- */
            
            /* Đổi HÀNG */
            function showCancelPopupDoiHang(IDHoaDonDoiHang) {
                document.getElementById('IDHoaDonDoiHang').value = IDHoaDonDoiHang;
                document.getElementById('cancelPopupDoiHang').style.display = 'block';
            }

            function closeCancelPopupDoiHang() {
                document.getElementById('cancelPopupDoiHang').style.display = 'none';
            }

            function submitCancelDoiHang() {
                var formData = new FormData(document.getElementById('cancelFormDoiHang'));
                formData.append('action', 'doi_tra_hang');
                fetch('senemaildoihang.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) 
                .then(data => {
                    console.log(data); 
                    if (data.message) {
                        showPopup(data.message, 3000); 
                        closeCancelPopupDoiHang();
                        setTimeout(function() {
                            location.reload(); 
                        }, 3500);
                    } else {
                        console.error('Unexpected response format:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
            }



            /*--------------------------------------------- */
            function showCancelPopupDanhGia(IDHoaDonDanhGia) {
                document.getElementById('IDHoaDonDanhGia').value = IDHoaDonDanhGia;
                document.getElementById('cancelPopupDanhGia').style.display = 'block';
            }

            function closeCancelPopupDanhGia() {
                document.getElementById('cancelPopupDanhGia').style.display = 'none';
                clearRating();
            }

            // function submitCancelDanhGia() {
                //     var rate = parseFloat(document.querySelector('input[name="rating2"]:checked').value);
                //     var formData = new FormData(document.getElementById('cancelFormDanhGia'));
                //     formData.append('Rate', rate);
                //     fetch('danhgia.php', {
                //         method: 'POST',
                //         body: formData
                //     })
                //     .then(response => response.text())
                //     .then(data => {
                //         console.log(data);
                //         // showPopup('Đơn hàng đã được hủy thành công', 2000);
                //         alert('Đơn hàng đã được đánh gía');
                //         closeCancelPopupDanhGia();
                //         setTimeout(function() {
                //             location.reload(); // Refresh page to update the order list
                //         }, 2500);
                //         // location.reload(); 
                //     })
                //     .catch(error => console.error('Error:', error));
            // }
            function submitCancelDanhGia() {
                const stars = document.querySelectorAll('.star');
                let ratingValue = 0;
                stars.forEach(star => {
                    if (star.getAttribute('src') === './images/ngoisaovang.png') {
                        ratingValue = parseInt(star.getAttribute('data-value'));
                    }
                });

                console.log('Giá trị đánh giá là:', ratingValue);
                if (ratingValue == 0) {
                    showPopup('Vui lòng chọn đánh giá của bạn!', 2000);
                    return;
                }
                var formData = new FormData(document.getElementById('cancelFormDanhGia'));
                formData.append('ratingValue', ratingValue);

                fetch('danhgia.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(rating2);
                    showPopup('Đơn hàng đã được đánh giá', 2000);
                    closeCancelPopupDanhGia();
                    setTimeout(function() {
                        location.reload(); 
                    }, 2500);
                })
                .catch(error => console.error('Error:', error));
            }

            function clearRating() {
                const stars = document.querySelectorAll('.star');
                stars.forEach(star => {
                    star.src = './images/ngoisao.png'; 
                });
            }
</script>
<div id="about" class="shop" style="margin-top:10vh">
    <div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">

        <div class="container text-center mt-4">
            <div class="row">
                <div class="col-sm-12 " style="background-color: #e9ecef;">
                    <div class="breadcrumb" style="margin-top: 10px;">
                        <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
                        <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Đơn mua</strong>
                        </div>
                </div>

            </div>   
            <div class="row">
                <div class="col-12 text-center">

                    <div class="header-bottom container-fluid" style="margin-top: 4vh;">
                        <div class="row">

                        <div class="col-12" style="font-size:20px;background-color: #ffffff;">
                            <div class="">

                                <!-- Bắt đầu Navbar -->
                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                    <div class="container-fluid">

                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        
                                        <div class="collapse navbar-collapse" id="navbarNav">
                                            <ul class="navbar-nav mx-auto"> 
                                                <li class="nav-item"  >
                                                    <a class="nav-link active" href="javascript:;" data-content-id="form-xac-nhan" style="color: black;">Chờ xác nhận</a>
                                                </li>
                                                <li class="nav-item"style="margin-left: 10px;">
                                                    <a class="nav-link" href="javascript:;" data-content-id="form-chuan-bi" style="color: black;">Chờ chuẩn bị hàng</a>
                                                </li>
                                                <li class="nav-item"style="margin-left: 10px;">
                                                    <a class="nav-link" href="javascript:;" data-content-id="form-giao-hang" style="color: black;">Chờ giao hàng</a>
                                                </li>
                                                <li class="nav-item"style="margin-left: 10px;">
                                                    <a class="nav-link" href="javascript:;" data-content-id="form-da-giao-hang" style="color: black;">Đã giao</a>
                                                </li>
                                                <li class="nav-item"style="margin-left: 10px;">
                                                    <a class="nav-link" href="javascript:;" data-content-id="form-da-huy-hang" style="color: black;">Đã hủy</a>
                                                </li>
                                                <li class="nav-item"style="margin-left: 10px;">
                                                    <a class="nav-link" href="javascript:;" data-content-id="form-doi-tra-hang" style="color: black;">Đổi/Trả hàng</a>
                                                </li>
                                                <!-- <li class="nav-item" style="margin-left: 10px;">
                                                    <a class="nav-link" href="javascript:;" id="doi-tra-hang" style="color: black;">Đổi/Trả hàng</a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </nav>

                            </div>
                        </div>

                            
                            
                            <div class="col " style="margin-top: 5vh;">
                                <div class=" form-xac-nhan" style="line-height: 2.5" >
                                    <?php if(!empty($kiemtrachoxacnhan) || !empty($kiemtradaxacnhan)):?>
                                        <?php foreach ($danhsachhoadonchoxacnhan as $datatemp): ?>
                                            <?php if($datatemp['TrangThai']==1): ?>
                                            <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                            <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                    <h4>Đơn hàng đang chờ xác nhận</h4>
                                                </div>
                                            <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr style="border-bottom: 1px ;">
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                        <div>
                                                        
                                                            <button class="js-btnPlaceOrder btn btn-info fw" style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" onclick="showCancelPopup(<?=$datatemp['IDHoaDon']?>)">Hủy đơn hàng</button>
                                                        </div> 
                                                        <div id="cancelPopup">
                                                            <h3>Lý do hủy</h3>
                                                            <form id="cancelForm">
                                                                <input type="hidden" id="IDHoaDon" name="IDHoaDon">
                                                                <h5>Nếu bạn xác nhận hủy, toàn bộ đơn hàng sẽ được hủy. Chọn lý do hủy phù hợp nhất với bạn nhé!</h5>
                                                                <label>
                                                                    <input type="radio" name="LyDoHuy" value="Tôi muốn cập nhập địa chỉ/sdt nhận hàng"> Tôi muốn cập nhập địa chỉ/sdt nhận hàng
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoHuy" value="Tôi muốn thay đổi sản phẩm(kích thước, màu sắc, số lượng...)"> Tôi muốn thay đổi sản phẩm(kích thước, màu sắc, số lượng...) 
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoHuy" value="Tôi tìm thấy chỗ mua khác tốt hơn"> Tôi tìm thấy chỗ mua khác tốt hơn
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoHuy" value="Tôi không có nhu cầu mua nữa"> Tôi không có nhu cầu mua nữa
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoHuy" value="Tôi không tìm thấy lý do hủy phù hợp"> Tôi không tìm thấy lý do hủy phù hợp
                                                                </label>
                                                                <button type="button" onclick="submitCancel()">Xác nhận hủy</button>
                                                                <button type="button" onclick="closeCancelPopup()">Đóng</button>
                                                            </form>
                                                        </div>
                                            </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==2): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4 style="color: #007bff;">Đơn hàng đã được xác nhận</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr style="border-bottom: 1px ;">
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                        <!-- <div>
                                                        
                                                            <button class="js-btnPlaceOrder btn btn-info fw" style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" onclick="showCancelPopup(<?=$datatemp['IDHoaDon']?>)">Hủy đơn hàng</button>
                                                        </div>  -->
                                                </div>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                    <?php if(empty($kiemtrachoxacnhan) && empty($kiemtradaxacnhan)):?>
                                        <div class="" style="height: 500px;display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <div class="" style="margin-bottom: 20px;">
                                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png" alt="">
                                            </div>
                                            <h2 class="">Chưa có đơn hàng</h2>
                                        </div>
                                        
                                        <?php endif ?>
                                    <!-- <form name="ThemHoaDon" action="" method="POST">
                            
                                        <button type="submit" name="ThemHoaDon" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" fdprocessedid="745y">Đặt hàng</button>
                                    </form> -->
                                    
                                  
                                </div>

                                <div class=" form-chuan-bi" style="line-height: 2.5;display: none;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <?php if(!empty($kiemtrachuanbihang)):?>
                                        <?php foreach ($danhsachhoadonchoxacnhan as $datatemp): ?>
                                            <?php if($datatemp['TrangThai']==3): ?>
                                            <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                    <h4>Đơn hàng đang được chuẩn bị</h4>
                                                </div>
                                            <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                            </div>
                                            <?php endif ?>
                                        
                                        <?php endforeach; ?>
                                    <?php endif ?>    
                                    <!-- <form name="ThemHoaDonDiaChiHienTai" action="" method="POST">
                                        <button type="submit" name="ThemHoaDonDiaChiHienTai" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" fdprocessedid="745y">Đặt hàng</button>
                                    </form> -->
                                    <?php if(empty($kiemtrachuanbihang)):?>
                                        <div class="" style="height: 500px;display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <div class="" style="margin-bottom: 20px;">
                                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png" alt="">
                                            </div>
                                            <h2 class="">Chưa có đơn hàng</h2>
                                        </div>
                                        
                                        <?php endif ?>
                                   
                                </div>

                                <div class=" form-giao-hang" style="line-height: 2.5;display: none;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <?php if(!empty($kiemtradanggiaohang) || !empty($kiemtradagiaohangdonvivanchuyen)):?>
                                        <?php foreach ($danhsachhoadonchoxacnhan as $datatemp): ?>
                                            <?php if($datatemp['TrangThai']==4): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                    <h4 style="color: #007bff;">Đơn hàng đã được giao cho đơn vị vận chuyển</h4>
                                                </div>
                                             <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==5): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                    <h4>Đang giao hàng</h4>
                                                </div>
                                             <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                </div>
                                            <?php endif ?>
                                        
                                        <?php endforeach; ?>
                                    <?php endif ?>    
                                    <!-- <form name="ThemHoaDonDiaChiHienTai" action="" method="POST">
                                        <button type="submit" name="ThemHoaDonDiaChiHienTai" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" fdprocessedid="745y">Đặt hàng</button>
                                    </form> -->
                                    <?php if(empty($kiemtradanggiaohang)&&empty($kiemtradagiaohangdonvivanchuyen)):?>
                                        <div class="" style="height: 500px;display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <div class="" style="margin-bottom: 20px;">
                                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png" alt="">
                                            </div>
                                            <h2 class="">Chưa có đơn hàng</h2>
                                        </div>
                                        
                                        <?php endif ?>
                                   
                                </div>
                                <div id="popup" class="popup">
                                    <span id="popupMessage"></span>
                                </div>
                                <div class=" form-da-giao-hang" style="line-height: 2.5;display: none;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <?php if(!empty($kiemtradagiaohang) || !empty($kiemtradadoihang) || !empty($kiemtrakhongchapnhantrahang) || !empty($kiemtrakhongchapnhandoihang)):?>
                                        <?php foreach ($danhsachhoadonchoxacnhan as $datatemp): ?>
                                            <?php if($datatemp['TrangThai']==6): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Hoàn Thành</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php $kiemtra2 = $comment->KiemTraNguoiDungDanhGiaByHoaDon($IDNguoiDung,$data['IDSanPham'],$datatemp['IDHoaDon']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                   
                                                        <?php if($kiemtra2 !=1): ?>
                                                          

                                                            <div >                                   
                                                                <button class="js-btnPlaceOrder btn btn-info fw" style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" onclick="showCancelPopupDanhGia(<?=$datatemp['IDHoaDon']?>)">Đánh giá</button>
                                                                
                                                                    <?php
                                                                    $ngayLap = strtotime($datatemp['NgayLap']);
                                                                    $ngayHienTai = time();
                                                                    $baNgaySau = strtotime('+3 days', $ngayLap);

                                                                    $choPhepTraHang = ($ngayHienTai <= $baNgaySau);
                                                                    ?>
                                                                <?php if ($choPhepTraHang): ?>  
                                                                    <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupTraHang(<?=$datatemp['IDHoaDon']?>)" >Trả hàng</button>
                                                                    <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupDoiHang(<?=$datatemp['IDHoaDon']?>)" >Đổi hàng</button>
                                                                    <?php endif; ?>
                                                                <!-- id="<?=$datatemp['IDHoaDon']?>" -->
                                                            </div>
                                                        <?php else: ?>
                                                            <div style="text-align: left;color: #26aa99;">
                                                                    <h4>Đã đánh giá</h4>
                                                                </div>
                                                        <?php endif ?>   
                                                    <div id="cancelPopupDanhGia">
                                                            <h3>Đánh giá sản phẩm</h3>
                                                            <form id="cancelFormDanhGia">
                                                                <input type="text" id="IDHoaDonDanhGia" name="IDHoaDonDanhGia">
                                                            
                                                                <label>
                                                                    Chất lượng sản phẩm:
                                                                    <div class="rating" id="rating">
                                                                        <img src="./images/ngoisao.png" name="rating2" value="1" data-value="1" class="star" />
                                                                        <img src="./images/ngoisao.png"  name="rating2" value="2"data-value="2" class="star" />
                                                                        <img src="./images/ngoisao.png"  name="rating2" value="3"data-value="3" class="star" />
                                                                        <img src="./images/ngoisao.png"  name="rating2" value="4"data-value="4" class="star" />
                                                                        <img src="./images/ngoisao.png"  name="rating2" value="5"data-value="5" class="star" />
                                                                    </div>
                                                                </label>
                                                                <div>
                                                                    <label for="reviewContent">Nội dung đánh giá:</label>
                                                                    <textarea id="reviewContent" style="resize: none;" name="reviewContent" rows="4" cols="50"></textarea>
                                                                </div>
                                                                <button type="button" onclick="submitCancelDanhGia()">Xác nhận</button>
                                                                <button type="button" onclick="closeCancelPopupDanhGia()">Đóng</button>
                                                            </form>
                                                        </div> 
                                                    <div id="cancelPopupTraHang">
                                                            <h3>Lý do Trả</h3>
                                                            <form id="cancelFormTraHang">
                                                                <input type="hidden" id="IDHoaDonTraHang" name="IDHoaDonTraHang">
                                                                <h5>Chọn lý do</h5>
                                                                <label>
                                                                    <input type="radio" name="LyDoTra" value="Thiếu hàng" checked> Thiếu hàng
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoTra" value="Người bán gửi sai hàng"> Người bán gửi sai hàng
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoTra" value="Hàng lỗi"> Hàng lỗi
                                                                </label>

                                                                <label>
                                                                    <input type="radio" name="LyDoTra" value="Khác với mô tả"> Khác với mô tả
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoTra" value="Hàng giả, nhái"> Hàng giả, nhái
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoTra" value="Hàng nguyên vẹn nhưng không còn nhu cầu"> Hàng nguyên vẹn nhưng không còn nhu cầu
                                                                </label>
                                                                <button type="button" onclick="submitCancelTraHang()">Xác nhận trả hàng</button>
                                                                <button type="button" onclick="closeCancelPopupTraHang()">Đóng</button>
                                                            </form>
                                                    </div>
                                                    <div id="cancelPopupDoiHang">
                                                            <h3>Lý do Đổi</h3>
                                                            <form id="cancelFormDoiHang">
                                                                <input type="hidden" id="IDHoaDonDoiHang" name="IDHoaDonDoiHang">
                                                                <h5>Chọn lý do</h5>
                                                                <label>
                                                                    <input type="radio" name="LyDoDoi" value="Thiếu hàng" checked> Thiếu hàng
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoDoi" value="Người bán gửi sai hàng"> Người bán gửi sai hàng
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoDoi" value="Hàng lỗi"> Hàng lỗi
                                                                </label>

                                                                <label>
                                                                    <input type="radio" name="LyDoDoi" value="Khác với mô tả"> Khác với mô tả
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoDoi" value="Hàng giả, nhái"> Hàng giả, nhái
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="LyDoDoi" value="Thay đổi size, màu"> Thay đổi size, màu
                                                                </label>
                                                                <button type="button" onclick="submitCancelDoiHang()">Xác nhận đổi hàng</button>
                                                                <button type="button" onclick="closeCancelPopupDoiHang()">Đóng</button>
                                                            </form>
                                                    </div>

                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==14): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Đổi hàng thành công</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php $kiemtra2 = $comment->KiemTraNguoiDungDanhGiaByHoaDon($IDNguoiDung,$data['IDSanPham'],$datatemp['IDHoaDon']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                        <?php if($kiemtra2 !=1): ?>
                                                          

                                                          <div >                                   
                                                              <button class="js-btnPlaceOrder btn btn-info fw" style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" onclick="showCancelPopupDanhGia(<?=$datatemp['IDHoaDon']?>)">Đánh giá</button>
                                                              
                                                                  <?php
                                                                  $ngayLap = strtotime($datatemp['NgayLap']);
                                                                  $ngayHienTai = time();
                                                                  $baNgaySau = strtotime('+3 days', $ngayLap);

                                                                  $choPhepTraHang = ($ngayHienTai <= $baNgaySau);
                                                                  ?>
                                                              <?php if ($choPhepTraHang): ?>  
                                                                  <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupTraHang(<?=$datatemp['IDHoaDon']?>)" >Trả hàng</button>
                                                                  <!-- <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupDoiHang(<?=$datatemp['IDHoaDon']?>)" >Đổi hàng</button> -->
                                                                  <?php endif; ?>
                                                              <!-- id="<?=$datatemp['IDHoaDon']?>" -->
                                                          </div>
                                                      <?php else: ?>
                                                          <div style="text-align: left;color: #26aa99;">
                                                                  <h4>Đã đánh giá</h4>
                                                              </div>
                                                      <?php endif ?>  

                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==15): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Không chấp nhận trả hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php $kiemtra2 = $comment->KiemTraNguoiDungDanhGiaByHoaDon($IDNguoiDung,$data['IDSanPham'],$datatemp['IDHoaDon']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                        <?php if($kiemtra2 !=1): ?>
                                                          

                                                          <div >                                   
                                                              <button class="js-btnPlaceOrder btn btn-info fw" style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" onclick="showCancelPopupDanhGia(<?=$datatemp['IDHoaDon']?>)">Đánh giá</button>
                                                              
                                                                  <?php
                                                                  $ngayLap = strtotime($datatemp['NgayLap']);
                                                                  $ngayHienTai = time();
                                                                  $baNgaySau = strtotime('+3 days', $ngayLap);

                                                                  $choPhepTraHang = ($ngayHienTai <= $baNgaySau);
                                                                  ?>
                                                              <?php if ($choPhepTraHang): ?>  
                                                                  <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupTraHang(<?=$datatemp['IDHoaDon']?>)" >Trả hàng</button>
                                                                  <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupDoiHang(<?=$datatemp['IDHoaDon']?>)" >Đổi hàng</button>
                                                                  <?php endif; ?>
                                                              <!-- id="<?=$datatemp['IDHoaDon']?>" -->
                                                          </div>
                                                      <?php else: ?>
                                                          <div style="text-align: left;color: #26aa99;">
                                                                  <h4>Đã đánh giá</h4>
                                                              </div>
                                                      <?php endif ?>  

                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==16): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Không chấp nhận đổi hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php $kiemtra2 = $comment->KiemTraNguoiDungDanhGiaByHoaDon($IDNguoiDung,$data['IDSanPham'],$datatemp['IDHoaDon']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 
                                                        <?php if($kiemtra2 !=1): ?>
                                                          

                                                          <div >                                   
                                                              <button class="js-btnPlaceOrder btn btn-info fw" style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" onclick="showCancelPopupDanhGia(<?=$datatemp['IDHoaDon']?>)">Đánh giá</button>
                                                              
                                                                  <?php
                                                                  $ngayLap = strtotime($datatemp['NgayLap']);
                                                                  $ngayHienTai = time();
                                                                  $baNgaySau = strtotime('+3 days', $ngayLap);

                                                                  $choPhepTraHang = ($ngayHienTai <= $baNgaySau);
                                                                  ?>
                                                              <?php if ($choPhepTraHang): ?>  
                                                                  <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupTraHang(<?=$datatemp['IDHoaDon']?>)" >Trả hàng</button>
                                                                  <button class="js-btnPlaceOrder btn btn-info fw "   style="width:200px; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;"  onclick="showCancelPopupDoiHang(<?=$datatemp['IDHoaDon']?>)" >Đổi hàng</button>
                                                                  <?php endif; ?>
                                                              <!-- id="<?=$datatemp['IDHoaDon']?>" -->
                                                          </div>
                                                      <?php else: ?>
                                                          <div style="text-align: left;color: #26aa99;">
                                                                  <h4>Đã đánh giá</h4>
                                                              </div>
                                                      <?php endif ?> 

                                                </div>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    <?php endif ?>   
                                    <?php if(empty($kiemtradagiaohang) && empty($kiemtradadoihang)&& empty($kiemtrakhongchapnhantrahang) && empty($kiemtrakhongchapnhandoihang)):?>
                                        <div class="" style="height: 500px;display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <div class="" style="margin-bottom: 20px;">
                                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png" alt="">
                                            </div>
                                            <h2 class="">Chưa có đơn hàng</h2>
                                        </div>
                                        
                                        <?php endif ?>
                                   
                                </div>

                                <div class=" form-da-huy-hang" style="line-height: 2.5;display: none;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <?php if(!empty($kiemtradahuy)):?>
                                        <?php foreach ($danhsachhoadonchoxacnhan as $datatemp): ?>
                                            <?php if($datatemp['TrangThai']==7): ?>
                                            <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                    <h4>Đã hủy</h4>
                                                </div>
                                            <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do hủy: <?=$datatemp['LyDoHuy']?></b></div>
                                                        </div> 
                                            </div>
                                            <?php endif ?>
                                        
                                        <?php endforeach; ?>
                                    <?php endif ?>    
                                    <!-- <form name="ThemHoaDonDiaChiHienTai" action="" method="POST">
                                        <button type="submit" name="ThemHoaDonDiaChiHienTai" class="js-btnPlaceOrder btn btn-info fw" style="width:100%; height: 50px;text-transform: uppercase;font-size: 20px; margin-top: 20px;" fdprocessedid="745y">Đặt hàng</button>
                                    </form> -->
                                    <?php if(empty($kiemtradahuy)):?>
                                        <div class="" style="height: 500px;display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <div class="" style="margin-bottom: 20px;">
                                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png" alt="">
                                            </div>
                                            <h2 class="">Chưa có đơn hàng</h2>
                                        </div>
                                        
                                        <?php endif ?>
                                   
                                </div>

                                <div class=" form-doi-tra-hang" style="line-height: 2.5;display: none;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <?php if(!empty($kiemtradoihang)   ||!empty($kiemtratrahang) || !empty($kiemtraxacnhantrahang)  || !empty($kiemtraxacnhandoihang)  || !empty($kiemtradonvivanchuyendoitra) || !empty($kiemtradatrahang)  || !empty($kiemtradadoihang) || !empty($kiemtrakhongchapnhantrahang) || !empty($kiemtrakhongchapnhandoihang)):?>
                                        <?php foreach ($danhsachhoadonchoxacnhan as $datatemp): ?>
                                            <?php if($datatemp['TrangThai']==8): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Chờ xác nhận Trả hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do trả: <?=$datatemp['LyDoTra']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==9): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4> Chờ xác nhận Đổi hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do đổi: <?=$datatemp['LyDoDoi']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==10): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Đã xác nhận yêu cầu Trả hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do trả: <?=$datatemp['LyDoTra']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==11): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4> Đã xác nhận yêu cầu Đổi hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do đổi: <?=$datatemp['LyDoDoi']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==12): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4> Đơn vị vận chuyển đang đến nhận hàng đổi/trả</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==13): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Trả hàng thành công</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do trả: <?=$datatemp['LyDoTra']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==14): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Đổi hàng thành công</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do đổi: <?=$datatemp['LyDoDoi']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==15): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Không chấp nhận trả hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do trả: <?=$datatemp['LyDoTra']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                            <?php if($datatemp['TrangThai']==16): ?>
                                                <div style="line-height: 2.5; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.1); margin-bottom: 15px;padding: 10px;">
                                                    <div style="text-align: right;color: #26aa99;border-bottom: 1px solid black;border-color: inherit;">
                                                        <h4>Không chấp nhận đổi hàng</h4>
                                                    </div>
                                                <?php $datatemp2 = $hoadon->TrangThaiDonHang($IDNguoiDung,$datatemp['TrangThai'],$datatemp['IDHoaDon']); ?>
                                        
                                                <table class="  ">
                                                            <tbody class="" style="text-align: left;">
                                                            <?php foreach ($datatemp2 as $data): ?>
                                                                <tr>
                                                                    <td style="padding: 20px;"> 
                                                                        <img class="img" src="<?=$data['HinhAnh']?>" style="width: 100px;height: 120px;" alt="#">
                                                                    </td>
                                                                    <td >
                                                                        <p class="mb-1">
                                                                            <a href="detail.php?id=<?=$data['IDSanPham']?>" style="font-size:17px;text-decoration: none;color:black"><?=$data['TenSanPham']?></a>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                        <span style="font-size: 16px;"> Phân loại hàng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['TenMau']?>, <?=$data['TenSize']?></b></span> </span>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span style="font-size: 16px;"> Số lượng:<span style="display: inline-block; margin: 0 5px; vertical-align: middle;"> <b><?=$data['SoluongInCTHD']?></b></span> </span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <?php $kiemtra = $comment->KiemTraNguoiDungDanhGia($IDNguoiDung,$data['IDSanPham']) ?>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        
                                                        </table>
    
                                                        <div style="text-align: left;color: black;border-top: 1px solid black;border-color: inherit;">
                                                            <div style="font-size:20px; color:#f00;"><b> Thành Tiền: <?=number_format($datatemp['ThanhTien'], 0, ',', '.')?><span>đ</span></b></div>
                                                            <div style="font-size:18px;"><b> Lý do đổi: <?=$datatemp['LyDoDoi']?></b></div>
                                                        </div> 


                                                </div>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    <?php endif ?>   
                                    <?php if(empty($kiemtradoihang)  && empty($kiemtratrahang) && empty($kiemtraxacnhantrahang) && empty($kiemtraxacnhandoihang) && empty($kiemtradonvivanchuyendoitra) && empty($kiemtradatrahang) && empty($kiemtradadoihang)&& empty($kiemtrakhongchapnhantrahang) && empty($kiemtrakhongchapnhandoihang)):?>
                                        <div class="" style="height: 500px;display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <div class="" style="margin-bottom: 20px;">
                                                <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png" alt="">
                                            </div>
                                            <h2 class="">Chưa có đơn hàng</h2>
                                        </div>
                                        
                                        <?php endif ?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                
                
                
                
                </div>
            </div>

        </div>

    </div>
</div>
<script>
// $(document).ready(function(){
//     $('.doi-tra-hang').click(function(){
//         var idHoaDon2 = this.id;
//         console.log(idHoaDon2);
//         $.ajax({
//             url: 'senemailtrahang.php', // Đường dẫn tới tệp PHP xử lý gửi email
//             type: 'POST',
//             dataType: 'json',
//             data: { action: 'doi_tra_hang',idHoaDon: idHoaDon2 }, // Dữ liệu gửi đi (nếu cần)
//             success: function(response){
//                 alert(response.message);
//             },
//             error: function(xhr, status, error){
//                 console.error(xhr.responseText);
//             }
//         });
//     });
// });


// $(document).ready(function(){
//     $(document).on('click', '.doi-tra-hang', function(){
//         var idHoaDon2 = $(this).data('idHoaDon');
//         console.log(idHoaDon2);
//         $.ajax({
//             url: 'senemailtrahang.php',
//             type: 'POST',
//             dataType: 'json',
//             data: { action: 'doi_tra_hang', idHoaDon: idHoaDon2 },
//             success: function(response){
//                 alert(response.message);
//             },
//             error: function(xhr, status, error){
//                 console.error(xhr.responseText);
//             }
//         });
//     });
// });
</script>
<?php include 'inc/footer.php';?>    