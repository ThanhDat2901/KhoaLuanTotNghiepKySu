<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietbosuutap.php' ?>
<?php
    $brand = new chitietbosuutap();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDBoSuuTap = $_POST['IDBoSuuTap'];
        $IDSanPham = $_POST['IDSanPham'];
        
        // Check if the product already exists in the collection
        $existingProduct = $brand->check_existing_product($IDBoSuuTap, $IDSanPham);
        if ($existingProduct) {
            $insertBrand = "<span class='error'>Sản phẩm đã có trong Bộ Sưu Tập này.</span>";
        } else {
            $insertBrand = $brand->insert_brand($IDBoSuuTap, $IDSanPham);
        }
    }
?> 
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Sản Phẩm Vào Bộ Sưu Tập</h2>
        <div class="block copyblock"> 
            <?php
            if(isset($insertBrand)){
                echo $insertBrand;
            }
            ?> 
            <form action="chitietbosuutapadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Bộ Sưu Tập</label>
                        </td>
                        <td>
                            <select style="width: 250px;" id="selectNguoiDung" name="IDBoSuuTap">
                                <option value="">--------Chọn Bộ Sưu Tập-------</option>
                                <?php
                                $cat = new chitietbosuutap();
                                $catlist = $cat->show_bosuutap_by_name();

                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $result['IDBoSuuTap'] ?>"><?php echo $result['TenBoSuuTap'] ?></option>
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
                            <select style="width: 250px;" id="selectNguoiDung" name="IDSanPham">
                                <option value="">--------Chọn Sản Phẩm-------</option>
                                <?php
                                $cat = new chitietbosuutap();
                                $catlist = $cat->show_sanpham_by_name();

                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $result['IDSanPham'] ?>"><?php echo $result['TenSanPham'] ?></option>
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
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>

<script type="text/javascript">
function validateForm() {
    var IDBoSuuTap = document.getElementById('selectNguoiDung').value;
    var IDSanPham = document.getElementById('selectNguoiDung').value;
    if (IDBoSuuTap == '' || IDSanPham == '') {
        alert("Vui lòng chọn Bộ Sưu Tập và Sản Phẩm.");
        return false;
    }
    return true;
}
</script>
