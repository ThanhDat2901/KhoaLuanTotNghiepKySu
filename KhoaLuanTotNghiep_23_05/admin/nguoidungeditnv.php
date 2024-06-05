<?php include 'inc/headernv.php';?>
<?php include 'inc/sidebarnv.php';?>
<?php include '../classes/nguoidung.php' ?>
<?php include '../classes/quyen.php' ?>
<?php include '../classes/phanquyen.php' ?>
<?php
   
    // if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
    //    echo "<script>window.location ='brandlist.php'</script>";
    // }else{
    //      $id = $_GET['brandid']; 
    // }
     $id =  $_SESSION['quanly_id'];
     $brand = new nguoidung();
     $phanquyen = new phanquyen();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $TenNguoiDung = $_POST['TenNguoiDung'];
        $SDT = $_POST['SDT'];
        $Email = $_POST['Email'];
        $MatKhau = $_POST['MatKhau'];
        $updateBrand = $brand->update_brand1($TenNguoiDung,'Nhân Viên Tự Cung Cấp',$SDT,$Email,$MatKhau,$id);
        
        // $update_phanquyen = $phanquyen ->update_PhanQuyen($IDQuyen,$id);
    }

?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thay Đổi Thông Tin Cá Nhân</h2>
                
               <div class="block copyblock"> 
                 <?php
                if(isset($updateBrand)){
                    echo $updateBrand;
                }
                ?>
                <?php
                    $get_brand_name = $brand->ShowThongTinNguoiDungById($id);
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                       
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Tên Người Dùng</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo htmlspecialchars($result['TenNguoiDung'], ENT_QUOTES, 'UTF-8'); ?>"  name="TenNguoiDung" id="usernameInput" placeholder="Thay đổi tên người dùng..." class="medium" />
                                <div id="usernameError" style="display: none; color: red;">Tên người dùng không được chứa ký tự số hoặc ký tự đặc biệt.</div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo htmlspecialchars($result['Email'], ENT_QUOTES, 'UTF-8'); ?>" name="Email" id="emailInput" placeholder="Thay đổi Email..." class="medium" />
                                 <div id="emailError" style="display: none; color: red;">Định dạng email không hợp lệ.</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Số Điện Thoại</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo htmlspecialchars($result['SDT'], ENT_QUOTES, 'UTF-8'); ?>" name="SDT" id="phoneInput" placeholder="Nhập số điện thoại..." class="medium" />
                                <div id="phoneError" style="display: none; color: red;">Số điện thoại không hợp lệ.</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Địa Chỉ</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo $result['DiaChi'] ?>" name="DiaChi" placeholder="Thay đổi địa chỉ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mật Khẩu</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="password" value="<?php echo $result['MatKhau']; ?>" name="MatKhau" id="" readonly  class="medium" />
                            </td>
                        </tr>
                        
						<tr> 
                            <td>
                                <input id="" type="submit" value="Lưu"/>
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
        <script>
            function validatePhoneNumber(phoneNumber) {
                var regex = /^(\+84|0)(3[2-9]|5[6-9]|7[0-9]|8[1-9]|9[0-4]|9[6-9])\d{7}$/;
                return regex.test(phoneNumber);
            }

            // Hàm kiểm tra và hiển thị thông báo lỗi khi định dạng số điện thoại không hợp lệ
            function checkPhoneNumber() {
                var phoneInput = document.getElementById("phoneInput");
                var phoneError = document.getElementById("phoneError");

                if (!validatePhoneNumber(phoneInput.value)) {
                    phoneError.style.display = "block";
                    phoneInput.focus();
                    return false;
                } else {
                    phoneError.style.display = "none";
                    return true;
                }
            }

            // Bắt sự kiện khi nhập liệu vào ô input số điện thoại
            var phoneInput = document.getElementById("phoneInput");
            phoneInput.addEventListener("input", checkPhoneNumber);

                // Hàm kiểm tra định dạng email
                function validateEmail(email) {
                    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
                    return regex.test(email);
                }

                // Hàm kiểm tra và hiển thị thông báo lỗi khi định dạng email không hợp lệ
                function checkEmail() {
                    var emailInput = document.getElementById("emailInput");
                    var emailError = document.getElementById("emailError");

                    if (!validateEmail(emailInput.value)) {
                        emailError.style.display = "block";
                        emailInput.focus();
                        return false;
                    } else {
                        emailError.style.display = "none";
                        return true;
                    }
                }

                // Bắt sự kiện khi nhập liệu vào ô input email
                var emailInput = document.getElementById("emailInput");
                emailInput.addEventListener("input", checkEmail);


                // Hàm kiểm tra mật khẩu và xác nhận mật khẩu
                function checkPasswords() {
                    var passwordInput = document.getElementById("passwordInput");
                    var confirmPasswordInput = document.getElementById("confirmPasswordInput");
                    var passwordError = document.getElementById("passwordError");

                    if (passwordInput.value !== confirmPasswordInput.value) {
                        passwordError.style.display = "block";
                        confirmPasswordInput.focus();
                        return false;
                    } else {
                        passwordError.style.display = "none";
                        return true;
                    }
                }

                // Bắt sự kiện khi nhập liệu vào ô input xác nhận mật khẩu
                var confirmPasswordInput = document.getElementById("confirmPasswordInput");
                confirmPasswordInput.addEventListener("input", checkPasswords);

                    // Hàm kiểm tra và hiển thị thông báo lỗi khi có ký tự số trong tên người dùng
                    function checkUsername() {
                            var usernameInput = document.getElementById("usernameInput");
                            var usernameError = document.getElementById("usernameError");
                            var username = usernameInput.value;

                            if (/\d/.test(username) || /[^A-Za-zÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬĐÈÉẺẼẸÊẾỀỂỄỆÌÍỈĨỊÒÓỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÙÚỦŨỤƯỨỪỬỮỰỲÝỶỸỴa-z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ]/.test(username)) {
                                // Kiểm tra có ký tự số hoặc ký tự đặc biệt trong tên người dùng hay không
                                usernameError.style.display = "block";
                                usernameInput.focus();
                                return false;
                            } else {
                                usernameError.style.display = "none";
                                return true;
                            }
                        }
                // Bắt sự kiện khi nhập liệu vào ô input tên người dùng
                var usernameInput = document.getElementById("usernameInput");
                usernameInput.addEventListener("input", checkUsername);

                function validatePassword() {
                    var password = document.getElementsByName("MatKhau")[0].value;
                    var errorDiv = document.getElementById("error");
                    var saveButton = document.getElementById("saveButton");

                    // Kiểm tra độ dài
                    if (password.length < 6) {
                        errorDiv.innerHTML = "Mật khẩu phải có ít nhất 6 ký tự";
                        saveButton.disabled = true;
                        return false;
                    }

                    // Kiểm tra ký tự in hoa
                    var hasUppercase = /[A-Z]/.test(password);
                    if (!hasUppercase) {
                        errorDiv.innerHTML = "Mật khẩu phải chứa ít nhất 1 ký tự in hoa";
                        saveButton.disabled = true;
                        return false;
                    }

                    // Kiểm tra ký tự đặc biệt
                    var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                    if (!hasSpecialChar) {
                        errorDiv.innerHTML = "Mật khẩu phải chứa ít nhất 1 ký tự đặc biệt";
                        saveButton.disabled = true;
                        return false;
                    }

                    // Nếu tất cả điều kiện đều đúng
                    errorDiv.innerHTML = ""; // Xóa thông báo lỗi cũ
                    saveButton.disabled = false; // Cho phép nhấn nút "Lưu"
                    return true;
                }

        </script>
<?php include 'inc/footer.php';?>