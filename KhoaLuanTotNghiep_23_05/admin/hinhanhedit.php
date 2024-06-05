<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/hinhanh.php' ?>

<?php
    $id = $_GET['brandid']; 
    $brand = new hinhanh();
    $updateBrand = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDSanPham = $_POST['IDSanPham'];
        $LinkHinh = $_POST['LinkHinh'];
        
        if (empty($LinkHinh)) {
            $updateBrand = "<span style='color: red;'>Vui lòng nhập link hình ảnh.</span>";
        } elseif (!filter_var($LinkHinh, FILTER_VALIDATE_URL)) {
            $updateBrand = "<span style='color: red;'>Vui lòng nhập đúng định dạng link hình ảnh.</span>";
        } else {
            $updateBrand = $brand->update_brand($IDSanPham, $LinkHinh, $id);
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Hình Ảnh Sản Phẩm</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
            ?> 
            <?php
                $get_brand_name = $brand->getbrandbyId($id);
                if ($get_brand_name) {
                    while ($result1 = $get_brand_name->fetch_assoc()) {
            ?>
            <form name="imageForm" action="" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Sản Phẩm</label>              
                        </td>
                        <td>
                            <select style="width: 240px;" id="select" name="IDSanPham" disabled>
                                <?php
                                $cat = new hinhanh();
                                $catlist = $cat->show_product();

                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                ?>
                                <option
                                <?php
                                if ($result['IDSanPham'] == $result1['haIDSanPham']) { echo 'selected';  }
                                ?>
                                 value="<?php echo $result['IDSanPham'] ?>"><?php echo $result['TenSanPham'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Hình Ảnh</label>
                        </td>
                        <td>
                            <img src="<?php echo $result1['LinkHinh'] ?>" width="90"><br>
                            <input type="text" name="LinkHinh" placeholder="Liên Kết Hình Ảnh..." class="medium" />
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

<script type="text/javascript">
function validateForm() {
    var linkHinh = document.forms["imageForm"]["LinkHinh"].value.trim();
    var urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;

    if (linkHinh === "") {
        alert("Vui lòng nhập link hình ảnh.");
        return false;
    }
    if (!urlPattern.test(linkHinh)) {
        alert("Vui lòng nhập đúng định dạng link hình ảnh.");
        return false;
    }
    return true;
}
</script>
