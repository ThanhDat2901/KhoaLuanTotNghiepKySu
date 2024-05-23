<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/chitietsanpham.php';

    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        echo "<script>window.location ='brandlist.php'</script>";
    } else {
        $id = $_GET['brandid']; 
    }

    $brand = new chitietsanpham();
    $updateBrand = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDSize = $_POST['IDSize'];
        $IDSanPham = $_POST['IDSanPham'];
        $SoLuong = $_POST['SoLuong'];

        if (empty($IDSize) || $IDSize == "--------Chọn Size-------" || empty($IDSanPham) || $IDSanPham == "--------Chọn Sản Phẩm-------") {
            $updateBrand = "<span style='color: red;'>Vui lòng điền đầy đủ thông tin.</span>";
        } elseif (!preg_match('/^[1-9][0-9]{0,4}$/', $SoLuong)) {
            $updateBrand = "<span style='color: red;'>Vui lòng nhập số lượng hợp lệ (không quá 5 ký tự, không chứa ký tự đặc biệt, không bắt đầu bằng 0).</span>";
        } else {
            $updateBrand = $brand->update_brand($IDSize, $IDSanPham, $SoLuong, $id);
        }
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Size Sản Phẩm</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
            ?> 
            <?php
                $get_brand_name = $brand->getbrandbyId($id);
                if ($get_brand_name) {
                    while ($result = $get_brand_name->fetch_assoc()) {
            ?>
            <form name="productDetailForm" action="" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Size</label>
                        </td>
                        <td>
                            <select style="width: 310px;" id="select" name="IDSize">
                                <?php
                                $catlist = $brand->show_size_by_name();
                                if ($catlist) {
                                    while ($result2 = $catlist->fetch_assoc()) {
                                ?>
                                <option
                                    <?php if ($result2['IDSize'] == $result['CTIDSize']) { echo 'selected'; } ?>
                                    value="<?php echo $result2['IDSize']; ?>"><?php echo $result2['TenSize']; ?>
                                </option>
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
                                <?php
                                $catlist = $brand->show_sanpham_by_name();
                                if ($catlist) {
                                    while ($result3 = $catlist->fetch_assoc()) {
                                ?>
                                <option
                                    <?php if ($result3['IDSanPham'] == $result['CTIDSanPham']) { echo 'selected'; } ?>
                                    value="<?php echo $result3['IDSanPham']; ?>"><?php echo $result3['TenSanPham']; ?>
                                </option>
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
                            <input type="text" value="<?php echo $result['SoLuong']; ?>" name="SoLuong" placeholder="Thay đổi số lượng..." class="medium" />
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

<?php include 'inc/footer.php'; ?>
