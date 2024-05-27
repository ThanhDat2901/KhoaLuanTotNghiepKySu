<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietmausac.php' ?>

<?php

$brand = new chitietmausac();

$insertBrand = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $IDMau = $_POST['IDMau'];
    $IDSanPham = $_POST['IDSanPham'];


    if ($IDMau != '' && $IDSanPham != '') {

        $existingProduct = $brand->check_existing_product($IDMau, $IDSanPham);
        if ($existingProduct) {

            $insertBrand = "<span class='error'>Sản phẩm đã có màu sắc này.</span>";
        } else {

            $insertBrand = $brand->insert_brand($IDMau, $IDSanPham);
        }
    } else {

        $error = '';
        if ($IDMau == '') {
            $error .= "Vui lòng chọn Màu Sắc. ";
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

            <form action="chitietmausacadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Màu</label>
                        </td>
                        <td>
                            <select style="width: 250px;" id="IDMau" name="IDMau" onchange="changeColor()">
                                <option value="">--------Chọn Bộ Sản Phẩm-------</option>
                                <?php
                                // Hiển thị danh sách các bộ sản phẩm
                                $cat = new chitietmausac();
                                $catlist = $cat->show_bosanpham_by_name();

                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['IDMau'] ?>"><?php echo $result['TenMau'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Màu Sắc</label>
                        </td>
                        <td>
                            <div id="colorBox" style="width: 30px; height: 30px; border: 1px solid black;"></div>
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
                                $cat = new chitietmausac();
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
        var IDBo = document.getElementById('IDMau').value;
        var IDSanPham = document.getElementById('IDSanPham').value;
        if (IDBo == '' || IDSanPham == '') {
            alert("Vui lòng chọn Màu Sắc và Sản Phẩm cần thêm.");
            return false;
        }
        return true;
    }
   // Đối tượng ánh xạ tên màu sang mã HEX
   var colorMap = {
    "Cam Đỏ": "#FF5733",
    "Xanh Lá Vàng": "#33FF57",
    "Xanh Dương": "#3357FF",
    "Vàng": "#F1C40F",
    "Tím": "#8E44AD",
    "Xanh Lam Nhạt": "#1ABC9C",
    "Xanh Lá Cây": "#2ECC71",
    "Đỏ": "#E74C3C",
    "Xanh Da Trời": "#3498DB",
    "Xanh Đậm": "#34495E",
    "Trắng": "#FFFFFF",
    "Đen": "#000000",
    "Xám": "#808080",
    "Đỏ Sáng": "#FF0000",
    "Xanh Lá Sáng": "#00FF00",
    "Xanh Dương Sáng": "#0000FF",
    "Vàng Sáng": "#FFFF00",
    "Cam Sáng": "#FFA500",
    "Tím Sáng": "#800080",
    "Xanh Lam Sáng": "#00FFFF",
    "Hồng Sáng": "#FFC0CB",
    "Nâu Sáng": "#800000",
    "Óc Chó Sáng": "#808000",
    "Xanh Da Trời Sáng": "#008080",
    "Xanh Dương Sáng": "#000080",
    "Vàng Rực": "#FFD700",
    "Xanh Lá Vàng Sáng": "#ADFF2F",
    "Hồng Nóng": "#FF69B4",
    "Đỏ Gạch": "#CD5C5C",
    "Xanh Lơ Sáng": "#4B0082",
    "Vàng Lục Sáng": "#7FFF00",
    "Sôcôla Sáng": "#D2691E",
    "Màu Máu Sáng": "#DC143C",
    "Xanh Lam Đậm": "#00CED1",
    "Đỏ Cam Sáng": "#FF4500",
    "Hồng Dã Quỳ Sáng": "#DA70D6",
    "Xanh Bảo Ngọc Sáng": "#B0E0E6",
    "Xanh Lam Đậm Sáng": "#6A5ACD",
    "Xanh Lục Nhạt Sáng": "#98FB98",
    "Xanh Lam Nhạt Sáng": "#AFEEEE",
    "Hồng Tím Nhạt Sáng": "#DB7093",
    "Hồng Phấn Sáng": "#FFE4E1",
    "Xanh Thép Sáng": "#4682B4",
    "Màu Da Sáng": "#D2B48C",
    "Hồng Nhạt Sáng": "#FFB6C1",
    "Xanh Biển Nhạt Sáng": "#20B2AA",
    "Xám Lam Nhạt Sáng": "#778899",
    "Gạch Lửa Sáng": "#B22222",
    "Xanh Rừng Sáng": "#228B22",
    "Cà Chua Sáng": "#FF6347",
    "San Hô Sáng": "#FF7F50",
    "Xanh Dương Phục Hồi Sáng": "#5F9EA0",
    "Xanh Lam Trung Bình Sáng": "#7B68EE",
    "Xanh Biển Sáng": "#2E8B57",
    "Tím Sáng": "#EE82EE",
    "Hồng Nhạt Sáng": "#F08080",
    "Tím Xanh Sáng": "#8A2BE2",
    "Xanh Lục Cỏ Sáng": "#7CFC00",
    "Xanh Lơ Nhạt Sáng": "#40E0D0",
    "Đỏ Đậm Sáng": "#8B0000",
    "Hồng Đậm Sáng": "#BA55D3",
    "Xanh Biển Sáng": "#7FFFD4",
    "Hoa Cải Sáng": "#D8BFD8",
    "Da Lừa Sáng": "#FFE4B5",
    "Nâu Sáng": "#A52A2A",
    "Xanh Lục Biển Đậm Sáng": "#8FBC8F",
    "Vàng Chanh Sáng": "#FFFACD",
    "Salmon Sáng": "#FA8072",
    "Xám Nhạt Sáng": "#D3D3D3"
};


    function changeColor() {
        var selectBox = document.getElementById("IDMau");
        var colorBox = document.getElementById("colorBox");
        var selectedColorName = selectBox.options[selectBox.selectedIndex].text;

        // Kiểm tra xem tên màu có tồn tại trong colorMap hay không
        if (colorMap.hasOwnProperty(selectedColorName)) {
            var selectedColorHex = colorMap[selectedColorName]; // Lấy mã HEX tương ứng với tên màu
            colorBox.style.backgroundColor = selectedColorHex; // Gán màu cho ô vuông
        } else {
            // Nếu không tìm thấy tên màu trong colorMap, sử dụng màu mặc định
            colorBox.style.backgroundColor = "#FFFFFF"; // Màu trắng
        }
    }
</script>
