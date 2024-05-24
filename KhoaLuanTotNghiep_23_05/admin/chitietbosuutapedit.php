<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/chitietbosuutap.php';

    // Check if ID is set in the URL
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo "<script>window.location ='brandlist.php'</script>";
    } else {
        $id = $_GET['brandid']; 
    }

    $brand = new chitietbosuutap();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDBoSuuTap = $_POST['IDBoSuuTap'];
        $IDSanPham = $_POST['IDSanPham'];
        
        // Check if the product already exists in the collection
        if (!$brand->check_existing_product($IDBoSuuTap, $IDSanPham, $id)) {
            // If the product doesn't exist in the collection, proceed with the update operation
            $updateBrand = $brand->update_brand($IDBoSuuTap, $IDSanPham, $id);
        } else {
            // If the product already exists in the collection, display an error message
            $updateBrand = "<span style='color: red;'>Sản phẩm đã tồn tại trong bộ sưu tập này và không thể thay đổi.</span>";
        }
    }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Sản Phẩm Của Bộ Sưu Tập</h2>
        <div class="block copyblock"> 
            <?php
                if(isset($updateBrand)){
                    echo $updateBrand;
                }
            ?>
            <?php
                $get_brand_name = $brand->getbrandbyId($id);
                if($get_brand_name){
                    while($result = $get_brand_name->fetch_assoc()){
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Bộ Sưu Tập</label>
                        </td>
                        <td>
                            <select style="width: 310px;" id="select" name="IDBoSuuTap">
                                <?php
                                    $cat = new chitietbosuutap();
                                    $catlist = $cat->show_bosuutap_by_name();

                                    if($catlist){
                                        while($result1 = $catlist->fetch_assoc()){
                                            echo '<option ';
                                            if($result1['IDBoSuuTap'] == $result['CTIDBoSuuTap']) echo 'selected ';
                                            echo 'value="' . $result1['IDBoSuuTap'] . '">' . $result1['TenBoSuuTap'] . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tên Sản Phẩm</label>
                        </td>
                        <td>
                            <select style="width: 310px;" id="select" name="IDSanPham">
                                <?php
                                    $cat = new chitietbosuutap();
                                    $catlist = $cat->show_sanpham_by_name();

                                    if($catlist){
                                        while($result2 = $catlist->fetch_assoc()){
                                            echo '<option ';
                                            if($result2['IDSanPham'] == $result['CTIDSanPham']) echo 'selected ';
                                            echo 'value="' . $result2['IDSanPham'] . '">' . $result2['TenSanPham'] . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
