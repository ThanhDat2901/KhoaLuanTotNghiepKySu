<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class adminlogin
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function login_admin($Email,$MatKhau){
			$Email = $this->fm->validation($Email);
			$MatKhau = $this->fm->validation($MatKhau);

			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);

			if(empty($Email) || empty($MatKhau)){
				$alert = "Email hoặc mật khẩu không thể để trống";
				return $alert;
			}else{
				$query = "SELECT * FROM thongtinnguoidung WHERE Email = '$Email' AND MatKhau = '$MatKhau'";
				$result = $this->db->select($query);

				if($result != false){

					$value = $result->fetch_assoc();

					Session::set('adminlogin', true);

					Session::set('IDNguoiDung', $value['IDNguoiDung']);
					Session::set('Email', $value['Email']);
					Session::set('TenDangNhap', $value['TenDangNhap']);
					header('Location:index.php');

				}else{
					$alert = "Email hoặc mật khẩu không chính xác";
					return $alert;
				}
			}

		}

	}
?>