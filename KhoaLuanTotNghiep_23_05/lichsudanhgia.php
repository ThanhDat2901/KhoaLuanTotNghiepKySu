<?php
require 'init.php';


require 'classes/hoadon.php';
require 'classes/comment.php';
$hoadon = new hoadon();
// $comment = new comment();
$cm = new comment();
// $chitiethoadon = new chitiethoadon();
if (isset($_SESSION['login_detail'])) {
$IDNguoiDung  = $_SESSION['user_id'];
}
$comment = $cm->show_commentSanPhamByIdNguoiDung($IDNguoiDung);
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
<div id="about" class="shop" style="margin-top:10vh">
    <div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">

        <div class="container text-center mt-4">
            <div class="row">
                <div class="col-sm-12 " style="background-color: #e9ecef;">
                    <div class="breadcrumb" style="margin-top: 10px;">
                        <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
                        <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Đánh giá</strong>
                        </div>
                </div>

            </div>   
            <div class="row">
                <div class="col-12 text-center">

                    <div class="header-bottom container-fluid" style="margin-top: 1vh;">
                        <div class="row">        
                            
                            <div class="col " style="margin-top: 1vh;">
                                    <?php if (!empty($comment)): ?>
                                        <?php foreach($comment as $commentitem): ?> 
                                            <div class="col-md-12  rating-<?php echo $commentitem['Rate']; ?>" style="margin-top: 3vh;">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                               <img src="<?php echo $commentitem['HinhAnh']; ?>" style="width: 200px;height: 200px;" alt="Avatar" class="avatar">
                                                            </div>
                                                            <div class="col-md-3">   
                                                            <a href="detail.php?id=<?=$commentitem['IDSanPham']?>" style=" text-decoration: none; color:gray"> 
                                                            <p><?php echo $commentitem['TenSanPham']; ?> </p>
                                                                </a>  
                                                                
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div >                                                               
                                                                    <?php for ($i = 0; $i < $commentitem['Rate']; $i++): ?>
                                                                        <span class="fa fa-star checked" style="color: #ee4d2d;"></span>
                                                                    <?php endfor; ?>
                                                                    <?php for ($i = $commentitem['Rate']; $i < 5; $i++): ?>
                                                                        <span class="fa fa-star" style="color: gray;"></span>
                                                                    <?php endfor; ?>
                                                                </div>
                                                                <p class="card-text">
                                                                    <small class="text-muted">
                                                                        <?php echo date('d-m-Y H:i:s', strtotime($commentitem['ThoiGian'])); ?>
                                                                    </small>
                                                                </p>
                                                                <p class="card-text" style="color: rgba(0, 0, 0, 0.4);">Phân loại hàng: <span style="color: black;"><?php echo $commentitem['TenMau']; ?> </span> </p>
                                                                <p class="card-text" style="color: rgba(0, 0, 0, 0.4);">Nội dung: <span style="color: black;"><?php echo $commentitem['NoiDung']; ?> </span> </p>

                                                                <!-- Hiển thị ngày đánh giá -->
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        <?php endforeach; ?>  
                                    <?php endif; ?>
                                    </div> 

                            </div>
                        </div>
                    </div>

                
                
                
                
                </div>
            </div>

        </div>

    </div>
</div>

<?php include 'inc/footer.php';?>    