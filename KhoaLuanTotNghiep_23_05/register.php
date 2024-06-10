<?php 


require 'classes/nguoidung.php';
require 'classes/phanquyen.php';
// $db = new Database();
// $pdo = $db->getConnect();
$nguoidung = new nguoidung();
$phanquyen = new phanquyen();
$error = '';
$errorsEmail='';
$errorsUsername='';
$errorsPhone='';
$errorsaddress='';
$errorspassword='';


$errorscity='';
$errorsdistrict='';
$errorsward='';
$errorshousenumber='';
if($_SERVER["REQUEST_METHOD"]  == "POST"){
    $password = $_POST['password'];
    $username = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $Phone = $_POST['Phone'];

    $city = $_POST['city'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $housenumber = $_POST['housenumber'];

    $cityName =$nguoidung->getNameAdressById('cities',$city); 
    $districtName = $nguoidung->getNameAdressById('districts',$district); 
    $wardName = $nguoidung->getNameAdressById('wards',$ward); 



    // $address = $_POST['address'];

    if (empty($userEmail)) {
        $errorsEmail = 'Email is required';
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errorsEmail = 'Invalid email format';
    }
    
    if (empty($username)) {
        $errorsUsername = 'Username is required';
    }
    if (empty($Phone)) {
        $errorsPhone = 'Phone is required';
    }
    if (empty($city)) {
        $errorscity = 'City is required';
    }
    if (empty($district)) {
        $errorsdistrict = 'district is required';
    }
    if (empty($ward)) {
        $errorsward = 'ward is required';
    }
    if (empty($housenumber)) {
        $errorshousenumber = 'housenumber is required';
    }
    if (empty($password)) {
        $errorspassword = 'Password is required';
    }
    
    if(!$errorsEmail && !$errorsUsername && !$errorsPhone && !$errorscity && !$errorsdistrict && !$errorsward && !$errorshousenumber && !$errorsaddress && !$errorspassword )
    {
        $role = 0;

     

        $fullAddress = $housenumber . ', ' . $wardName . ', ' . $districtName . ', ' . $cityName;

        $insertnguoidung = $nguoidung->insert_nguoidung($username,$fullAddress,$Phone,$userEmail,$password);
        if (is_int($insertnguoidung)) {
            $insertphanquyen = $phanquyen->PhanQuyenNguoiDung(3,$insertnguoidung);
            $success_message = 'Đăng kí thành công'; // Thêm thông điệp thành công
            header('Location: login.php?success='.$success_message); // Chuyển hướng với thông điệp thành công
            exit();
        } else {
            $error = $insertnguoidung;
        }
    }
}

?>
<?php  
require 'init.php';
include 'inc/header.php'?>

<style>
.error-popup {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f8d7da;
    color: #721c24;
    padding: 20px;
    border: 1px solid #f5c6cb;
    border-radius: 10px;
    z-index: 1000;
    width: 300px;
    text-align: center;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    }

    .error-popup-content {
        position: relative;
    }

    .progress-bar {
        width: 100%;
        height: 5px;
        background-color: #f5c6cb;
        margin-top: 10px;
    }

    .progress-bar-fill {
        height: 100%;
        background-color: #721c24;
        width: 0;
        transition: width 5s linear; /* Adjust time according to your requirement */
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const citySelect = document.getElementById("city");
    const districtSelect = document.getElementById("district");
    const wardSelect = document.getElementById("ward");
    const houseNumberInput = document.getElementById("housenumber");
    // Load cities
    fetch("yameshop/getCity.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(city => {
                let option = document.createElement("option");
                option.value = city.id;
                option.text = city.name;
                citySelect.add(option);
            });
        });

    // Load districts when city is selected
    citySelect.addEventListener("change", function() {
        districtSelect.innerHTML = "<option value=''>Chọn quận/huyện</option>";
        wardSelect.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect.disabled = true;
        districtSelect.disabled = false;

        fetch(`yameshop/getDistrict.php?city_id=${citySelect.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    let option = document.createElement("option");
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect.add(option);
                });
            });
    });

    // Load wards when district is selected
    districtSelect.addEventListener("change", function() {
        wardSelect.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect.disabled = false;

        fetch(`yameshop/getWard.php?district_id=${districtSelect.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(ward => {
                    let option = document.createElement("option");
                    option.value = ward.id;
                    option.text = ward.name;
                    wardSelect.add(option);
                });
            });
    });
    wardSelect.addEventListener("change", function() {
            houseNumberInput.disabled = false;
        });

        document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    document.getElementById('toggleRePassword').addEventListener('click', function () {
        const repasswordInput = document.getElementById('repassword');
        const type = repasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        repasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    const errorPopup = document.getElementById("errorPopup");
    const progressBarFill = document.getElementById("progressBarFill");

    <?php if($error): ?>
        // Display the popup
        errorPopup.style.display = "block";

        // Start the progress bar
        progressBarFill.style.width = "100%";

        // Hide the popup after 5 seconds
        setTimeout(function() {
            errorPopup.style.display = "none";
        }, 5000); // 5 seconds
    <?php endif; ?>

    });
    
