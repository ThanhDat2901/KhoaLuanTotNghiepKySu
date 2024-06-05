<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class brand
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($TenBo){

			$TenBo = $this->fm->validation($TenBo);
			$TenBo = mysqli_real_escape_string($this->db->link, $TenBo);
			
			if(empty($TenBo)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
			else{
				$check_email = "SELECT * FROM bosanpham WHERE TenBo='$TenBo' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Bộ sản phẩm đã tồn tại</span>";
					return $alert;
				}
				else{
				$query = "INSERT INTO bosanpham(TenBo,isDel) VALUES('$TenBo','0')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm thất bại</span>";
					return $alert;
				}
			}
		}
		}
		public function show_brand(){
			$query = "SELECT * FROM bosanpham WHERE isDel != 1 order by IDBo desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM bosanpham where IDBo = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($TenBo,$id){

			$TenBo = $this->fm->validation($TenBo);
			$brandName = mysqli_real_escape_string($this->db->link, $TenBo);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($TenBo)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE bosanpham SET TenBo = '$TenBo' WHERE IDBo = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Thay đổi thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thay đổi thất bại</span>";
					return $alert;
				}
			}

		}
		public function del_brand($id){
			$query = "UPDATE bosanpham SET isDel = 1 where IDBo = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xó bộ sản phẩm thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa thất bại</span>";
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

		public function doiMatKhau($IDNguoiDung, $MatKhau, $MatKhauMoi) {
			// Validate input
			$IDNguoiDung = $this->fm->validation($IDNguoiDung);
			$MatKhau = $this->fm->validation($MatKhau);
			$MatKhauMoi = $this->fm->validation($MatKhauMoi);
		
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$MatKhau = mysqli_real_escape_string($this->db->link, $MatKhau);
			$MatKhauMoi = mysqli_real_escape_string($this->db->link, $MatKhauMoi);
		
			// Check if fields are empty
			if (empty($IDNguoiDung) || empty($MatKhau) || empty($MatKhauMoi)) {
				$alert = "Không thể để trống";
				return $alert;
			} else {
				// Check if the current password matches
				$query = "SELECT * FROM thongtinnguoidung WHERE IDNguoiDung = '$IDNguoiDung' AND MatKhau = '$MatKhau'";
				$result = $this->db->select($query);
		
				if ($result != false) {
					// Update password
					$query_update = "UPDATE thongtinnguoidung SET MatKhau = '$MatKhauMoi' WHERE IDNguoiDung = '$IDNguoiDung'";
					$updated = $this->db->update($query_update);
					if ($updated) {
						$alert = "Thay đổi mật khẩu thành công";
						return $alert;
					} else {
						$alert = "Cập nhật mật khẩu thất bại";
						return $alert;
					}
				} else {
					$alert = "Mật khẩu hiện tại không chính xác";
					return $alert;
				}
			}
		}

	}
?>