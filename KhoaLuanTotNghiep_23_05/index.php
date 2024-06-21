
<?php 
    require 'init.php' ;   
    require 'classes/product.php';
    require 'classes/menutrangchu.php';
    $pr = new product();
    $menu = new menutrangchu();
    $data = $pr->getPage();

    $MenuTrangChu = $menu->getMenuTrangChu();



    
    
    // $dataBoSuuTapSpeed = $pr->getChiTietBoSuuTapById('11');
?>
<?php include 'inc/header.php' ;?>  
<style>
    .swiper-container {
        position: relative;
        width: 90%;
        height: 650px;
        margin: auto;
    }

    .swiper-slide {
        position: relative;
        background-position: center;
        background-size: cover;
        border: 1px solid rgba(255, 255, 255, 0.3);
        user-select: none;
        border-radius: 20px;
    }

    .swiper-slide img {
        width: 100%;
        height: 100%;
        border-radius: 20px;
    }
    @media (max-width: 1050px) {
        .swiper-container {
            width: 350px;
            height: 450px;
        }
    }

    @media (max-width: 930px) {
        section {
            grid-template-columns: 100%;
            grid-template-rows: 55% 40%;
            grid-template-areas: "slider" "content";
            place-items: center;
            gap: 64px;
            padding: 60px;
        }

        .swiper-container {
            grid-area: slider;
        }

        .content {
            grid-area: content;
            text-align: center;
        }

        .content h1 {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 470px) {
        section {
            padding: 40px 40px 60px;
        }

        .swiper-container {
            width: 300px;
            height: 400px;
        }
    }
    .floatleft.logo .chat-text {
        display: block;
        position: absolute;
        top: 50px; /* Điều chỉnh vị trí top tùy theo kích thước của hình */
        left: 0;
        right: 0;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        margin-right: 87%;
    }

    .floatleft.logo:hover .chat-text {
        opacity: 1;
    }
    

</style>  
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper2 = new Swiper(".swiper-container", {
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
    });
</script>
<div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">
        <div class=" " style="margin-top: 12vh; width: 100%">
            <section>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                    <img src="https://chonthuonghieu.com/wp-content/uploads/listing-uploads/cover/2020/12/yame-4-1.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img
                            src="https://cmsv2.yame.vn/uploads/f937cb18-59fd-4862-8521-79679b0c97cb/Bannersale50.jpg?quality=80&w=0&h=0" />
                    </div>
                    <div class="swiper-slide">
                        <img
                            src="https://cmsv2.yame.vn/uploads/e44592e4-1893-40db-b350-73042db56091/8.jpg?quality=80&w=0&h=0" />
                    </div>
                    <div class="swiper-slide">
                        <img
                            src="https://cmsv2.yame.vn/uploads/43a9583f-c0bb-4223-992a-91c63ab490c9/banner_OP_(1500x1500)_fix_th%c3%b9ng_jpg_banner_OP_(1500x1500)_fix_th%c3%b9ng.jpg?quality=80&w=0&h=0" />
                    </div>
                </div>
            </div>
        </section>
        
        </div>

        <div class="container text-center mt-4">
            <div class="col-12">
            <p style="text-align: center;"><a href="login.php"><img src="https://cmsv2.yame.vn/uploads/d6cb86a4-e987-4900-8a6b-171fd682540e/dang_nhap_the_vip.png" alt="Đăng nhập" width="120" height="120"></a>
            <a href="contact.php"><img src="https://cmsv2.yame.vn/uploads/4162eac6-0100-49c4-834e-0f3f58e06717/dia_chi_cua_hang.png" alt="Hệ thống cửa hàng" width="120" height="120"></a></p>
            </div>
        </div> 
        <div class="container text-center mt-4">
            <div class="row">
                <div class="col">
                    <div class="mt-2 mb-2">
                        <a href=""><img loading="lazy" src="https://cmsv2.yame.vn/uploads/775c9238-66a1-4bcb-a65a-66f3f75b6593/Sale_quan.jpg?quality=80&amp;w=0&amp;h=0" class="img-fluid" alt="SALE CẤP TỐC" style="margin:auto; width:100%;"></a>
                        <a href="" style=" font-size:12px; font-weight:bold;">
                        SALE CẤP TỐC</a>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2 mb-2">
                        <a href=""><img loading="lazy" src="https://cmsv2.yame.vn/uploads/be551121-43cb-4f81-8b64-c684d7efc1e3/salemoban.jpg?quality=80&amp;w=0&amp;h=0" class="img-fluid" alt="MỞ BÁN" style="margin:auto; width:100%;"></a>
                        <a href="" style=" font-size:12px; font-weight:bold;">
                        MỞ BÁN</a>
                    </div>
                </div>
            </div> 
        </div> 
        <div class="container text-center mt-4">
            <div class="row">
                <div class="col">
                    <div class="mt-2 mb-2">
                        <a href=""><img loading="lazy" src="https://cmsv2.yame.vn/uploads/c893f8cc-ac93-44f2-a153-bf8bc7a3fadc/1705salephukien.jpg?quality=80&amp;w=0&amp;h=0" class="img-fluid" alt="SALE PHỤ KIỆN" style="margin:auto; width:100%;"></a>
                        <a href="" style=" font-size:12px; font-weight:bold;">
                        SALE PHỤ KIỆN</a>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2 mb-2">
                        <a href=""><img loading="lazy" src="https://cmsv2.yame.vn/uploads/8490250b-e170-4748-8f69-7e2e239d2adb/1705beginner78k.jpg?quality=80&amp;w=0&amp;h=0" class="img-fluid" alt="BEGINNER" style="margin:auto; width:100%;"></a>
                        <a href="" style=" font-size:12px; font-weight:bold;">
                        BEGINNER</a>
                    </div>
                </div>
            </div>
        </div> 
<?php foreach($MenuTrangChu as  $menuItem ):?> 

        <?php 
            $dataBoSuuTap = $pr->getChiTietBoSuuTapById($menuItem['IDBoSuuTap']); 
            if (count($dataBoSuuTap) > 0):
        ?>


        <div class="container text-center mt-4" style="border-bottom: 1px solid rgba(0, 0, 0, 0.2);">
            <div class="row " >
           
                <div class="col-12 text-center">
                <img src="<?php echo  $dataBoSuuTap[0]['HinhAnhNen'] ?>" style="max-width: 100%; max-height: 95%;" />
                    <h5 style="font-weight:700; margin-top: 30px;"> Bộ sưu tập <?php echo  $dataBoSuuTap[0]['TenBoSuuTap'] ?></h5>
                </div>

                <?php foreach($dataBoSuuTap as  $product ):?> 
                    <div class="col-6 col-sm-3 col-md-3" style=" margin-top:20px;">  
                        <a href="detail.php?id=<?=$product['IDSanPham']?>" style="font-size: 12px; text-decoration: none; color:gray">
                            <div class="card-group d-flex justify-content-center">

                                    <img src="<?=$product['HinhAnh'] ?>" class="card-img-top img-fluid hover-shadow" alt="..." style="width: 100%;height:350px;z-index: 100;">

                                    <div class="card-body" style=" z-index: 100;height:15vh">
                                    <?php
                        $shortenedName = mb_strimwidth($product['TenSanPham'], 0, 30, "...");
                    ?>
                    <p class="card-text" style="font-size: 18px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: black;">
                        <?= $shortenedName ?>
                    </p>
                                        <!-- <p class="card-text" style="font-size: 18px;"><?=  number_format($product['GiaCuoi'], 0, ',','.') ?><sup>đ</sup></p> -->
                                        <!-- <div>
                                            <span style="font-size: 18px; color: black; text-decoration: line-through;">
                                                <?= number_format(substr($product['GiaDau'], 0, -3), 0, ',', '.') ?>
                                            </span>
                                            <span class="card-text" style="font-size: 18px; color: red; margin-left: 10px;">
                                                <?= number_format(substr($product['GiaCuoi'], 0, -3), 0, ',', '.') ?>
                                            </span>
                                        </div> -->
                                        <div>
                                            <?php if ($product['GiaCuoi'] < $product['GiaDau']): ?>
                                                <span style="font-size: 18px; color: black; text-decoration: line-through;">
                                                    <?= number_format(substr($product['GiaDau'], 0, -3), 0, ',', '.') ?>
                                                </span>
                                                <span class="card-text" style="font-size: 18px; color: red; margin-left: 10px;">
                                                    <?= number_format(substr($product['GiaCuoi'], 0, -3), 0, ',', '.') ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="card-text" style="font-size: 18px; color: black;">
                                                    <?= number_format(substr($product['GiaDau'], 0, -3), 0, ',', '.') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                       
                                </div>
                            </div>
                        </a>                    
                    </div>  
                    <?php endforeach ;?>
                    <div class="col-12 mb-4" style="text-align: right;">
                        <div>
                            <a class="btn btn-dark btn-sm" href="danhsachsanphambosuutap.php?id=<?=$dataBoSuuTap[0]['IDBoSuuTap']?>">&nbsp;&nbsp;Xem thêm các sản phẩm khác&nbsp;&nbsp;</a>
                        </div>
                    </div>
            </div>
        </div>


        <?php endif; ?>
<?php endforeach ;?>        


    <div style="margin-bottom:-47px">
        <img src="images/banner1.gif" alt="Alternate Text" style="width:100%;height:150px;margin-left:10px;" />
    </div>
</div>
            <div class="floatleft logo" style="position: fixed; bottom: 0; right: 0; padding: 20px;margin-bottom: 50px;margin-right: -28%">
                <a href="https://www.ciciai.com/chat/10057177786116" style="display: inline-block;">
                    <img style="width:40px;height:40px;border-radius: 50%;" src="admin/img/zalologo.png" alt="Tư Vấn Khách Hàng" />
                    <span style="color:black;" class="chat-text">Zalo</span>
                </a>    
            </div>

<?php include 'inc/footer.php';?>    

<script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@1.26.0/dist/tsparticles.min.js"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>