<?php
require 'init.php'; 

require 'classes/nguoidung.php';
$nguoidung = new nguoidung();
$thongtinnguoidung = $nguoidung->ShowThongTinNguoiDungById($_SESSION['user_id']);
$detailnguoidung = $thongtinnguoidung->fetch_assoc();
$errorscity='';
$errorsdistrict='';
$errorsward='';
$errorshousenumber='';
$cleaned_guest_id='';

$error = '';
$errorsEmail='';
$errorsUsername='';
$errorsPhone='';
$errorsaddress='';
$errorspassword='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['capnhapthongtin'])){

    $IDNguoiDung  = $_SESSION['user_id'];
    $username = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $Phone = $_POST['Phone'];
    $NgayLap = date('Y-m-d H:i:s'); 
    $city = $_POST['city2'];
    $district = $_POST['district2'];
    $ward = $_POST['ward2'];
    $housenumber = $_POST['housenumber2'];
    $password = $_POST['password'];

    $cityName =$nguoidung->getNameAdressById('cities',$city); 
    $districtName = $nguoidung->getNameAdressById('districts',$district); 
    $wardName = $nguoidung->getNameAdressById('wards',$ward); 
    $fullAddress = $housenumber . ', ' . $wardName . ', ' . $districtName . ', ' . $cityName;
    $role = 0;
    $capnhap = $nguoidung->CapNhapThongTinCaNhan($IDNguoiDung,$username,$fullAddress,$Phone,$userEmail,$password);
    $_SESSION['name']=$username;
    // if ($capnhap) {
    //     header("Location: cart.php");
    //     exit();
    // } else {
    //     echo "Có lỗi xảy ra khi cập nhật sản phẩm";
    // }
}
}
?>

