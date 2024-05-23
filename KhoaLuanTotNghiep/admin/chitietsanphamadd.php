<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietsanpham.php' ?>
<?php
    $brand = new chitietsanpham();
    $insertBrand = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDSize = $_POST['IDSize'];
        $IDSanPham = $_POST['IDSanPham'];
        $SoLuong = $_POST['SoLuong'];

        if (empty($IDSize) || $IDSize == "--------Chọn Size-------" || empty($IDSanPham) || $IDSanPham == "--------Chọn Sản Phẩm-------") {
            $insertBrand = "<span style='color: red;'>Vui lòng điền đầy đủ thông tin.</span>";
        } elseif (!preg_match('/^[1-9][0-9]{0,4}$/', $SoLuong)) {
            $insertBrand = "<span style='color: red;'>Vui lòng nhập số lượng hợp lệ (không quá 5 ký tự, không chứa ký tự đặc biệt, không bắt đầu bằng 0).</span>";
        } else {
            $insertBrand = $brand->insert_brand($IDSize, $IDSanPham, $SoLuong);
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Size Mới Cho Sản Phẩm</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
            ?> 
            <form name="productDetailForm" action="chitietsanphamadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">
                    <tr>
                        <td>
                            <label>Tên Size</label>
                        </td>
                        <td>
                            <select style="width: 250px;" id="selectNguoiDung" name="IDSize">
                                <option>--------Chọn Size-------</option>
                                <?php
                                $catlist = $brand->show_size_by_name();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['IDSize'] ?>"><?php echo $result['TenSize'] ?></option>
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
                                <option>--------Chọn Sản Phẩm-------</option>
                                <?php
                                $catlist = $brand->show_sanpham_by_name();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
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
                            <label>Số Lượng</label>
                        </td>
                        <td>
                            <input type="text" name="SoLuong" placeholder="Nhập số lượng sản phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
    function validateForm() {
        var idSize = document.forms["productDetailForm"]["IDSize"].value;
        var idSanPham = document.forms["productDetailForm"]["IDSanPham"].value;
        var soLuong = document.forms["productDetailForm"]["SoLuong"].value.trim();

        if (idSize == "--------Chọn Size-------" || idSize == "") {
            alert("Vui lòng chọn Size.");
            return false;
        }
        if (idSanPham == "--------Chọn Sản Phẩm-------" || idSanPham == "") {
            alert("Vui lòng chọn Sản Phẩm.");
            return false;
        }
        if (!/^[1-9][0-9]{0,4}$/.test(soLuong)) {
            alert("Vui lòng nhập số lượng hợp lệ (không quá 5 ký tự, không chứa ký tự đặc biệt, không bắt đầu bằng 0).");
            return false;
        }
        return true;
    }
</script>