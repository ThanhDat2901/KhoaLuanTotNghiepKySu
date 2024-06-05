<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/loai.php';?>
<?php include '../classes/km.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/mausac.php';?>
<?php
    $pd = new product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertProduct = $pd->insert_product($_POST,$_FILES);
        
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Sản Phẩm</h2>
        <div class="block">    
         <?php

                if(isset($insertProduct)){
                    echo $insertProduct;
                }
                $giaCuoi = 0;

            ?>    

         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên Sản Phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="TenSanPham" placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô Tả Sản Phẩm</label>
                    </td>
                    <td>
                        <textarea name="ThongTin" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá Ban Đầu</label>
                    </td>
                    <td>
                        <input type="text" name="GiaDau" id="GiaDau" placeholder="Giá ban đầu..." class="medium" />
                       <div>
                            <span style="font-size:14px" id="giaError" class="error"></span>
                        </div>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <label>Giá Sau Khuyến Mãi</label>
                    </td>
                    <td>
                        <input type="text" name="GiaCuoi" id="GiaCuoi" placeholder="Giá sau khuyến mãi..." class="medium" readonly />
                    </td>
                </tr>
               
                
				
                <tr>
                    <td>
                        <label>Loại Sản Phẩm</label>
                    </td>
                    <td>
                        <select style="width: 250px;" id="select" name="IDLoai">

                            <?php
                            $cat = new loai();
                            $catlist = $cat->show_brand();

                            if($catlist){
                                while($result = $catlist->fetch_assoc()){
                             ?>

                            <option value="<?php echo $result['IDLoai'] ?>"><?php echo $result['TenLoai'] ?></option>

                               <?php
                                  }
                              }
                           ?>
                        </select>
                    </td>
                </tr>
                <tr>
                        <td>
                            <label>Tên Màu</label>
                        </td>
                        <td>
                            <select style="width: 250px;" id="IDMau" name="IDMau" onchange="changeColor()">
                                <?php
                                // Hiển thị danh sách các bộ sản phẩm
                                $cat = new mausac();
                                $catlist = $cat->show_brand();

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
                            <div id="colorBox" style="width: 250px; height: 30px; border: 1px solid black;"></div>
                        </td>
                    </tr>
				
				
                <tr>
                    <td>
                        <label>Khuyến Mãi (%)</label>
                    </td>
                    <td>
                        <select style="width: 250px;display: none;" id="mySelect" name="IDKhuyenMai"  >
                        <option>--------Chọn Khuyến Mãi--------</option>
                             <?php
                            $brand = new km();
                            $brandlist = $brand->show_brand_DateOver();

                            if ($brandlist) {
                                
                            
                                while ($result = $brandlist->fetch_assoc()) {
                                    
                                    ?>
                                    
                                    <option value="<?php echo $result['IDKhuyenMai'] ?>"><?php echo $result['TienKhuyenMai'] ?>%</option>
                                    <?php
                                    // Kiểm tra nếu option "Không giảm" chưa được thêm vào
                                    
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
                            <input type="text" name="HinhAnh" placeholder="Link Hinh Anh..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Kiểu Sản Phẩm</label>
                    </td>
                    <td>
                        <select style="width: 240px;" id="select" name="type">
                            <option>Chọn Kiểu</option>
                            <option value="1">Nổi Bật</option>
                            <option value="0">Không Nổi Bật</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Lưu" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
                    
    document.getElementById("mySelect").addEventListener("change", function() {
        var giaDauInput = document.getElementById("GiaDau");
        var giaDauValue = parseFloat(giaDauInput.value);
        
        // Lấy giá trị của tùy chọn được chọn
        var selectedOptionId = this.value;
        
        // Kiểm tra nếu `giaDauValue` là số hợp lệ
        if (isNaN(giaDauValue)) {
            alert("Vui lòng nhập giá ban đầu hợp lệ.");
            return;
        }

        // Lấy phần trăm khuyến mãi từ giá trị đã chọn
        var selectedOptionText = this.options[this.selectedIndex].textContent;
        var selectedOption = parseFloat(selectedOptionText);
        
        // Kiểm tra nếu `selectedOption` là số hợp lệ
        if (isNaN(selectedOption)) {
            alert("Vui lòng chọn phần trăm khuyến mãi hợp lệ.");
            return;
        }
        
        const giaCuoi = document.getElementById("GiaCuoi");
        
        // Tính toán giá cuối
        const res = giaDauValue - (giaDauValue * selectedOption / 100);
        giaCuoi.value = parseFloat(res.toFixed(0));
    });

    var giaDauInput = document.getElementById("GiaDau");
    var giaError = document.getElementById("giaError");

    giaDauInput.addEventListener('input', validateForm);

    function validateForm() {
        var giaDauValue = giaDauInput.value.trim();

        // Kiểm tra nếu giá đầu không hợp lệ
        if (!giaDauValue.match(/^[1-9]\d{0,3}(?:000)$/)) {
            giaError.textContent = "Vui lòng nhập số từ 4 chữ số trở lên hoặc ký tự số đầu tiên khác 0 và không chứa ký tự đặc biệt.";
            giaDauInput.focus();
            disableOtherFields(true); // Vô hiệu hóa các trường khác
            document.getElementById("mySelect").style.display = "none"; // Ẩn trường chọn khuyến mãi
        } else {
            giaError.textContent = ""; // Xóa thông báo lỗi nếu hợp lệ
            disableOtherFields(false); // Bật các trường khác
            document.getElementById("mySelect").style.display = "block"; // Hiển thị trường chọn khuyến mãi
        }
    }

    function disableOtherFields(disabled) {
        var otherFields = document.querySelectorAll('input:not(#GiaDau)');
        otherFields.forEach(function(field) {
            field.disabled = disabled;
        });
    }

                function validateForm() {
                    var giaDauValue = giaDauInput.value.trim();

                    // Kiểm tra nếu giá đầu không hợp lệ
                    if (!giaDauValue.match(/^[1-9]\d{0,3}(?:000)$/)) {
                        giaError.textContent = "Vui lòng nhập số từ 4 chữ số trở lên hoặc ký tự số đầu tiên khác 0 và không chứa ký tự đặc biệt.";
                        giaDauInput.focus();
                        disableOtherFields(true); // Vô hiệu hóa các trường khác
                        document.getElementById("mySelect").style.display = "none"; // Ẩn trường chọn khuyến mãi
                    } else {
                        giaError.textContent = ""; // Xóa thông báo lỗi nếu hợp lệ
                        disableOtherFields(false); // Bật các trường khác
                        document.getElementById("mySelect").style.display = "block"; // Hiển thị trường chọn khuyến mãi
                    }
                }
                    function disableOtherFields(disabled) {
                    var otherFields = document.querySelectorAll('input:not(#GiaDau)');
                    otherFields.forEach(function(field) {
                        field.disabled = disabled;
                    });
                }

                var colorMap = {
    "Đen": "#000000",
    "Xanh Dương Sáng": "#000080",
    "Xanh Dương": "#0000FF",
    "Xanh Lá Đậm Sáng": "#006400",
    "Xanh Lá Sáng": "#008000",
    "Xanh Da Trời Sáng": "#008080",
    "Xanh Lam Đậm": "#00CED1",
    "Xanh Lá Đậm Sáng": "#00FA9A",
    "Xanh Lá": "#00FF00",
    "Xanh Lục Sáng": "#00FF7F",
    "Xanh Lam Sáng": "#00FFFF",
    "Xanh Biển Sáng": "#00FFFF",
    "Xanh Đậm Sáng": "#191970",
    "Xanh Dương Nhạt Sáng": "#1E90FF",
    "Xanh Biển Nhạt Sáng": "#20B2AA",
    "Xanh Rừng Sáng": "#228B22",
    "Xanh Biển Sáng": "#2E8B57",
    "Xanh Biển": "#2E8B57",
    "Xám Dương Sáng": "#2F4F4F",
    "Xám Lam Sáng": "#2F4F4F",
    "Xanh Lá": "#32CD32",
    "Xanh Lá Đậm": "#3CB371",
    "Xanh Lơ Nhạt Sáng": "#40E0D0",
    "Xanh Dương Đậm Sáng": "#4169E1",
    "Xanh Thép Sáng": "#4682B4",
    "Xanh Lơ Đậm Sáng": "#483D8B",
    "Xanh Lơ Đậm": "#48D1CC",
    "Xanh Lơ Sáng": "#4B0082",
    "Xanh Lá Vàng Đậm Sáng": "#556B2F",
    "Xanh Dương Phục Hồi Sáng": "#5F9EA0",
    "Xanh Dương Nhạt Đậm Sáng": "#6495ED",
    "Tím Đậm Sáng": "#663399",
    "Xanh Lơ Đậm Sáng": "#66CDAA",
    "Xám Đậm Sáng": "#696969",
    "Xanh Lam Đậm Sáng": "#6A5ACD",
    "Xanh Lá Vàng Đậm": "#6B8E23",
    "Xám Đậm": "#708090",
    "Xám Lam Nhạt Sáng": "#778899",
    "Xanh Lam Trung Bình Sáng": "#7B68EE",
    "Xanh Lục Cỏ Sáng": "#7CFC00",
    "Vàng Lục Sáng": "#7FFF00",
    "Nâu Sáng": "#800000",
    "Tím Sáng": "#800080",
    "Óc Chó Sáng": "#808000",
    "Xám": "#808080",
    "Xanh Lơ Nhạt Sáng": "#87CEEB",
    "Xanh Lơ Nhạt Đậm Sáng": "#87CEFA",
    "Tím Xanh Sáng": "#8A2BE2",
    "Đỏ Đậm Sáng": "#8B0000",
    "Nâu Đậm Sáng": "#8B4513",
    "Xanh Lục Biển Đậm Sáng": "#8FBC8F",
    "Xanh Lục Nhạt Sáng": "#90EE90",
    "Tím Nhạt Sáng": "#9370DB",
    "Tím Đậm Sáng": "#9400D3",
    "Xanh Lục Nhạt Sáng": "#98FB98",
    "Tím Đậm Đậm Sáng": "#9932CC",
    "Xanh Lá Vàng Sáng": "#9ACD32",
    "Nâu Đậm Sáng": "#A0522D",
    "Nâu Sáng": "#A52A2A",
    "Xám Đậm Đậm Sáng": "#A9A9A9",
    "Xanh Lam Nhạt Đậm Sáng": "#ADD8E6",
    "Xanh Lá Vàng Sáng": "#ADFF2F",
    "Xanh Lam Nhạt Sáng": "#AFEEEE",
    "Xanh Lam Nhạt Đậm Sáng": "#B0C4DE",
    "Xanh Bảo Ngọc Sáng": "#B0E0E6",
    "Gạch Lửa Sáng": "#B22222",
    "Nâu Đậm Đậm Sáng": "#B8860B",
    "Hồng Đậm Sáng": "#BA55D3",
    "Nâu Sáng Đậm Sáng": "#BC8F8F",
    "Nâu Lục Sáng": "#BDB76B",
    "Bạc Sáng": "#C0C0C0",
    "Đỏ Hồng Đậm Sáng": "#C71585",
    "Đỏ Gạch": "#CD5C5C",
    "Nâu Đậm Đậm Sáng": "#CD853F",
    "Sôcôla Sáng": "#D2691E",
    "Màu Da Sáng": "#D2B48C",
    "Xám Nhạt Sáng": "#D3D3D3",
    "Hoa Cải Sáng": "#D8BFD8",
    "Hồng Dã Quỳ Sáng": "#DA70D6",
    "Hồng Tím Nhạt Sáng": "#DB7093",
    "Màu Máu Sáng": "#DC143C",
    "Hồng Tím Đậm Sáng": "#DDA0DD",
    "Nâu Sáng Đậm": "#DEB887",
    "Xanh Lam Đậm Đậm Sáng": "#E0FFFF",
    "Lavender Sáng": "#E6E6FA",
    "Đỏ Tươi Sáng": "#E9967A",
    "Tím Sáng": "#EE82EE",
    "Màu Bơ Sáng": "#EEE8AA",
    "Hồng Nhạt Sáng": "#F08080",
    "Da Lừa Sáng": "#F0E68C",
    "Xanh Lam Đậm Nhạt Sáng": "#F0F8FF",
    "Nha Đam Sáng": "#F0FFF0",
    "Trắng Sáng": "#F0FFFF",
    "Nâu Đậm Đậm Sáng": "#F4A460",
    "Da Lừa Sáng Đậm Sáng": "#F5DEB3",
    "Màu Kem Sáng": "#F5F5DC",
    "Xám Nhạt Sáng": "#F5F5F5",
    "Menta Sáng": "#F5FFFA",
    "Ghost White Sáng": "#F8F8FF",
    "Salmon Sáng": "#FA8072",
    "Da Cam Sáng": "#FAEBD7",
    "Lavender Sáng Đậm Sáng": "#FAF0E6",
    "Vàng Đậm Sáng": "#FAFAD2",
    "Da Cam Sáng Đậm Sáng": "#FDF5E6",
    "Đỏ Sáng": "#FF0000",
    "Hồng Sáng": "#FF00FF",
    "Tím Sáng": "#FF00FF",
    "Hồng Nhạt Sáng": "#FF1493",
    "Đỏ Cam Sáng": "#FF4500",
    "Cà Chua Sáng": "#FF6347",
    "Hồng Nóng": "#FF69B4",
    "San Hô Sáng": "#FF7F50",
    "Cam Đậm Sáng": "#FF8C00",
    "Đỏ Hồng Sáng": "#FFA07A",
    "Cam Sáng": "#FFA500",
    "Hồng Nhạt Sáng": "#FFB6C1",
    "Hồng Sáng": "#FFC0CB",
    "Vàng Rực": "#FFD700",
    "Peach Puff Sáng": "#FFDAB9",
    "Nâu Cam Sáng": "#FFDEAD",
    "Da Lừa Sáng": "#FFE4B5",
    "Kem Sáng": "#FFE4C4",
    "Hồng Phấn Sáng": "#FFE4E1",
    "Almond Sáng": "#FFEBCD",
    "Da Cam Sáng Nhạt Sáng": "#FFEFD5",
    "Lavender Blush Sáng": "#FFF0F5",
    "Sea Shell Sáng": "#FFF5EE",
    "Corn Silk Sáng": "#FFF8DC",
    "Vàng Chanh Sáng": "#FFFACD",
    "Nha Đam Sáng": "#FFFAF0",
    "Bông Gòn Sáng": "#FFFAFA",
    "Vàng Sáng": "#FFFF00",
    "Ivory Sáng": "#FFFFE0",
    "Mật Ong Sáng": "#FFFFF0",
    "Trắng": "#FFFFFF"

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
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


