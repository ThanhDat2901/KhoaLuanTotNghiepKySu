<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/loai.php' ?>
 <?php
    $brand = new loai();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $TenLoai = $_POST['TenLoai'];
        $insertBrand = $brand->insert_brand($TenLoai);
        
    }
?> 
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm Loại Mới</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($insertBrand)){
                    echo $insertBrand;
                }
                ?> 
                 <form action="loaiadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Tên Loại Sản Phẩm</label>
                            </td>
                                <td>
                                <input type="text" name="TenLoai" placeholder="Nhập tên Loại Sản Phẩm..." class="medium" oninput="validateInput(this)" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input id="saveButton" type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                     </table>
                    </form>
                    <div id="errorDiv" style="color: red;"></div>
                </div>
            </div>
        </div>
        <script>
        // function validateInput(input) {
        //     var regex = /^[A-Z\sÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬĐÈÉẺẼẸÊẾỀỂỄỆÌÍỈĨỊÒÓỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÙÚỦŨỤƯỨỪỬỮỰỲÝỶỸỴa-z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ]+$/;

        //     var errorDiv = document.getElementById("errorDiv");

        //     if (!regex.test(input.value)) { // Nếu không phù hợp với biểu thức chính quy
        //         errorDiv.innerHTML = "Vui lòng chỉ nhập chữ cái và khoảng trắng.";
        //         input.value = ""; // Xóa giá trị đã nhập
        //         setTimeout(function() {
        //             input.focus(); // Trở lại trường input
        //         }, 1000); // Hiển thị thông báo lỗi trong 1 giây và sau đó tự động xóa đi
                
        //         // Vô hiệu hóa nút lưu
        //         document.getElementById('saveButton').disabled = true;
        //     } else {
        //         errorDiv.innerHTML = ""; // Xóa thông báo lỗi
        //         // Kích hoạt nút lưu
        //         document.getElementById('saveButton').disabled = false;
        //     }
        // }
        function validateInput(input) {
            var regex = /^[\p{L}\s]+$/u;

            var errorDiv = document.getElementById("errorDiv");

            if (!regex.test(input.value)) { // Nếu không phù hợp với biểu thức chính quy
                errorDiv.innerHTML = "Vui lòng chỉ nhập chữ cái và khoảng trắng.";
                // Vô hiệu hóa nút lưu
                document.getElementById('saveButton').disabled = true;
            } else {
                errorDiv.innerHTML = ""; // Xóa thông báo lỗi
                // Kích hoạt nút lưu
                document.getElementById('saveButton').disabled = false;
            }
        }
    </script>
<?php include 'inc/footer.php';?>