</script>
<section class="vh-80" style="background-color: #FFFFFF;margin-top:5vh">
    <div class="container py5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="">

                                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-4">ĐĂNG KÝ</p>
                                <?php if($error): ?>
                                    <div id="errorPopup" class="error-popup" style="display: none;">
                                            <div class="error-popup-content">
                                                <span id="errorMessage"><?= $error ?></span>
                                                <div class="progress-bar">
                                                    <div class="progress-bar-fill" id="progressBarFill"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                <form action=""method="POST">
                                    <div class="row"> 
                                        <div class="col-lg-6">   
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0">
                                                    <label class="form-label" for="form3Example1c">Tên người dùng</label>
                                                    <input type="text" placeholder="Nhập tên người dùng" name="userName"  id="usernameInput" class="form-control" required  onblur="checkUsername(this)" />
                                                    <div id="usernameError" style="display: none; color: red;">Tên người dùng không được chứa ký tự đặc biệt.</div>
                                                    <span class="text-danger" style="color:red"><?= $errorsUsername?></span>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0">
                                                    <label class="form-label" for="form3Example1c">Email</label>
                                                    <input type="email"  placeholder="Nhập email" name="userEmail" id="emailInput" class="form-control"required  />
                                                
                                                    <div id="emailError" style="display: none; color: red;">Vui lòng nhập địa chỉ email hợp lệ.</div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0">
                                                    <label class="form-label" for="form3Example1c">Số điện thoại</label>
                                                    <input type="text"  placeholder="Nhập số điện thoại" name="Phone" class="form-control" required onblur="validatePhoneNumber(this)" />
                                                
                                                    <span class="text-danger" style="color:red"><?= $errorsPhone?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0 position-relative">
                                                    <label class="form-label" for="form3Example1c">Mật khẩu</label>
                                                    <div class="input-group">
                                                        <input type="password" placeholder="Nhập mật khẩu" name="password" id="password" class="form-control" required onblur="validatePassword();checkPasswords()" oninput="validatePassword();checkPasswords()" />
                                                      
                                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="right: 0; position: absolute; top: 50%; transform: translateY(-50%);">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                      <div id="error" style="color: red;"></div>
                                                    <span class="text-danger" style="color:red"><?= $errorspassword?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0 position-relative">
                                                    <label class="form-label" for="form3Example1c">Nhập lại mật khẩu</label>
                                                    <div class="input-group">
                                                        <input type="password" placeholder="Nhập lại mật khẩu" name="repassword" id="repassword" class="form-control" required onblur="checkPasswords()" oninput="checkPasswords()" />
                                                        <button class="btn btn-outline-secondary" type="button" id="toggleRePassword" style="right: 0; position: absolute; top: 50%; transform: translateY(-50%);">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div id="passwordError" style="display: none; color: red;">Mật khẩu không trùng khớp.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"> 
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="city">Tỉnh/Thành phố</label>
                                                    <select id="city" class="form-control" name="city" required >
                                                        <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                                    </select>
                                                    <span class="text-danger" style="color:red"><?= $errorscity?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="district">Quận/Huyện</label>
                                                    <select id="district" class="form-control" name="district" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsdistrict?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="ward">Xã/Phường</label>
                                                    <select id="ward" class="form-control" name="ward" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsward?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-house-user fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="housenumber">Tên đường, tòa nhà, số nhà</label>
                                                    <input type="text" id="housenumber" class="form-control" name="housenumber" required disabled>
                                                    <span class="text-danger" style="color:red"><?= $errorshousenumber?></span>
                                                </div>
                                            </div>
                                        </div>

                                        


                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button class="btn btn-primary btn-lg" id="saveButton" type="submit" name="submit">Đăng ký</button>
                                            <a href="index.php" class="btn btn-danger btn-lg ms-5">trở lại</a>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
     function validatePhoneNumber(input) {
                        // const phoneNumberPattern = /^(\+?84|0)[3-9]\d{8}$/;
                        const phoneNumberPattern = /^(\+84|0)(3[2-9]|5[6-9]|7[0-9]|8[1-9]|9[0-4]|9[6-9])\d{7}$/;
                        const phoneInput = input.value;
                        const errorSpan = input.nextElementSibling;
                        
                        if (!phoneNumberPattern.test(phoneInput)) {
                            errorSpan.textContent = 'Vui lòng nhập số điện thoại hợp lệ của Việt Nam.';
                        } else {
                            errorSpan.textContent = '';
                        }
                }
                    // function validatePhoneNumber(input) {
                        //     var regex = /^(\+84|0)(3[2-9]|5[6-9]|7[0-9]|8[1-9]|9[0-4]|9[6-9])\d{7}$/;
                        //         if (!regex.test(input.value) || input.value.length > 13) {
                        //             var errorMessage = document.getElementById("errorMessage");
                        //             var errorMessageText = document.getElementById("errorMessageText");
                        //             errorMessage.style.display = "block";
                        //             errorMessageText.textContent = "Vui lòng nhập số điện thoại hợp lệ của Việt Nam";
                        //             input.focus();

                        //             // Khi nút "OK" được nhấn
                        //             var okButton = document.getElementById("okButton");
                        //             okButton.onclick = function() {
                        //                 errorMessage.style.display = "none";
                        //                 input.value = ""; // Xóa nội dung của input để cho phép nhập lại
                        //             };

                        //             return false;
                        //         }
                        //         // Ẩn thông báo sau khi hiển thị
                        //         var errorMessage = document.getElementById("errorMessage");
                        //         errorMessage.style.display = "none";
                        //         return true;
                    //     }

                            // Hàm kiểm tra định dạng email
                function validateEmail(email) {
                                var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                var domainPart = email.split('@')[1];
                                var domainRegex = /^[^@]*\.[^@\.]*$/; // Kiểm tra chỉ có một dấu chấm trong phần domain
                                return regex.test(email) && domainRegex.test(domainPart);
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




               // Bắt sự kiện khi nhập liệu vào ô input xác nhận mật khẩu
                // var confirmPasswordInput = document.getElementById("repassword");
                // confirmPasswordInput.addEventListener("input", checkPasswords);


                // Hàm kiểm tra và hiển thị thông báo lỗi khi có ký tự số trong tên người dùng
                function checkUsername() {
                    var usernameInput = document.getElementById("usernameInput");
                    var usernameError = document.getElementById("usernameError");
                    var username = usernameInput.value;
                    // var specialCharRegex = /[^a-zA-Z0-9\sÀ-ÖØ-öø-ÿĀ-ž]/;
                    var specialCharRegex = /[^a-zA-Z0-9\sÀ-ỹ]/;
                    if (specialCharRegex.test(username)) {
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

                function validatePassword() {
                    var passwordInput = document.getElementsByName("password")[0];
                    var errorDiv = document.getElementById("error");
                    var saveButton = document.getElementById("saveButton");
                    var password = passwordInput.value;

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
                    // var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                    // if (!hasSpecialChar) {
                    //     errorDiv.innerHTML = "Mật khẩu phải chứa ít nhất 1 ký tự đặc biệt";
                    //     saveButton.disabled = true;
                    //     return false;
                    // }
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
                var passwordInput = document.getElementsByName("password")[0];
                passwordInput.addEventListener("input", function() {
                        validatePassword();
                        checkPasswords();
                    });
                function checkPasswords() {
                    var password = document.querySelector('input[name="password"]').value;
                    var repassword = document.querySelector('input[name="repassword"]').value;
                    var errorElement = document.getElementById('passwordError');
                    var saveButton = document.getElementById("saveButton");

                    if (password !== repassword) {
                        errorElement.style.display = 'block';
                        saveButton.disabled = true;
                    } else {
                        errorElement.style.display = 'none';
                        // Nếu các điều kiện khác đều đúng thì cho phép nhấn nút lưu
                        if (password.length >= 6 && /[A-Z]/.test(password) && /\d/.test(password)) {
                            saveButton.disabled = false;
                        }
                    }
                }              
                    var repasswordInput = document.getElementsByName("repassword")[0];
                    repasswordInput.addEventListener("input", checkPasswords);
</script>

<?php  include 'inc/footer.php'?>