<?php include 'inc/header.php';?>  
<script>
    document.addEventListener("DOMContentLoaded", function() {
   
    const citySelect2 = document.getElementById("city2");
    const districtSelect2 = document.getElementById("district2");
    const wardSelect2 = document.getElementById("ward2");
    const houseNumberInput2 = document.getElementById("housenumber2");
    const lala = document.getElementById("idnguoidungdetail").value; 
    loadCurrentAddress();
    // function loadCurrentAddress() {

    //     fetch(`yameshop/getNguoiDungById.php?IDNguoiDung=${lala}`)
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log("không chạy nè");
    //         if (data ) {
    //             console.log("chạy nè ");
    //             console.log(data);
    //             console.log(data['DiaChi']);
    //             const fullAddress = data['DiaChi'];
    //             const parts = fullAddress.split(',');
    //             const housenumber = parts[0].trim();
    //             const ward = parts[1].trim();
    //             const district = parts[2].trim();
    //             const city = parts[3].trim();
    //             console.log(city);
    //             console.log(district);
    //             console.log(ward);
    //             fetch(`yameshop/getCityByName.php?name=${city}`)
    //             .then(response2 => response2.json())
    //             .then(data2 => {
    //                 document.getElementById('city2').value = data2['id'];
    //                 citySelect2.dispatchEvent(new Event('change')); 
    //                 // districtSelect2.dispatchEvent(new Event('change'));
    //                 console.log(data2['id']);
    //                 fetch(`yameshop/getDistrictByName.php?city_id=${data2['id']}&name=${district}`)
    //                     .then(response3 => response3.json())
    //                     .then(data3 => {
    //                         document.getElementById('district2').value = data3['id'];                   
    //                         districtSelect2.dispatchEvent(new Event('change'));
    //                         console.log(data3['id']);  
    //                         fetch(`yameshop/getWardByName.php?district_id=${data3['id']}&name=${ward}`)
    //                             .then(response4 => response4.json())
    //                             .then(data4 => {
    //                                 document.getElementById('ward2').value = data4['id'];     
    //                                 console.log(document.getElementById('ward2').value);  
    //                                 console.log(data4['id']);     
    //                                 console.log(data4);          
    //                                 // districtSelect2.dispatchEvent(new Event('change'));
    //                                 wardSelect2.dispatchEvent(new Event('change'));
    //                             });
    //                     });
    //             });
    //             document.getElementById('housenumber2').value = housenumber;
    //         } else {
    //             console.error('Dữ liệu không hợp lệ.');
    //             console.log(data);
    //             console.log(data.Diachi);
    //         }
    //     })
    //     .catch(error => console.error('Lỗi khi tải địa chỉ hiện tại:', error));
    // }
    function loadCurrentAddress() {
        setTimeout(() => {
        fetch(`yameshop/getNguoiDungById.php?IDNguoiDung=${lala}`)
        .then(response => response.json())
        .then(data => {
            if (data ) {
                const fullAddress = data['DiaChi'];
                const parts = fullAddress.split(',');
                const housenumber = parts[0].trim();
                const ward = parts[1].trim();
                const district = parts[2].trim();
                const city = parts[3].trim();
            
                fetchCityDistrictWard(city, district, ward, housenumber);
            } else {
                console.error('Dữ liệu không hợp lệ.');
            }
            })
            .catch(error => console.error('Lỗi khi tải địa chỉ hiện tại:', error));
        }, 500);
    }
    function fetchCityDistrictWard(city, district, ward, housenumber) {
        setTimeout(() => {
        fetch(`yameshop/getCityByName.php?name=${city}`)
            .then(response => response.json())
            .then(cityData => {
                document.getElementById('city2').value = cityData['id'];
                citySelect2.dispatchEvent(new Event('change'));

                fetchDistrict(cityData['id'], district, ward, housenumber);
            });
        }, 500);
    }
    function fetchDistrict(cityId, district, ward, housenumber) {
        setTimeout(() => {
        fetch(`yameshop/getDistrictByName.php?city_id=${cityId}&name=${district}`)
            .then(response => response.json())
            .then(districtData => {
                document.getElementById('district2').value = districtData['id'];
                districtSelect2.dispatchEvent(new Event('change'));

                fetchWard(districtData['id'], ward, housenumber);
            });
        }, 500);
    }
    function fetchWard(districtId, ward, housenumber) {
        setTimeout(() => {
        fetch(`yameshop/getWardByName.php?district_id=${districtId}&name=${ward}`)
            .then(response => response.json())
            .then(wardData => {
                document.getElementById('ward2').value = wardData['id'];
                wardSelect2.dispatchEvent(new Event('change'));

                document.getElementById('housenumber2').value = housenumber;
            });
        }, 500);
    }




        fetch("yameshop/getCity.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(city => {
                let option = document.createElement("option");
                option.value = city.id;
                option.text = city.name;
                citySelect2.add(option);
            });
        });

   
        citySelect2.addEventListener("change", function() {
            const selectedCityId = this.value;
            const shippingFee = calculateShippingFee(selectedCityId);

            // Update shipping fee display
            shippingFeeDisplay.innerHTML = numberWithCommas(shippingFee) + " đ";
            
            console.log(shippingFee);
            updateGrandTotal(shippingFee);
        });    
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    // Load districts when city is selected
    citySelect2.addEventListener("change", function() {
        districtSelect2.innerHTML = "<option value=''>Chọn quận/huyện</option>";
        wardSelect2.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect2.disabled = true;
        districtSelect2.disabled = false;

        fetch(`yameshop/getDistrict.php?city_id=${citySelect2.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(district => {
                    let option = document.createElement("option");
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect2.add(option);
                });
            });
    });

    // Load wards when district is selected
    districtSelect2.addEventListener("change", function() {
        wardSelect2.innerHTML = "<option value=''>Chọn xã/phường</option>";
        wardSelect2.disabled = false;

        fetch(`yameshop/getWard.php?district_id=${districtSelect2.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(ward => {
                    let option = document.createElement("option");
                    option.value = ward.id;
                    option.text = ward.name;
                    wardSelect2.add(option);
                });
            });
    });
    wardSelect2.addEventListener("change", function() {
            houseNumberInput2.disabled = false;
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
    });
    function changeQuantity(productId, action) {
        // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
        $.ajax({
            url: 'update_cart.php',
            type: 'POST',
            data: {productId: productId, action: action},
            success: function(response) {
                // Nếu cập nhật thành công, tải lại trang
                console.log(response);
                location.reload();
            },
        });
    }
