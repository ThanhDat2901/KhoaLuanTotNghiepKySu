

<?php 

require 'init.php' ;   
require 'classes/product.php';
require 'classes/giohang.php';
require 'classes/hinhanh.php';
require 'classes/comment.php';
    $pr = new product();
    $gh = new giohang();
    $ha = new hinhanh();
    $cm = new comment();
     // Lấy thông tin sản phẩm từ URL
     $id = isset($_GET['id']) ? $_GET['id'] : null;
     if (!$id) {
         die("id không hợp lệ.");
     }
     $listAnh = $ha->showListAnhByIdSanPham($id);

     $product_by_id = $pr->getproductbyId($id);
     $product = $product_by_id->fetch_assoc();

     $result_size = $pr->getSizeById($id);

     $perPage = 1;
     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
     $offset = ($page - 1) * $perPage;
     $limit = $perPage;

     $comment = $cm->show_commentSanPham($id);




if(!isset($_SESSION['login_detail'])){
// Hàm kiểm tra xem sản phẩm có tồn tại trong giỏ hàng hay không
    function productExistsInCart($cart, $productId) {
        foreach ($cart as $key => $item) {
            if ($item['IDChiTiet'] == $productId) {
                return $key; 
            }
        }
        return -1; 
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $IDChiTiet = $_POST['IDChiTiet'];
        $SoLuong = $_POST['SoLuong'];


        $availableQuantity = $pr->getAvailableQuantity($IDChiTiet); 
        $index = productExistsInCart($_SESSION['cart'], $IDChiTiet);

        if ($index !== -1) {

            if ($_SESSION['cart'][$index]['SoLuong'] < $availableQuantity) {

                $_SESSION['cart'][$index]['SoLuong'] += $SoLuong;
                
            } else {

                echo "Số lượng sản phẩm trong giỏ hàng vượt quá số lượng còn trong cửa hàng.";
                
            }
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, kiểm tra số lượng mới thêm vào
                $cart_item = array(
                    'IDChiTiet' => $IDChiTiet,
                    'SoLuong' => $SoLuong
                );
                $_SESSION['cart'][] = $cart_item;
                usort($_SESSION['cart'], function($a, $b) {
                    return $a['IDChiTiet'] - $b['IDChiTiet'];
                });
        }
    }
}
else{
    if($_SERVER["REQUEST_METHOD"]  == "POST"){

        $IDChiTiet = $_POST['IDChiTiet'];
        $SoLuong = $_POST['SoLuong'];
        $IDNguoiDung = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
       
        $availableQuantity = $pr->getAvailableQuantity($IDChiTiet); 
        $index = $gh->KiemTraSanPhamTrongGioHang($IDChiTiet,$IDNguoiDung);
        if ($index === 1) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng
            $soluongtronggiohang = $gh->DemSoLuongSanPhamTrongGioHang($IDChiTiet,$IDNguoiDung);

            if ($soluongtronggiohang < $availableQuantity) {
                $capnhapsoluong = $gh->CapNhatSoLuongSanPhamTrongGioHang($IDChiTiet, $IDNguoiDung, $SoLuong);
                
            } else {

                echo "Số lượng sản phẩm trong giỏ hàng vượt quá số lượng còn trong cửa hàng.";              
            }
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, kiểm tra số lượng mới thêm vào
            if ($SoLuong <= $availableQuantity) {
                $giohang = $gh->ThemSanPhamVaoGioHang($IDChiTiet,$IDNguoiDung,$SoLuong);
            } else {

                echo "Số lượng sản phẩm không được lớn hơn số lượng còn trong cửa hàng.";

            }
        }

    }

}
?> 

<?php include 'inc/header.php' ;?>    

