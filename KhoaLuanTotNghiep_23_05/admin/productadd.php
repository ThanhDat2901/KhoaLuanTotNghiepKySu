<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/loai.php';?>
<?php include '../classes/km.php';?>
<?php include '../classes/product.php';?>
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
                        <select style="width: 240px;" id="select" name="IDLoai">
                            <option>--------Chọn Loại Sản Phẩm--------</option>
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
                        <label>Khuyến Mãi (%)</label>
                    </td>
                    <td>
                        <select style="width: 240px;display: none;" id="mySelect" name="IDKhuyenMai"  >
                            <option>--------Chọn Khuyến Mãi-------</option>
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
</script>
<script>
                    
                    document.getElementById("mySelect").addEventListener("change", function() {
                    var GiaDau = parseFloat(document.getElementById("GiaDau").value);
                    
                    // Lấy giá trị của tùy chọn được chọn
                    var selectedOptionId = this.value;

                    // Lấy phần trăm khuyến mãi từ giá trị đã chọn
                    var selectedOption = parseFloat(document.querySelector("option[value='" + selectedOptionId + "']").textContent);
                    console.log("Đã chọn: " + selectedOption);

                    const giaCuoi =  document.getElementById("GiaCuoi");
                    console.log(giaCuoi);
                    
                    const res =  GiaDau - (GiaDau * selectedOption / 100);
                    giaCuoi.value = parseFloat(res.toFixed(0.0));
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
                </script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


