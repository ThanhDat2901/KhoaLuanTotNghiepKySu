
<?php 
    require 'init.php' ;   
    require 'classes/product.php';
    require 'classes/chitietbosuutap.php';
    require 'classes/menutrangchu.php';
    $pr = new product();
    $bst = new chitietbosuutap();
    $menu = new menutrangchu();


    $MenuTrangChu = $menu->getMenuTrangChu();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        die("id không hợp lệ.");
    }
    // $data = $bst->getAllSanPhamBoSuuTapByID($id);
    $perPage = 8;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;
    $limit = $perPage;
    $data2 = $bst->getAllSanPhamBoSuuTapPhanTrang($id,$limit, $offset);
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    if ($sort === 'asc') {
        $data = $bst->getBoSuuTapByPriceAsc($id,$limit, $offset);
    } elseif ($sort === 'desc') {
        $data = $bst->getBoSuuTapByPriceDesc($id,$limit, $offset);
    } else {
        $data = $bst->getAllSanPhamBoSuuTapPhanTrang($id,$limit, $offset);
    }

    $totalProducts = $bst->countAllBoSuuTap($id);
    $totalPages = ceil($totalProducts / $perPage);
    // $dataBoSuuTapSpeed = $pr->getChiTietBoSuuTapById('11');
?>
<?php include 'inc/header.php' ;?>  

<div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">

    <div class="container text-center mt-4">
    <div class="row" style="margin-top: 10vh;">
        <div class="col-sm-12 " style="background-color: #e9ecef;">
            <div class="breadcrumb" style="margin-top: 10px;">
                <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
                <span class="mx-2 mb-0">/</span>
                <?php 
                    if (!empty($data2)) {
                        $row = mysqli_fetch_assoc($data2);
                        if ($row) {
                    ?>
                <strong class="text-black">Bộ sưu tập <?= $row['TenBoSuuTap'] ?></strong>
                <?php 
                    } else {
                        echo "No data found!";
                    }
                }
                ?>  
                </div>
        </div>

    <div class="col-sm-12" style="margin-bottom: 3vh;margin-top: 2vh;">
        <nav class="navbar navbar-expand-sm navbar-light"style=" border: 1px solid gray">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" style="color: black;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Lọc giá
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#FFFFFF ;">
                                <?php 
                                if (!empty($data2)) {
                                    $row = mysqli_fetch_assoc($data2);
                                    if ($row) {
                                ?>
                                <li><a class="dropdown-item" href="?sort=normal&id=<?=$row['IDBoSuuTap']?>">Bỏ lọc</a></li>
                                <li><a class="dropdown-item" href="?sort=asc&id=<?=$row['IDBoSuuTap']?>">Giá tăng dần</a></li>
                                <li><a class="dropdown-item" href="?sort=desc&id=<?=$row['IDBoSuuTap']?>">Giá giảm dần</a></li>
                                <?php 
                                        } else {
                                            echo "No data found!";
                                        }
                                    }
                                    ?>  
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  style="color: black;" h href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Loại
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#FFFFFF ;">
                                <li><a class="dropdown-item" href="">Áo Thun</a></li>
                                <li><a class="dropdown-item" href="">Áo Sơ Mi</a></li>
                                <li><a class="dropdown-item" href="">Quần Short</a></li>
                                <li><a class="dropdown-item" href="">Quần Dài</a></li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  style="color: black;" h href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Màu Sắc
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:#FFFFFF ;">
                                <li><a class="dropdown-item" href="">BLACK</a></li>
                                <li><a class="dropdown-item" href="">WHITE</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    </div>
            <?php 
            if (!empty($data2)) {
                $row = mysqli_fetch_assoc($data2);
                if ($row) {
            ?>
                    <div class="row row-cols-12" >
                        <img src="<?= $row['HinhAnhNen'] ?>" style="max-width: 100%; max-height: 95%;" />
                       
                    </div>
            <?php 
                } else {
                    echo "No data found!";
                }
            }
            ?>       
        <div class="row row-cols-4 " style="margin-left:30px">
        <?php if (!empty($data)): ?>
        <?php foreach($data as  $product ):?>    
                <div class="col" style=" margin-top:20px">  
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
            <?php else: ?>
                <h5 style="color: red;">Chưa có sản phẩm thuộc bộ sưu tập!</h5>
            <?php endif; ?>    
        </div>

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
<?php include 'inc/footer.php';?>    
