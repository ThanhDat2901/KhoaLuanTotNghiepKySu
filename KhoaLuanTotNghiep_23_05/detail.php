

<?php 

require 'init.php' ;   
require 'classes/product.php';
require 'classes/hinhanh.php';
    $pr = new product();
    $ha = new hinhanh();
     // Lấy thông tin sản phẩm từ URL
     $id = isset($_GET['id']) ? $_GET['id'] : null;
     if (!$id) {
         die("id không hợp lệ.");
     }
     $listAnh = $ha->showListAnhByIdSanPham($id);

     $product_by_id = $pr->getproductbyId($id);
     $product = $product_by_id->fetch_assoc();

     $result_size = $pr->getSizeById($id);
    //   if($_SERVER["REQUEST_METHOD"]  == "POST"){
    //     $cart = new Cart();
    //     // $order = new Order();
    //     $Amount = $_POST['Amount'];      
    //     $cart->add($pdo,$id,$_SESSION['id'], $Amount);
    //     // $order->add($pdo,$id,$_SESSION['id'], $Amount);
    //     header('location: cart.php');

    // }
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
        if ($SoLuong <= $availableQuantity) {

            $cart_item = array(
                'IDChiTiet' => $IDChiTiet,
                'SoLuong' => $SoLuong
            );
            $_SESSION['cart'][] = $cart_item;
        } else {

            echo "Số lượng sản phẩm không được lớn hơn số lượng còn trong cửa hàng.";

        }
    }
}
?> 

<?php include 'inc/header.php' ;?>    

<style>
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
            <div class="col">
                        <h5 style="color: black"><?php echo $product['TenSanPham']?></h5>
                        <p> Mã số: <?php echo $product['IDSanPham']?></p>
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
                                <form action="" method="post">
                                <input type="hidden" name="IDChiTiet" id="IDChiTiet" value="<?=$datasize['IDChiTiet'] ?>" />
                                <input type="hidden" name="SoLuong" value="1">
                                    <table class="table table-xl table-hover" style="table-layout: fixed;">
                                        <tbody class="table-hover">
                                            <tr>
                                                <td><?=$datasize['TenSize'] ?></td>
                                                <td> <span style="font-weight: bold;"> <?=$datasize['SoLuong'] ?></span> Cửa Hàng còn</td>
                                                <td>
                                                    <button type="submit" style="text-decoration:none;color:red; background: none; border: none;">
                                                        <i class="fa-solid fa-plus"></i>Chọn mua
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form> 

                            <?php endforeach; ?>
                        <?php else: ?>
                        <?php endif; ?>
                        </div>
                        <div>
                            <button id="size-guide-button" class="btn-outline-dark btn-sm" style="margin-top: 10px;">Hướng dẫn chọn size</button>
                                <div id="size-chart-overlay" class="zoom-overlay" style="display: none;">
                                    <img style="margin-top: 10px; height: 700px; width: 500px;" src="https://cmsv2.yame.vn/uploads/96de2b6a-7cba-42ec-82ab-a80a62693726/size-chart-01.jpg" alt="Size Chart">
                                </div>
                            </div>
                        <div>
                            <h4 style="color: black;">Mô tả sản phẩm</h4>
                            <div id="product-description" class="description">
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

    </div>


</div>

<?php  require 'inc/footer.php'?>

<script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles@1.26.0/dist/tsparticles.min.js"></script>
<script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