<style>
            .custom-btn {
            margin-right: 0.5rem; /* Khoảng cách giữa các button */
            border: 1px solid #ccc; /* Border xám */
            background-color: #fff; /* Nền trắng */
            color: #000; /* Chữ đen */
            font-size: 1.0rem; /* Tăng kích thước chữ */
            padding: 0.75rem 2.25rem; /* Tăng kích thước nút */
        }

        .custom-btn:hover {
            background-color: #f8f9fa; /* Thêm hiệu ứng hover nếu muốn */
        }
    .image-zoom-container {
        position: relative;
        display: inline-block;
    }

    .zoom-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
        overflow: hidden;
    }

    .zoom-overlay img {
        max-width: 100%;
        max-height: 100%;

        cursor: zoom-out;
    }
    .description {
        overflow: hidden;
        max-height: 100px;
        transition: max-height 0.3s ease;
    }

    .description.expanded {
        max-height: none;
    }

    .toggle-button {
        cursor: pointer;
        color: blue;
        text-decoration: underline;
        display: none;
    }
    #size-guide-button {

        border-radius: 0.2rem;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s; 
    }


    #size-guide-button:hover {
        background-color: #000000; 
        color: #ffffff; 
    }
    .notification-popup {
        position: fixed;
        top: 40px;
        right: 20px;
        background-color: #28a745; 
        color: white; 
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        font-size: 16px;
    }
    
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var formElements = document.querySelectorAll('form');

    const buttons = document.querySelectorAll('.btn.custom-btn');
        const comments = document.querySelectorAll('.col-md-12');
        const noCommentsDiv = document.getElementById('no-comments');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                let hasComments = false;
                comments.forEach(comment => {
                    if (rating === 'all') {
                        comment.style.display = 'block';
                        hasComments = true;
                    } else {
                        if (comment.classList.contains('rating-' + rating)) {
                            comment.style.display = 'block';
                            hasComments = true;
                        } else {
                            comment.style.display = 'none';
                        }
                    }
                });
                if (!hasComments) {
                    noCommentsDiv.style.display = 'block';
                } else {
                    noCommentsDiv.style.display = 'none';
                }
            });
        });

    formElements.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var xhr = new XMLHttpRequest();
            var formData = new FormData(form);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var notificationPopup = document.getElementById('notificationPopup');
                    notificationPopup.style.display = 'block';

                    setTimeout(function() {
                        notificationPopup.style.display = 'none';
                    }, 3000); 

                } else {
                    console.error('Request failed');
                }
            };

            xhr.onerror = function() {
                console.error('Request failed');
            };

            xhr.open('POST', '', true);
            xhr.send(formData);
        });
    });



        var swiper = new Swiper(".swiper", {
            effect: "cube",
            grabCursor: true,
            loop: true,
            speed: 1000,
            cubeEffect: {
                shadow: false,
                slideShadows: true,
                shadowOffset: 10,
                shadowScale: 0.94,
            },
            autoplay: {
                delay: 2600,
                pauseOnMouseEnter: true,
            },
        });

        var zoomOverlay = document.getElementById('zoom-overlay');

        document.querySelectorAll('.zoom-trigger').forEach(function(element) {
            element.addEventListener('click', function() {
                var imageSrc = this.getAttribute('src');
                var zoomedImage = document.getElementById('zoomed-image');
                zoomedImage.setAttribute('src', imageSrc);
                zoomOverlay.style.display = 'flex';
            });
        });

        zoomOverlay.addEventListener('click', function() {
            this.style.display = 'none';
        });



        var sizeGuideButton = document.getElementById('size-guide-button');
    var sizeChartOverlay = document.getElementById('size-chart-overlay');

    sizeGuideButton.addEventListener('click', function() {
        // Kiểm tra trạng thái hiển thị của hình ảnh
        var isVisible = getComputedStyle(sizeChartOverlay).display !== 'none';
        
        // Đảo ngược trạng thái hiển thị
        sizeChartOverlay.style.display = isVisible ? 'none' : 'flex';
    });
    sizeChartOverlay.addEventListener('click', function() {
        this.style.display = 'none';
    });




        var toggleButton = document.getElementById('toggle-description');
        var description = document.getElementById('product-description');
        
        if (description.scrollHeight > description.clientHeight) {
            toggleButton.style.display = 'inline';
        }

        toggleButton.addEventListener('click', function() {
            if (description.classList.contains('expanded')) {
                description.classList.remove('expanded');
                toggleButton.textContent = 'Đọc tiếp';
            } else {
                description.classList.add('expanded');
                toggleButton.textContent = 'Ẩn bớt nội dung';
            }
        });
    });
