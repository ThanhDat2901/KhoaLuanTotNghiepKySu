<?php if(isset($_SESSION['login_admin'])): ?>	
<?php
	include '../classes/adminlogin.php';
?>
<?php
	$class = new adminlogin();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     	$TenNguoiDung = $_POST['TenNguoiDung'];
     	$MatKhau = $_POST['MatKhau'];
     	$login_check = $class->login_admin($TenNguoiDung,$MatKhau);
     	
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span><?php

			if(isset($login_check)){
				echo $login_check;
			}
			 ?></span>
			
			<div>
				<input type="text" placeholder="Email" required="" name="TenNguoiDung"/>
			</div>
			<div>
				<input type="password" placeholder="Mật Khẩu" required="" name="MatKhau"/>
			</div>
			<div style="margin-left: 30%">
				<input type="submit" value="Đăng Nhập" />
			</div>
		</form><!-- form -->	
	</section><!-- content -->

</div><!-- container -->
</body>
</html>

<?php else:?>
<?php   header('location: ../login.php'); ?>
<?php endif ?>    