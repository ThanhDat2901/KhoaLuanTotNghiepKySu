
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="https://thombrownevn.com/wp-content/uploads/2018/07/cropped-111-32x32.png" sizes="32x32">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easyzoom/2.5.0/easyzoom.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/easyzoom/2.5.0/easyzoom.min.js"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <link rel="stylesheet" href="layout.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">		

	<script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@1.26.0/dist/tsparticles.min.js"></script>
    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="js/sacript.js" type="text/javascript"></script>
    <title img=>
		YaMe | Mua Online Quần Áo Thời Trang Nam - Nữ Giá Rẻ

	</title>
	<link rel="icon" href="admin/img/logoyame3.ico" type="image/x-icon">



<style>
	    .search-wrap {
            display: none;
        }

        .search-wrap.active {
            display: block;
        }
		.navbar-nav .nav-link,
.navbar-nav .nav-link:hover,
.navbar-nav .nav-link:focus {
    color: #f3f3f4; /* Màu trắng */
}
.d-flex.flex-wrap .p-3 {
    flex: 1;
    min-width: 0;
}
.dropdown-menu {
    visibility: hidden;
    opacity: 0;
    top: 100%;
    min-width: 300px;
    position: absolute;
    text-align: left;
    border-top: 2px solid #ee4266;
    box-shadow: 0 0 4px 0 rgba(0, 0, 0, .05);
    padding: 0 0;
    margin-top: 20px;
    margin-left: 0;
    background: #222;
    transition: .2s 0s;
    width: 100%;
    left: 0;
    right: auto;
}

.dropdown-menu.show {
    visibility: visible;
    opacity: 1;
}

.white-text { /* Thêm class white-text để áp dụng màu trắng cho chữ */
    color: #fff;
}
</style>
</head>
<?php 
    require 'classes/bosuutap.php';
	require 'classes/loai.php';
    $bosuutap = new category();
	$loaisanpham = new loai();
    $databosuutap= $bosuutap->DanhSachBoSuuTap();
	$dataloaisanpham = $loaisanpham->DanhSachLoaiSanPham();

    // $dataBoSuuTapSpeed = $pr->getChiTietBoSuuTapById('11');
?>

