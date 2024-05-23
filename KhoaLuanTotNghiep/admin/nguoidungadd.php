<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/nguoidung.php' ?>
<?php include '../classes/quyen.php' ?>
 <?php
    $brand = new nguoidung();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $TenNguoiDung = $_POST['TenNguoiDung'];
        $DiaChi = $_POST['DiaChi'];
        $SDT = $_POST['SDT'];
        $Email = $_POST['Email'];
        $MatKhau = $_POST['$1111'] ??'';
        $XacNhanMatKhau = $_POST['$1111'] ??'';
        $IDQuyen = $_POST['IDQuyen'] ?? '';
        $insertBrand = $brand->insert_brand1($TenNguoiDung,$DiaChi,$SDT,$Email,$MatKhau,$XacNhanMatKhau,$IDQuyen);
        
    }
?> 
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm Tài Khoản Mới</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($insertBrand)){
                    echo $insertBrand;
                }
                ?> 
                 <form action="nguoidungadd.php" method="post">
                    <table class="form">					
                        <tr>
                        <td>
                            <label>Tên Nhân Viên</label>
                        </td>
                        <td>
                            <input style="width: 300px" type="text" name="TenNguoiDung" id="usernameInput" placeholder="Nhập tên người dùng..." class="medium"  onblur="checkUsername(this)" />
                            <div id="usernameError" style="display: none; color: red;">Tên người dùng không được chứa ký tự số hoặc ký tự đặc biệt.</div>
                        </td>
                        </tr>
                        <td>
                            <label>Địa Chỉ</label>
                            </td>
                            <td>
                                 <input style="width:300px" type="text" name="DiaChi" id="addressInput" placeholder="Nhập địa chỉ..." class="medium"  onblur="validateAddress(this)" />
                                
                            </td>
                        <tr>
                        <td>
                            <label>Số Điện Thoại</label>
                        </td>
                        <td>
                            <input style="width:300px" type="text" name="SDT" id="SDT" placeholder="Nhập số điện thoại..." class="medium" onblur="validatePhoneNumber(this)" />
                        </td>
                        </tr>
                        <tr>
                        <td>
                            <label>Email</label>
                            <td>
                                <input style="width: 300px" type="text" name="Email" id="emailInput" placeholder="Nhập email..." class="medium" />
                                <div id="emailError" style="display: none; color: red;">Vui lòng nhập địa chỉ email hợp lệ.</div>
                            </td>
                        <tr>
                            <td>
                                <label>Mật Khẩu</label>
                            </td>
                            <td>
                                <input style="width: 300px" type="password" name="MatKhau" placeholder="*****" class="medium" disabled  />
                                <div id="error" style="color: red;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Xác Nhận Mật Khẩu</label>
                            </td>
                            <td>
                                <input style="width: 300px" type="password" name="XacNhanMatKhau" id="confirmPasswordInput" placeholder="*****" class="medium" disabled  />
                                <div id="passwordError" style="display: none; color: red;">Mật khẩu và xác nhận mật khẩu không trùng khớp.</div>
                            </td>
                        </tr>
                        
                
						<tr> 
                            <td>
                                <input id="saveButton" type="submit" value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <div id="errorMessage" style="display: none;">
                                <span style="color:red;font-weight: bold" id="errorMessageText">Vui lòng nhập số điện thoại hợp lệ của Việt Nam</span>
                                <button id="okButton">OK</button>
                            </div>
                    <div id="errorMessage1" style="display: none;">
                        <span style="color:red;font-weight: bold" id="errorMessageText1">Vui lòng nhập địa chỉ ở Việt Nam.</span>
                        <button id="okButton1">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function validatePhoneNumber(input) {
                var regex = /^(\+84|0)(3[2-9]|5[6-9]|7[0-9]|8[1-9]|9[0-4]|9[6-9])\d{7}$/;
                    if (!regex.test(input.value) || input.value.length > 13) {
                        var errorMessage = document.getElementById("errorMessage");
                        var errorMessageText = document.getElementById("errorMessageText");
                        errorMessage.style.display = "block";
                        errorMessageText.textContent = "Vui lòng nhập số điện thoại hợp lệ của Việt Nam";
                        input.focus();

                        // Khi nút "OK" được nhấn
                        var okButton = document.getElementById("okButton");
                        okButton.onclick = function() {
                            errorMessage.style.display = "none";
                            input.value = ""; // Xóa nội dung của input để cho phép nhập lại
                        };

                        return false;
                    }
                    // Ẩn thông báo sau khi hiển thị
                    var errorMessage = document.getElementById("errorMessage");
                    errorMessage.style.display = "none";
                    return true;
                }

                // Hàm kiểm tra định dạng email
                function validateEmail(email) {
                var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                return regex.test(email);
                }
                // Hàm kiểm tra và hiển thị thông báo lỗi
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
                // Bắt sự kiện khi nhập liệu vào ô input
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

                    if (/\d/.test(username) || /[^A-Za-zÀÁẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬĐÈÉẺẼẸÊẾỀỂỄỆÌÍỈĨỊÒÓỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÙÚỦŨỤƯỨỪỬỮỰỲÝỶỸỴa-z\sàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ]/.test(username) || /[1-9]/.test(username)) {
                        // Kiểm tra có ký tự số hoặc ký tự đặc biệt hoặc số từ 1 đến 9 trong tên người dùng hay không
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


                function validateAddress(input) {
                    var vietnamKeywords = ["việt nam", "vn"]; // Từ khóa để kiểm tra địa chỉ ở Việt Nam
                    var address = input.value.toLowerCase(); // Chuyển địa chỉ nhập vào thành chữ thường để so sánh

                    // Kiểm tra xem địa chỉ có chứa từ khóa của Việt Nam không
                    var isVietnamAddress = vietnamKeywords.some(function(keyword) {
                        return address.includes(keyword);
                    });

                    // Nếu không phải là địa chỉ ở Việt Nam
                    if (!isVietnamAddress) {
                        var errorMessage = document.getElementById("errorMessage1");
                        var errorMessageText = document.getElementById("errorMessageText1");
                        errorMessage.style.display = "block";
                        errorMessageText.textContent = "Vui lòng nhập địa chỉ ở Việt Nam.";

                        // Khi nút "OK" được nhấn
                        var okButton = document.getElementById("okButton1");
                        okButton.onclick = function() {
                            errorMessage.style.display = "none";
                            input.value = ""; // Xóa nội dung của input để cho phép nhập lại
                        };

                        input.focus(); // Focus vào input để người dùng có thể nhập lại
                        return false;
                    }

                    // Nếu là địa chỉ hợp lệ ở Việt Nam, ẩn thông báo lỗi
                    var errorMessage = document.getElementById("errorMessage1");
                    errorMessage.style.display = "none";
                    return true;
                }
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
                        // Kiểm tra số
                    var hasNumber = /\d/.test(password);
                    if (!hasNumber) {
                        errorDiv.innerHTML = "Mật khẩu phải chứa ít nhất 1 số";
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