</script>
<div id="about" class="shop" style="margin-top:10vh">
    <div class="" style="width:100%;align-items: center;justify-content: center;text-align: center; background-color: #FFFFFF ">
        <div class="container text-center mb-4">
            <div class="row">
                <div class="col-sm-12 " style="background-color: #e9ecef;">
                    <div class="breadcrumb" style="margin-top: 10px;">
                        <a href="index.php" style="color: black;"><i class="icon fa fa-home"></i></a>
                        <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Thông tin cá nhân</strong>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="vh-80" style="background-color: #FFFFFF;">
    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="">
                                <!-- <?php
                                    if(isset($capnhap)){
                                        echo $capnhap;
                                    }
                                    ?> -->

                                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-4">THÔNG TIN CÁ NHÂN</p>
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
                                <form name="capnhapthongtin" action=""method="POST">
                                    <div class="row"> 
                                        <div class="col-lg-6">   
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0">
                                            
                                                    <label class="form-label" for="form3Example1c">Tên người dùng</label>
                                                    <input id="idnguoidungdetail" type="hidden" value='<?=$detailnguoidung['IDNguoiDung'] ?>'>
                                                    <input type="text" placeholder="Nhập tên người dùng" name="userName" value='<?=$detailnguoidung['TenNguoiDung'] ?>'  id="usernameInput" class="form-control" required  onblur="checkUsername(this)" />
                                                    <div id="usernameError" style="display: none; color: red;">Tên người dùng không được chứa ký tự đặc biệt.</div>
                                                    <span class="text-danger" style="color:red"><?= $errorsUsername?></span>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0">
                                                    <label class="form-label" for="form3Example1c">Email</label>
                                                    <input type="email"  placeholder="Nhập email"  value='<?=$detailnguoidung['Email'] ?>' name="userEmail" id="emailInput" class="form-control"required  />
                                                
                                                    <div id="emailError" style="display: none; color: red;">Vui lòng nhập địa chỉ email hợp lệ.</div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0">
                                                    <label class="form-label" for="form3Example1c">Số điện thoại</label>
                                                    <input type="text"  placeholder="Nhập số điện thoại"  value='<?=$detailnguoidung['SDT'] ?>' name="Phone" class="form-control" required onblur="validatePhoneNumber(this)" />
                                                
                                                    <span class="text-danger" style="color:red"><?= $errorsPhone?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class=" flex-fill mb-0 position-relative">
                                                    <label class="form-label" for="form3Example1c">Mật khẩu</label>
                                                    <div class="input-group">
                                                        <input type="password" placeholder="Nhập mật khẩu" value='<?=$detailnguoidung['MatKhau'] ?>' name="password" id="password" class="form-control" required onblur="validatePassword()" oninput="validatePassword()" />
                                                      
                                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="right: 0; position: absolute; top: 50%; transform: translateY(-50%);">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                      <div id="error" style="color: red;"></div>
                                                    <span class="text-danger" style="color:red"><?= $errorspassword?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"> 
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="city2">Tỉnh/Thành phố</label>
                                                    <select id="city2" class="form-control" name="city2" required >
                                                        <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                                    </select>
                                                    <span class="text-danger" style="color:red"><?= $errorscity?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="district2">Quận/Huyện</label>
                                                    <select id="district2" class="form-control" name="district2" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsdistrict?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-location-dot fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="ward2">Xã/Phường</label>
                                                    <select id="ward2" class="form-control" name="ward2" required  disabled></select>
                                                    <span class="text-danger" style="color:red"><?= $errorsward?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fa-solid fa-house-user fa-lg me-3 fa-fw"></i>
                                                <div class="flex-fill mb-0">
                                                    <label class="form-label" for="housenumber2">Tên đường, tòa nhà, số nhà</label>
                                                    <input type="text" id="housenumber2" class="form-control" name="housenumber2" required disabled>
                                                    <span class="text-danger" style="color:red"><?= $errorshousenumber?></span>
                                                </div>
                                            </div>
                                        </div>

                                        


                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button class="btn btn-primary btn-lg" id="saveButton" type="submit" name="capnhapthongtin">Cập nhập thông tin</button>
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

                function checkUsername() {
                    var usernameInput = document.getElementById("usernameInput");
                    var usernameError = document.getElementById("usernameError");
                    var username = usernameInput.value;
                    var specialCharRegex = /[^a-zA-Z0-9\sÀ-ÖØ-öø-ÿĀ-ž]/;
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
<?php include 'inc/footer.php'; ?>