<body style="overflow-x:hidden; background-color: #FFFFFF;">
    
    <header>
    <div style="background-color: #111!important; width: 100%; height: 10vh;top:0; position:fixed ;z-index:999">
        <div class="container text-center" style="width:100%">
            <div class="">
                <div class="row d-flex " style="height:10vh">
                    <div class="col-2 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
						<a href="index.php"><img src="//res.yame.vn/Content/images/yame-f-logo-white.png?v=20231127_2" alt="Yame.vn" style="width: 170px;margin-top: 2px;margin-left: 10px;"></a>
                    </div>
					<div class="col-7 justify-content-start align-items-center m-lg-2 justify-content-center text-align-center text-center">
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
									<li class="nav-item dropdown"  style="margin-left: 10px;">
										<a class="nav-link dropdown-toggle" href="#" id="sale-cap-toc-dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SALE CẤP TỐC</a>
										<ul class="dropdown-menu" aria-labelledby="sale-cap-toc-dropdown">
											<li><a class="dropdown-item white-text" href="/shop/ao-thun-don-gian-sale?sort=1">Áo Thun Sale 50%</a></li>
											<li><a class="dropdown-item white-text" href="/shop/ao-polo-djon-gian-sale?sort=1">Áo Polo Sale 50%</a></li>
											<li><a class="dropdown-item white-text" href="/shop/so-mi-don-gian-sale?sort=1">Áo Sơ Mi Sale</a></li>
											<li><a class="dropdown-item white-text" href="/shop/ao-khoac-djon-gian-sale?sort=1">Áo Khoác Sale</a></li>
											<li><a class="dropdown-item white-text" href="/shop/quan-dai-djon-gian-sale?sort=1">Quần Dài Sale</a></li>
											<li><a class="dropdown-item white-text" href="/shop/quan-short-djon-gian-sale?sort=1">Quần Short Sale</a></li>
										</ul>
									</li>
									<li class="nav-item dropdown"  style="margin-left: 10px;">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="fa-solid fa-bars"></i>
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" >
										<li><a class="dropdown-item white-text" href="danhsachsanpham.php">Hàng Mới</a></li>
										<?php foreach($dataloaisanpham as  $loaisanphamitem ):?> 
										<li><a class="dropdown-item white-text" href="danhsachsanphamtheoloai.php?id=<?=$loaisanphamitem['IDLoai']?>"><?php echo $loaisanphamitem['TenLoai'] ?></a></li>
										<?php endforeach ;?>
										<!-- <li><a class="dropdown-item white-text" href="/shop/Ao-polo-don-gian-thiet-ke-yame?sort=11">Áo Polo</a></li>
										<li><a class="dropdown-item white-text" href="/shop/ao-so-mi?sort=11">Áo Sơ Mi</a></li>
										<li><a class="dropdown-item white-text" href="/shop/ao-khoac?sort=11">Áo Khoác</a></li>
										<li><a class="dropdown-item white-text" href="/shop/quan-jean?sort=11">Quần Jean</a></li>
										<li><a class="dropdown-item white-text" href="/shop/quan-tay?sort=11">Quần Tây</a></li>
										<li><a class="dropdown-item white-text" href="/shop/quan-dai?sort=11">Quần Kaki, Thun</a></li>
										<li><a class="dropdown-item white-text" href="/shop/quan-short?sort=11">Quần Short</a></li>
										<li><a class="dropdown-item white-text" href="/shop/quan-lot?sort=11">Quần Lót</a></li>																																																													 -->
											</ul>
									</li>
										<li class="nav-item"  style="margin-left: 10px;">
											<!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
											<button class="btn btn-outline-white  position:fixed" id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
												<div class="search-wrap" id="searchWrap">
													<div class="container" style="width: 240px;">
																<a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
																<form action="/search" method="post">
																	<input type="text" name="keyword" class="form-control" placeholder="Tìm Kiếm">
																</form>
													</div>
												</div>

												
											</div> -->
											<div class="collapse navbar-collapse" id="navbarSupportedContent">
										
												<div >
													<div class="container" style="width: 350px;">
																
																<form action="danhsachsanphamsearch.php?" method="GET" class="d-flex">
																	<button class="btn btn-outline-white  " type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
																	<input type="text" id="search" name="search" class="form-control" placeholder="Tìm Kiếm">
																</form>
													</div>
												</div>

												
											</div>
										</li>
									</ul>
									
								</div>
						</nav>
                	</div>
                    <div class="col m-lg-2">
							<nav class="navbar navbar-expand-lg ">
								<ul class="navbar-nav justify-content-end">
									<li class="nav-item" >
										<a style="text-decoration:none;font-size: 14px;" class="nav-link" href="cart.php"  role="button" aria-expanded="false">
										<i class="fa-solid fa-cart-shopping"></i> <span class="badge badge-danger">  0  <span></span></span>
										</a>
									</li>
									<li class="nav-item dropdown">
										<a style="text-decoration:none;font-size: 14px;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<?php if(isset($_SESSION['login_detail'])): ?>	
												<?php echo $_SESSION['name']   ?> 
											<?php endif ?>
											<i class="fa-solid fa-user"></i>  
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #FFFFFF;">
											<?php if(!isset($_SESSION['login_detail'])): ?>
												<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng nhập</a></li>

												<?php if(!isset($_SESSION['login_quanly'])): ?>
													<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="register.php"><i class="fa-solid fa-registered"></i> Đăng ký</a></li>
												<?php else:?>
													<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="logout.php"><i class="fa-solid fa-heart"></i> Chào bạn: nhân viên </a></li>
													<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="">  <i class="fa-solid fa-circle-info"></i> Thay đổi thông tin</a></li>
													<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
												<?php endif ?>
											<?php else:?>
												<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="">  <i class="fa-solid fa-circle-info"></i> Thay đổi thông tin</a></li>
												<li><a style="text-decoration:none;color: black;" class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
											<?php endif ?>
										</ul>
									</li>
								</ul>
							</nav>
					</div>
					                    
					
                </div>
            </div>

        </div>
    </div>

	<script>
        const searchWrap = document.getElementById('searchWrap');
        const searchBtn = document.getElementById('searchBtn');

        searchBtn.addEventListener('click', function() {
            searchWrap.classList.toggle('active');
        });

		// Lắng nghe sự kiện khi di chuột qua liên kết
		document.getElementById('menuToggle').addEventListener('mouseenter', function() {
			// Hiển thị menu dropdown
			document.getElementById('menuDropdown').style.display = 'block';
		});

		// Lắng nghe sự kiện khi di chuột rời khỏi liên kết hoặc menu dropdown
		document.getElementById('menuToggle').addEventListener('mouseleave', function() {
			// Ẩn menu dropdown
			document.getElementById('menuDropdown').style.display = 'none';
		});

		document.getElementById('menuDropdown').addEventListener('mouseleave', function() {
			// Ẩn menu dropdown khi di chuột rời khỏi menu dropdown
			document.getElementById('menuDropdown').style.display = 'none';
		});
    </script>
    </header>

	
