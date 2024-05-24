<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietbosanpham.php' ?>

<?php
// Khởi tạo đối tượng chitietbosanpham
$brand = new chitietbosanpham();

// Khởi tạo biến lưu thông báo khi thực hiện thêm
$insertBrand = '';

// Xử lý khi nhấn nút Lưu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $IDBo = $_POST['IDBo'];
    $IDSanPham = $_POST['IDSanPham'];

    // Kiểm tra nếu cả hai trường đã được chọn
    if ($IDBo != '' && $IDSanPham != '') {
        // Kiểm tra xem sản phẩm đã tồn tại trong bộ sản phẩm hay chưa
        $existingProduct = $brand->check_existing_product($IDBo, $IDSanPham);
        if ($existingProduct) {
            // Nếu sản phẩm đã tồn tại, hiển thị thông báo lỗi
            $insertBrand = "<span class='error'>Sản phẩm đã tồn tại trong Bộ Sản Phẩm này.</span>";
        } else {
            // Nếu sản phẩm chưa tồn tại, thực hiện thêm vào bộ sản phẩm
            $insertBrand = $brand->insert_brand($IDBo, $IDSanPham);
        }
    } else {
        // Nếu một trong hai trường chưa được chọn, hiển thị thông báo lỗi
        $error = '';
        if ($IDBo == '') {
            $error .= "Vui lòng chọn Bộ Sản Phẩm. ";
        }
        if ($IDSanPham == '') {
            $error .= "Vui lòng chọn Sản Phẩm.";
        }
        $insertBrand = "<span class='error'>$error</span>";
    }
}
?> 

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Sản Phẩm Vào Bộ Sản Phẩm Mới</h2>
        <div class="block copyblock"> 
            <?php
            // Hiển thị thông báo kết quả thực hiện thêm
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
            ?> 

            <form action="chitietbosanphamadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Bộ Sản Phẩm</label>
                        </td>
                        <td>
                            <select style="width: 250px;" id="IDBo" name="IDBo">
                                <option value="">--------Chọn Bộ Sản Phẩm-------</option>
                                <?php
                                // Hiển thị danh sách các bộ sản phẩm
                                $cat = new chitietbosanpham();
                                $catlist = $cat->show_bosanpham_by_name();

                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $result['IDBo'] ?>"><?php echo $result['TenBo'] ?></option>
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
                            <select style="width: 250px;" id="IDSanPham" name="IDSanPham">
                                <option value="">--------Chọn Sản Phẩm-------</option>
                                <?php
                                // Hiển thị danh sách các sản phẩm
                                $cat = new chitietbosanpham();
                                $catlist = $cat->show_sanpham_by_name();

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
    var IDBo = document.getElementById('IDBo').value;
    var IDSanPham = document.getElementById('IDSanPham').value;
    if (IDBo == '' && IDSanPham == '') {
        alert("Vui lòng chọn Bộ Sản Phẩm và Sản Phẩm cần thêm.");
        return false;
    }
    if (IDBo == '') {
        alert("Vui lòng chọn Bộ Sản Phẩm.");
        return false;
    }
    if (IDSanPham == '') {
        alert("Vui lòng chọn Sản Phẩm.");
        return false;
    }
    return true;
}
</script>
