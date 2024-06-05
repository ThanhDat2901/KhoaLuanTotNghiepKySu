<?php include 'inc/headernv.php';?>
<?php include 'inc/sidebarnv.php';?>
<?php include '../classes/bosanpham.php' ?>
 <?php
    $brand = new brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $MatKhau = $_POST['MatKhau'];
        $MatKhauMoi = $_POST['MatKhauMoi'];
        $IDNguoiDung = $_SESSION['quanly_id'];
        $insertBrand = $brand->doiMatKhau($IDNguoiDung, $MatKhau, $MatKhauMoi);
        
    }
?> 
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thay Đổi Mật Khẩu</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($insertBrand)){
                    echo $insertBrand;
                }
                ?> 
                 <form action="changepasswordnv.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Mật Khẩu Cũ</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Nhập mật khẩu cũ..."  name="MatKhau" class="medium"  />
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mật Khẩu Mới</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Nhập mật khẩu mới..." name="MatKhauMoi" class="medium" onkeyup="validatePassword()"/>
                                <div style="color:red" id="error-messages"></div>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" value="Lưu" name="Luu" disabled />
                            </td>
                        </tr>
                    </table>
                    </form>
                    
                </div>
            </div>
        </div>
    <script>
        function validatePassword() {
            var password = document.getElementsByName("MatKhauMoi")[0].value;
            var errorDiv = document.getElementById("error-messages");
            errorDiv.innerHTML = ""; // Xóa các thông báo lỗi trước đó
            // Biến đánh dấu liệu có lỗi không
            var hasError = false;
            // Kiểm tra độ dài của mật khẩu
            if (password.length < 6) {
                var p = document.createElement("p");
                p.textContent = "Mật khẩu phải chứa ít nhất 6 ký tự.";
                errorDiv.appendChild(p);
                hasError = true;
            }
            // Kiểm tra mật khẩu có chứa ít nhất một ký tự in hoa
            if (!/[A-Z]/.test(password)) {
                var p = document.createElement("p");
                p.textContent = "Mật khẩu phải chứa ít nhất một ký tự in hoa.";
                errorDiv.appendChild(p);
                hasError = true;
            }
            // Kiểm tra mật khẩu có chứa ít nhất một ký tự đặc biệt
            if (!/[^a-zA-Z0-9]/.test(password)) {
                var p = document.createElement("p");
                p.textContent = "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
                errorDiv.appendChild(p);
                hasError = true;
            }
            if (!/\d/.test(password)) {
                var p = document.createElement("p");
                p.textContent = "Mật khẩu phải chứa ít nhất một số.";
                errorDiv.appendChild(p);
                hasError = true;
            }
            // Nếu có lỗi, vô hiệu hóa nút "Lưu", ngược lại kích hoạt nút "Lưu"
            document.getElementsByName("Luu")[0].disabled = hasError;
        }
    </script>

<?php include 'inc/footer.php';?>