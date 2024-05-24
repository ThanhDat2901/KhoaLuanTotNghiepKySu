<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/hinhanh.php' ?>

<?php
    $brand = new hinhanh();
    $insertBrand = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDSanPham = $_POST['IDSanPham'];
        $LinkHinh = $_POST['LinkHinh'];
        
        if (empty($IDSanPham) || $IDSanPham == "--------Chọn Sản Phẩm-------") {
            $insertBrand = "<span style='color: red;'>Vui lòng chọn Sản Phẩm.</span>";
        } elseif (empty($LinkHinh)) {
            $insertBrand = "<span style='color: red;'>Vui lòng nhập link hình ảnh.</span>";
        } elseif (!filter_var($LinkHinh, FILTER_VALIDATE_URL)) {
            $insertBrand = "<span style='color: red;'>Vui lòng nhập đúng định dạng link hình ảnh.</span>";
        } else {
            $insertBrand = $brand->insert_brand($IDSanPham, $LinkHinh);
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Hình Ảnh Cho Sản Phẩm</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
            ?> 
            <form name="imageForm" action="hinhanhadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Sản Phẩm</label>
                        </td>
                        <td>
                            <select style="width: 240px;" id="select" name="IDSanPham">
                                <option>--------Chọn Sản Phẩm-------</option>
                                <?php
                                $brandlist = $brand->show_product();
                                if ($brandlist) {
                                    while ($result = $brandlist->fetch_assoc()) {
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
                             <label>Link Hình Ảnh</label>
                         </td>
                        <td>                           
                            <input type="text" name="LinkHinh" placeholder="Link Hinh Anh..." class="medium" />
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
    var idSanPham = document.forms["imageForm"]["IDSanPham"].value;
    var linkHinh = document.forms["imageForm"]["LinkHinh"].value.trim();
    var urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;

    if (idSanPham == "--------Chọn Sản Phẩm-------" || idSanPham == "") {
        alert("Vui lòng chọn Sản Phẩm.");
        return false;
    }
    if (linkHinh == "") {
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