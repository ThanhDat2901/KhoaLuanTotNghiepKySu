<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class mausac
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($TenMau, $MaMau) {
			$TenMau = $this->fm->validation($TenMau);
			$TenMau = mysqli_real_escape_string($this->db->link, $TenMau);
			$MaMau = mysqli_real_escape_string($this->db->link, $MaMau);
		
			if (empty($TenMau)) {
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			} else {
				// Kiểm tra xem màu đã tồn tại trong cơ sở dữ liệu hay chưa
				$check_color_query = "SELECT * FROM mausac WHERE MaMau='$MaMau' LIMIT 1";
				$result_check_color = $this->db->select($check_color_query);
				if ($result_check_color) {
					$alert = "<span class='error'>Mã màu đã tồn tại</span>";
					return $alert;
				} else {
					$query = "INSERT INTO mausac(TenMau, MaMau) VALUES('$TenMau', '$MaMau')";
					$result = $this->db->insert($query);
					if ($result) {
						$alert = "<span class='success'>Thêm thành công</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Thêm thất bại</span>";
						return $alert;
					}
				}
			}
		}
		public function show_brand(){
			$query = "SELECT * FROM mausac WHERE isDel != 1 order by IDMau desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM mausac where IDMau = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($TenMau, $MaMau, $id) {
			$TenMau = $this->fm->validation($TenMau);
			$TenMau = mysqli_real_escape_string($this->db->link, $TenMau);
			$MaMau = mysqli_real_escape_string($this->db->link, $MaMau);
			$id = mysqli_real_escape_string($this->db->link, $id);
		
			if (empty($TenMau)) {
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			} else {
				// Kiểm tra xem màu đã tồn tại trong cơ sở dữ liệu hay chưa
				$check_color_query = "SELECT * FROM mausac WHERE MaMau='$MaMau' AND IDMau != '$id' LIMIT 1";
				$result_check_color = $this->db->select($check_color_query);
				if ($result_check_color) {
					$alert = "<span class='error'>Mã màu đã tồn tại</span>";
					return $alert;
				} else {
					$query = "UPDATE mausac SET TenMau = '$TenMau', MaMau='$MaMau' WHERE IDMau = '$id'";
					$result = $this->db->update($query);
					if ($result) {
						$alert = "<span class='success'>Thay đổi thành công</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Thay đổi thất bại</span>";
						return $alert;
					}
				}
			}
		}
		
		public function del_brand($id){
			$query = "UPDATE mausac SET isDel = 1  where IDMau = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
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