</script>

<div id="about" class="shop" style="margin-top:12vh">
    <div id="notificationPopup" class="notification-popup" style="display: none;">
        Đã cập nhật giỏ hàng thành công!
    </div>

    <div class="container">
        <div class="row">

        <div class="col-md-4" >
        <section>
            <div class="swiper">
                <div class="swiper-wrapper" style="width: 100%;height: 100%;">
                    <div class="swiper-slide" style="width: 100%;height: 100%;">
                        <img class="zoom-trigger" style="width: 100%;height: 100%;cursor: zoom-in;" src="<?=$product['HinhAnh']?>" />
                    </div>
                <?php if (!empty($listAnh)): ?>
                <?php foreach($listAnh as  $listanh ):?> 
                    <div class="swiper-slide"  style="width: 100%;height: 100%;">                    
                        <img class="zoom-trigger" style="width: 100%;height: 100%;cursor: zoom-in;" src="<?=$listanh['LinkHinh']?>" />
                    </div>
                    <?php endforeach ;?>   
                <?php endif; ?> 
                </div>
            </div>
        </section>
        <div id="zoom-overlay" class="zoom-overlay" style="display: none;">
            <img id="zoomed-image" style="margin-top: 10px;" src="#" alt="#">
        </div>


        </div>    
            <div class="col" style="line-height: 2.0;">
                        <h5 style="color: black"><?php echo $product['TenSanPham']?></h5>
                        <span> Mã số: <?php echo $product['IDSanPham']?></span>
                        <span style="color: black; display: flex; align-items: center;">
                            Màu sắc: <?php echo $product['TenMau'] ?> 
                            <div style="width: 20px; height: 20px; background-color: <?php echo $product['MaMau']; ?>; border: 1px solid #000; margin-left: 10px;"></div>
                        </span>

                        <div>
                        <?php if ($product['GiaCuoi'] < $product['GiaDau']) {

                                echo' <h5 class="text-black sale01day" style="line-height:32px; margin-bottom:0px;"><img style="height:24px; margin-bottom:10px;" src="https://toigingiuvedep.vn/wp-content/uploads/2022/06/hinh-sale.jpg">'. $product['TenKhuyenMai']; 
                                echo '<h5><span style="color: black;">Giá gốc: </span>' . '<span style="color: red;text-decoration: line-through;">' . number_format($product['GiaDau'], 0, ',', '.') . '</span> đ</h6>';
                                echo '<h4><span style="color: black">Giá Sale: </span>' . '<span style="color: red">' . number_format($product['GiaCuoi'], 0, ',', '.') . ' </span>đ</h5>';
                                
                                $tietkiem = $product['GiaDau'] - $product['GiaCuoi'];
                                echo '<span style="margin-left: 10px">(Tiết kiệm - ' . number_format($tietkiem, 0, ',', '.') . ' đ)</span>';
                                echo '<p class="text-black mb-1">Giá giảm áp dụng từ ' . date('d/m', strtotime($product['NgayBatDau'])) . ' đến ' . date('d/m/Y', strtotime($product['NgayKetThuc'])) . ' </p>';
                            } else {

                                echo '<h3 style="color: black">Giá: ' . number_format($product['GiaDau'], 0, ',', '.') . ' đ</h3>';
                            } ?>
                        </div>
                        <div style="margin-top: 3vh;"> 
                        <?php if (!empty($result_size)): ?>
                            <?php foreach($result_size as $datasize): ?>   
                                <?php if ($datasize['SoLuong'] > 0): ?> 
                                <form action="" method="post">
                                <input type="hidden" name="IDChiTiet" id="IDChiTiet" value="<?=$datasize['IDChiTiet'] ?>" />
                                <input type="hidden" name="SoLuong" value="1">
                                    <table class="table table-xl table-hover" style="table-layout: fixed;">
                                        <tbody class="table-hover">
                                            <tr>
                                                <td><?=$datasize['TenSize'] ?></td>
                                                <td> <span style="font-weight: bold;"> <?=$datasize['SoLuong'] ?></span> Cửa Hàng còn</td>
                                                <td>
                                                    <button type="submit" id="specialButton" style="text-decoration:none;color:red; background: none; border: none;">
                                                        <i class="fa-solid fa-plus"></i>Chọn mua
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form> 
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <h4 style="color: red;">Sản phẩm đã hết hàng</h4>
                        <?php endif; ?>
                        </div>
                        <div>
                            <button id="size-guide-button" class="btn-outline-dark btn-sm" style="margin-top: 10px;">Hướng dẫn chọn size</button>
                                <div id="size-chart-overlay" class="zoom-overlay" style="display: none;">
                                    <img style="margin-top: 10px; height: 700px; width: 500px;" src="https://cmsv2.yame.vn/uploads/96de2b6a-7cba-42ec-82ab-a80a62693726/size-chart-01.jpg" alt="Size Chart">
                                </div>
                            </div>
                        <div style="margin-top: 5px;">
                            
                            <div id="product-description" class="description">
                                <h4 style="color: black;">Mô tả sản phẩm</h4>
                                <p><?php echo $product['ThongTin']?></p>
                            </div>
                            <span id="toggle-description" class="toggle-button" style="color: red;text-decoration: none;">Đọc tiếp</span>                         
                        </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10vh;">
        <?php if (!empty($listAnh)): ?>
        <?php foreach($listAnh as  $listanh ):?> 
            <div class="col-12 col-md-6 mb-1 px-1 aos-init aos-animate" data-aos="zoom-in">
                <img  class="img-fluid text-center detailImageItem" loading="lazy" src="<?=$listanh['LinkHinh']?>" alt="a87c5f99-8086-9d00-bc52-001a864189a5" style="margin: auto; width: 800px;height: 800px;">
            </div>
            <?php endforeach ;?>      
        <?php endif; ?>
        </div>

            <?php $average_rating = null;  ?>
        <?php if (!empty($comment)): ?>
            <?php     
                $total_rating = 0;
                $num_ratings = $comment->num_rows; 
                ?>
        <?php foreach($comment  as  $commentitem2 ):?> 
                <?php  
                   $total_rating += $commentitem2['Rate'];
                    
                    
                    ?>
            <?php endforeach ;?>    
            <?php $average_rating = $total_rating / $num_ratings; 
            $average_rating = number_format($average_rating, 1);?>  
        <?php endif; ?>

        <div class="row" style="margin-top: 10vh; border: 1px; border-color: inherit;">

        <!-- <div class="col-md-12" style="margin: 20px;">
            
        </div>   -->
        <div class="col-md-3">
            <div class="d-flex align-items-center flex-column">
            <h3>ĐÁNH GIÁ SẢN PHẨM</h3>
            <?php if ($average_rating !== null): ?>
                <h3 class="mr-2"> <?=$average_rating ?> trên 5 </h3>
                <div class="rating">
                    <?php
                    
            $full_stars = floor($average_rating); 
            $fraction = $average_rating - $full_stars;
            $half_star = $fraction >= 0.25 && $fraction <= 0.75 ? 1 : 0;
            $empty_stars = 5 - $full_stars - $half_star; 

            // Display full stars
            for ($i = 0; $i < $full_stars; $i++) {
                echo '<span style="color: #ee4d2d;" class="fa fa-star checked"></span>';
            }
            // Display half star if there is a fractional part
            if ($fraction > 0 && $half_star) {
                echo '<span style="color: #ee4d2d;" class="fa fa-star-half-alt checked"></span>';
            }
            // Display empty stars
            for ($i = 0; $i < $empty_stars; $i++) {
                echo '<span style="color: gray;" class="fa fa-star"></span>'; // Gray color for empty stars
            }
                    ?>
                </div>
                <?php else: ?>
                <p>Chưa có đánh giá.</p>
            <?php endif; ?>
            </div>
        </div>

    <!-- Navbar chứa các nút button -->
    <div class="col-md-9">
    <nav class=" navbar-expand-lg navbar-light">
        <div id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php  $tatca = $cm->countAllCommentByID($id); ?>
                    <button class="btn custom-btn mr-2" data-rating="all">Tất cả (<?=$tatca?>)</button>
                    <!-- <a class="nav-link" href="javascript:;" data-content-id="tat-ca" style="color: black;">Tất cả</a> -->
                </li>
                <li class="nav-item">
                    <?php  $namsao = $cm->countAllCommentByIDAndRate($id,5); ?>
                    <button class="btn custom-btn mr-2" data-rating="5">5 Sao (<?=$namsao?>)</button>
                </li>
                <li class="nav-item">
                <?php  $bonsao = $cm->countAllCommentByIDAndRate($id,4); ?>
                    <button class="btn custom-btn mr-2" data-rating="4">4 Sao (<?=$bonsao?>)</button>
                </li>
                <li class="nav-item">
                <?php  $basao = $cm->countAllCommentByIDAndRate($id,3); ?>
                    <button class="btn custom-btn mr-2" data-rating="3">3 Sao (<?=$basao?>)</button>
                </li>
                <li class="nav-item">
                <?php  $haisao = $cm->countAllCommentByIDAndRate($id,2); ?>
                    <button class="btn custom-btn mr-2" data-rating="2">2 Sao (<?=$haisao?>)</button>
                </li>
                <li class="nav-item">
                <?php  $motsao = $cm->countAllCommentByIDAndRate($id,1); ?>
                    <button class="btn custom-btn" data-rating="1">1 Sao (<?=$motsao?>)</button>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div id="comment-section">
    <?php if (!empty($comment)): ?>
        <?php foreach($comment as $commentitem): ?> 
            <div class="col-md-12  rating-<?php echo $commentitem['Rate']; ?>" style="margin-top: 5vh;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1">
                                <!-- Hiển thị ảnh đại diện của người đánh giá -->
                                <img src="https://tse4.mm.bing.net/th?id=OIP.ggX8e6U3YzyhPvp8qGZtQwHaHa&pid=Api&P=0&h=180" style="width: 50px;height: 50px;" alt="Avatar" class="avatar">
                            </div>
                            <div class="col-md-10">
                                <h5 class="card-title"><?php echo $commentitem['TenNguoiDung']; ?></h5>
                                <div class="rating">
                                    <?php for ($i = 0; $i < $commentitem['Rate']; $i++): ?>
                                        <span class="fa fa-star checked" style="color: #ee4d2d;"></span>
                                    <?php endfor; ?>
                                    <?php for ($i = $commentitem['Rate']; $i < 5; $i++): ?>
                                        <span class="fa fa-star" style="color: gray;"></span>
                                    <?php endfor; ?>
                                </div>
                                <p class="card-text"><small class="text-muted"><?php echo $commentitem['ThoiGian']; ?></small></p>
                                <p class="card-text" style="color: rgba(0, 0, 0, 0.4);">Phân loại hàng: <span style="color: black;"><?php echo $commentitem['TenMau']; ?> </span> </p>
                                <p class="card-text"><?php echo $commentitem['NoiDung']; ?></p>

                                <!-- Hiển thị ngày đánh giá -->
                               
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        <?php endforeach; ?>  
    <?php endif; ?>
    <div id="no-comments" style="display: none;">
        <h4>Chưa có đánh giá cho loại này.</h4>
    </div>
    </div>    
</div>

    </div>


</div>


<?php  require 'inc/footer.php'?>

<script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles@1.26.0/dist/tsparticles.min.js"></script>
<script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
