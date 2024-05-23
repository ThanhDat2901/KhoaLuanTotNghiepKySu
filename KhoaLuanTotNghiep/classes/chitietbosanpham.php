<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class chitietbosanpham
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($IDBo,$IDSanPham){

			$IDBo = $this->fm->validation($IDBo);
			$IDBo = mysqli_real_escape_string($this->db->link, $IDBo);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			
			if(empty($IDBo)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
	
				else{
				$query = "INSERT INTO chitietbo(IDBo,IDSanPham) VALUES('$IDBo','$IDSanPham')";
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
		public function show_bosanpham_by_name(){
			$query = "SELECT * FROM bosanpham order by IDBo desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_sanpham_by_name(){
			$query = "SELECT * FROM sanpham order by IDSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_chitiet(){
			$query = "SELECT chitietbo.IDChiTiet, bosanpham.TenBo, sanpham.TenSanPham
			FROM chitietbo
			JOIN bosanpham ON chitietbo.IDBo = bosanpham.IDBo
			JOIN sanpham ON chitietbo.IDSanPham = sanpham.IDSanPham
			order by chitietbo.IDChiTiet desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT IDChiTiet, TenBo, sanpham.TenSanPham,chitietbo.IDBo as CTIDBo, chitietbo.IDSanPham as CTIDSanPham
			FROM chitietbo
			JOIN bosanpham ON chitietbo.IDBo = bosanpham.IDBo
			JOIN sanpham ON chitietbo.IDSanPham = sanpham.IDSanPham
			WHERE chitietbo.IDChiTiet = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($IDBo,$IDSanPham,$id){
			$IDBo = $this->fm->validation($IDBo);
			$IDBo = mysqli_real_escape_string($this->db->link, $IDBo);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($IDSanPham)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE chitietbo SET IDBo = '$IDBo' , IDSanPham = '$IDSanPham'  WHERE IDChiTiet = '$id'";
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
			$query = "DELETE FROM chitietbo where IDChiTiet = '$id'";
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
		public function check_existing_product($IDBo, $IDSanPham) {
			$IDBo = $this->db->link->real_escape_string($IDBo);
			$IDSanPham = $this->db->link->real_escape_string($IDSanPham);
	
			$query = "SELECT * FROM chitietbo WHERE IDBo = '$IDBo' AND IDSanPham = '$IDSanPham'";
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