<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietbosanpham.php' ?>

<?php
    // Check if brandid is set and not NULL
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        // Redirect to brandlist.php if brandid is not set or NULL
        echo "<script>window.location ='brandlist.php'</script>";
    } else {
        // Get the brandid
        $id = $_GET['brandid'];
    }
    
    $brand = new chitietbosanpham();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the submitted data
        $IDBo = $_POST['IDBo'];
        $IDSanPham = $_POST['IDSanPham'];
        
        // Check if the product is already associated with the product set
        $isProductInSet = $brand->check_existing_product($IDBo, $IDSanPham);
        
        if($isProductInSet) {
            // Product is already in the set, display an appropriate message
            $updateBrand = "<span style='color: red;'>Sản phẩm đang tồn tại trong bộ sản phẩm này.</span>";
        } else {
            // Product is not in the set, proceed with the update
            $updateBrand = $brand->update_brand($IDBo,$IDSanPham,$id);
        }
    }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Sản Phẩm Trong Bộ Sản Phẩm</h2>
        <div class="block copyblock"> 
            <?php
            // Display the update message
            if(isset($updateBrand)){
                echo $updateBrand;
            }
            ?>
            
            <?php
                // Fetch the brand details
                $get_brand_name = $brand->getbrandbyId($id);
                if($get_brand_name){
                    while($result = $get_brand_name->fetch_assoc()){
            ?>
            
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Bộ Sản Phẩm</label>
                        </td>
                        <td>
                            <select style="width: 310px;" id="select" name="IDBo">
                                <?php
                                // Fetch and display product set names
                                $cat = new chitietbosanpham();
                                $catlist = $cat->show_bosanpham_by_name();

                                if($catlist){
                                    while($result1 = $catlist->fetch_assoc()){
                                ?>
                                <option <?php if($result1['IDBo']==$result['CTIDBo']){ echo 'selected'; } ?> value="<?php echo $result1['IDBo'] ?>"><?php echo $result1['TenBo'] ?></option>
                                <?php
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
                                <option>--------Chọn Sản Phẩm--------</option>
                                <?php
                                // Fetch and display product names
                                $cat = new chitietbosanpham();
                                $catlist = $cat->show_sanpham_by_name();

                                if($catlist){
                                    while($result2 = $catlist->fetch_assoc()){
                                ?>
                                <option <?php if($result2['IDSanPham']==$result['CTIDSanPham']){ echo 'selected'; } ?> value="<?php echo $result2['IDSanPham'] ?>"><?php echo $result2['TenSanPham'] ?></option>
                                <?php
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
