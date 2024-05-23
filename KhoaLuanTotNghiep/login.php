
<?php  
    require 'init.php';
    require 'classes/Auth.php';
    include 'classes/adminlogin.php';
    $db = new Database();

    $pdo = $db->getConnect();
    $error='';
    $class = new adminlogin();
    if($_SERVER["REQUEST_METHOD"]  == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        // $login_check = $class->login_admin($email,$password);
        $error  = Auth::login($pdo,$email,$password);
    }
?>
<?php include 'inc/header.php';?>

<section class="vh-80" style="background-color: #FFFFFF;">
  <div class="container py-5 h-100" >
    <div class="row d-flex justify-content-center align-items-center h-100" >
      <div class="col col-xl-10" >
        <div class="card" style="border-radius: 1rem;" >
          <div class="row " style="background-color: #FFFFFF;">
            <div class="col-md-5 col-lg-3 d-none d-md-block">
              <!-- <img src="https://png.pngtree.com/png-clipart/20220823/original/pngtree-password-and-login-device-security-system-black-line-pencil-drawing-vector-png-image_8467107.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" /> -->
            </div>
            <div class="col-md-6 col-lg-6 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form method="POST" action="">
                  <div class="d-flex align-items-center mb-3 pb-1 justify-content-center">
                    <img style="width: 100px;height: 100px;" src="https://i.pinimg.com/736x/56/4a/e7/564ae7b35f416d09ebe1b1b7476fd280.jpg" alt="">
                  </div>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhặp</h5>
                  <div class=" mb-4">
                  <label for="email" class="form-label">Email</label>
                    <input type="email"  placeholder="Nhập Email" class="form-control form-control-lg" name ="email"/>
                  </div>
                  <div class=" mb-4">
                  <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password"  placeholder="Nhập mật khẩu" class="form-control form-control-lg" name ="password"/>
                  </div>
				  <div style="display: flex; align-items: center;">
					<div style="order: -1;">
						
						<input type="checkbox" id="remember" name="remember">
						<label for="remember">Ghi nhớ</label>
					</div>
					<div style="margin-left: auto;">
						<a class="small text-muted" href="#!">Quên mật khẩu?</a>
					</div>
				</div>
				 
                  <span><?= $error ?></span>
                  <div class="pt-1 mb-4 justify-content-center d-flex align-items-center">
                    <button class="btn btn-dark btn-lg btn-block w-50 " type="submit" name="submit">Đăng nhặp</button>
                  </div>
				  <p class="text-center">Hoặc đăng nhập bằng:</p>

					<div class="pt-1 mb-4 justify-content-center d-flex align-items-center">
					<button class="btn btn-danger btn-lg btn-block w-50" type="button">Google</button>
					</div>
                  <div class="row justify-content-center align-items-center">
                    
                    <br>
                    <p  style="color: black;">Chưa có tài khoản? <span> <a href="register.php" style="color: #393f81;">Đăng kí ngay</a></span>  </p>
                                            
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
<?php 
	include 'inc/footer.php';
	
 ?>
