<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class nguoidung
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($TenNguoiDung,$DiaChi,$SDT,$Email,$MatKhau,$XacNhanMatKhau,$IDQuyen){

			$TenNguoiDung = $this->fm->validation($TenNguoiDung);
			$TenNguoiDung = mysqli_real_escape_string($this->db->link, $TenNguoiDung);
			$DiaChi = mysqli_real_escape_string($this->db->link, $DiaChi);
			$SDT = mysqli_real_escape_string($this->db->link, $SDT);
			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);
			$XacNhanMatKhau = mysqli_real_escape_string($this->db->link, $XacNhanMatKhau);
			$IDQuyen = mysqli_real_escape_string($this->db->link, $IDQuyen);
			
			if($TenNguoiDung== "" || $DiaChi== "" || $SDT== "" ||$Email== "" ||$MatKhau== "" ||$XacNhanMatKhau ==""){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM thongtinnguoidung WHERE Email='$Email' AND SDT='$SDT' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email hoặc Số Điện Thoại này đã được đăng kí</span>";
					return $alert;
				}else{
				$query = "INSERT INTO thongtinnguoidung(TenNguoiDung,DiaChi,SDT,Email,MatKhau,XacNhanMatKhau,IDQuyen)
				 VALUES('$TenNguoiDung','$DiaChi','$SDT','$Email','$MatKhau','$XacNhanMatKhau','$IDQuyen')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Đăng kí thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Đăng kí thất bại</span>";
					return $alert;
				}
			}
		}
		}
		public function insert_brand1($TenNguoiDung,$DiaChi,$SDT,$Email,$MatKhau,$XacNhanMatKhau,$IDQuyen){

			$TenNguoiDung = $this->fm->validation($TenNguoiDung);
			$TenNguoiDung = mysqli_real_escape_string($this->db->link, $TenNguoiDung);
			$DiaChi = mysqli_real_escape_string($this->db->link, $DiaChi);
			$SDT = mysqli_real_escape_string($this->db->link, $SDT);
			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);
			$XacNhanMatKhau = mysqli_real_escape_string($this->db->link, $XacNhanMatKhau);
			
			
			if($TenNguoiDung== "" || $DiaChi== "" || $SDT== "" ||$Email== "" ){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM thongtinnguoidung WHERE Email='$Email' AND SDT='$SDT' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email hoặc Số điện thoại này đã được sử dụng! Vui lòng kiểm tra lại</span>";
					return $alert;
				}else{
				$query = "INSERT INTO thongtinnguoidung(TenNguoiDung,DiaChi,SDT,Email,MatKhau,XacNhanMatKhau)
				 VALUES('$TenNguoiDung','$DiaChi','$SDT','$Email','$1111','$1111')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Đăng kí thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Đăng kí thất bại</span>";
					return $alert;
				}
			}
		}
		}
		public function show_nguoidung(){
			$query = "SELECT thongtinnguoidung.*,quyen.IDQuyen as QIDQuyen, quyen.TenQuyen
			FROM thongtinnguoidung,quyen,phanquyen
            WHERE thongtinnguoidung.IDNguoiDung = phanquyen.IDNguoiDung 
            AND quyen.IDQuyen = phanquyen.IDQuyen
            order by thongtinnguoidung.IDNguoiDung desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_nguoidung_by_name(){
			$query = "SELECT * FROM thongtinnguoidung order by IDNguoiDung desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT thongtinnguoidung.*,quyen.IDQuyen as QIDQuyen, quyen.TenQuyen
			FROM thongtinnguoidung,quyen,phanquyen
            WHERE thongtinnguoidung.IDNguoiDung = phanquyen.IDNguoiDung 
            AND quyen.IDQuyen = phanquyen.IDQuyen and  thongtinnguoidung.IDNguoiDung = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_brand($TenNguoiDung,$DiaChi,$SDT,$Email,$MatKhau,$XacNhanMatKhau,$id){

			$TenNguoiDung = $this->fm->validation($TenNguoiDung);
			$TenNguoiDung = mysqli_real_escape_string($this->db->link, $TenNguoiDung);
			$DiaChi = mysqli_real_escape_string($this->db->link, $DiaChi);
			$SDT = mysqli_real_escape_string($this->db->link, $SDT);
			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);
			$XacNhanMatKhau = mysqli_real_escape_string($this->db->link, $XacNhanMatKhau);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if($TenNguoiDung== "" || $DiaChi== "" || $SDT== "" ||$Email== "" ){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE thongtinnguoidung SET TenNguoiDung = '$TenNguoiDung',DiaChi = '$DiaChi',SDT = '$SDT',Email = '$Email',MatKhau = '$1111',XacNhanMatKhau = '$1111' WHERE IDNguoiDung = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Thay Đổi Thành Công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thay Đổi Thất Bại</span>";
					return $alert;
				}
			}

		}
		public function update_brand1($TenNguoiDung,$DiaChi,$SDT,$Email,$MatKhau,$XacNhanMatKhau,$id){

			$TenNguoiDung = $this->fm->validation($TenNguoiDung);
			$TenNguoiDung = mysqli_real_escape_string($this->db->link, $TenNguoiDung);
			$DiaChi = mysqli_real_escape_string($this->db->link, $DiaChi);
			$SDT = mysqli_real_escape_string($this->db->link, $SDT);
			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);
			$XacNhanMatKhau = mysqli_real_escape_string($this->db->link, $XacNhanMatKhau);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if($TenNguoiDung== "" || $DiaChi== "" || $SDT== "" ||$Email== "" ){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE thongtinnguoidung SET TenNguoiDung = '$TenNguoiDung',DiaChi = '$DiaChi',SDT = '$SDT',Email = '$Email',MatKhau = '$MatKhau',XacNhanMatKhau = '$XacNhanMatKhau' WHERE IDNguoiDung = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Thay Đổi Thành Công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thay Đổi Thất Bại</span>";
					return $alert;
				}
			}

		}

		public function del_brand($id){
			$query = "DELETE FROM thongtinnguoidung where IDNguoiDung = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa Thành Công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Không Thể Xóa</span>";
				return $alert;
			}
			
		}
		
		public function show_brand_fontend(){
			$query = "SELECT * FROM bosanpham order by IDBo desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_product_by_brand($id){
			$query = "SELECT * FROM tbl_product WHERE brandId='$id' order by brandId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_brand($id){
			$query = "SELECT tbl_product.*,tbl_brand.brandName,tbl_brand.brandId FROM tbl_product,tbl_brand WHERE tbl_product.brandId=tbl_brand.brandId AND tbl_product.brandId ='$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function resetPassword($TenNguoiDung,$DiaChi,$SDT,$Email,$MatKhau,$XacNhanMatKhau,$IDQuyen,$id){
			$TenNguoiDung = $this->fm->validation($TenNguoiDung);
			$TenNguoiDung = mysqli_real_escape_string($this->db->link, $TenNguoiDung);
			$DiaChi = mysqli_real_escape_string($this->db->link, $DiaChi);
			$SDT = mysqli_real_escape_string($this->db->link, $SDT);
			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);
			$XacNhanMatKhau = mysqli_real_escape_string($this->db->link, $XacNhanMatKhau);
			$IDQuyen = mysqli_real_escape_string($this->db->link, $IDQuyen);
			$id = mysqli_real_escape_string($this->db->link, $id);
				$query = "UPDATE thongtinnguoidung SET TenNguoiDung = '$TenNguoiDung',DiaChi = '$DiaChi',SDT = '$SDT',Email = '$Email',MatKhau = '$1111',XacNhanMatKhau = '$1111',IDQuyen = '$IDQuyen' WHERE IDNguoiDung = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Thay Đổi Thành Công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thay Đổi Thất Bại</span>";
					return $alert;
				}
			}

		
	}
?>