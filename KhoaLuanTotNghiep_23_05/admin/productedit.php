<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/bosanpham.php';?>
<?php include '../classes/bosuutap.php';?>
<?php include '../classes/loai.php';?>
<?php include '../classes/km.php';?>
<?php include '../classes/size.php';?>
<?php include '../classes/product.php';?>
<?php
    $pd = new product();

    if(!isset($_GET['productid']) || $_GET['productid']==NULL){
       echo "<script>window.location ='productlist.php'</script>";
    }else{
         $id = $_GET['productid']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $updateProduct = $pd->update_product($_POST,$_FILES, $id);
        
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Thông Tin Sản Phẩm</h2>
        <div class="block">    
         <?php

                if(isset($updateProduct)){
                    echo $updateProduct;
                }
                $giaCuoi = 0;

            ?>        
        <?php
         $get_product_by_id = $pd->getproductbyId($id);
            if($get_product_by_id){
                while($result_product = $get_product_by_id->fetch_assoc()){
        ?>     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên Sản Phẩm</label>
                    </td>
                    <td>
                        <input type="text"  name="TenSanPham" value="<?php echo  $result_product['TenSanPham']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô Tả Sản Phẩm</label>
                    </td>
                    <td>
                        <textarea name="ThongTin" class="tinymce"><?php echo $result_product['ThongTin'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá Đầu</label>
                    </td>
                    <td>
                        <input type="text" id="GiaDau"  name="GiaDau" value="<?php echo  $result_product['GiaDau']?>" class="medium" />
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

                            <option
                            <?php
                            if($result['IDLoai']==$result_product['IDLoai']){ echo 'selected';  }
                            ?>

                             value="<?php echo $result['IDLoai'] ?>"><?php echo $result['TenLoai'] ?></option>



                               <?php
                                  }
                              }
                           ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Khuyến Mãi</label>
                    </td>
                    <td>
                        <select style="width: 240px;display: none;" id="mySelect" name="IDKhuyenMai">
                            <option style = "width:100px">--------Chọn Khuyến Mãi--------</option>
                            <?php
                            $cat = new km();
                            $catlist = $cat->show_brand_DateOver();

                            if($catlist){
                                
                                while($result = $catlist->fetch_assoc()){
                             ?>
                            <option
                            <?php
                            if($result['IDKhuyenMai']==$result_product['IDKhuyenMai']){ echo 'selected';  }
                            ?>

                             value="<?php echo $result['IDKhuyenMai'] ?>"><?php echo $result['TienKhuyenMai'] ?>%</option>


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
                        <img src="<?php echo $result_product['HinhAnh'] ?>" width="90"><br>
                        <input type="text" name="HinhAnh" placeholder="Link Hinh Anh..." class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Kiểu Sản Phẩm</label>
                    </td>
                    <td>
                        <select style="width: 240px;" id="select" name="type">
                            <option>-----Chọn Kiểu-----</option>
                            <?php
                            if($result_product['type']==0){
                            ?>
                            <option selected value="0">Nổi Bật</option>
                            <option value="1">Không Nổi Bật</option>
                            <?php
                        }else{
                            ?>
                            <option value="0">Nổi Bật</option>
                            <option selected value="1">Không Nổi Bật</option>
                            <?php
                            }
                            ?>
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
            <?php
        }

        }
            ?>
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
                giaCuoi.value = parseFloat(res.toFixed(1));
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


