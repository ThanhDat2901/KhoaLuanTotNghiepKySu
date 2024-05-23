<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class chitietsanpham
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($IDSize,$IDSanPham,$SoLuong){

			$IDSize = $this->fm->validation($IDSize);
			$IDSize = mysqli_real_escape_string($this->db->link, $IDSize);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
			
			if(empty($IDSize)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
	
				else{
				$query = "INSERT INTO chitietsanpham(IDSize,IDSanPham,SoLuong) VALUES('$IDSize','$IDSanPham','$SoLuong')";
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
		public function show_size_by_name(){
			$query = "SELECT * FROM Size order by IDSize desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_sanpham_by_name(){
			$query = "SELECT * FROM sanpham order by IDSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_chitiet(){
			$query = "SELECT chitietsanpham.IDChiTiet,chitietsanpham.SoLuong, size.TenSize, sanpham.TenSanPham
			FROM chitietsanpham
			JOIN Size ON chitietsanpham.IDSize = size.IDSize
			JOIN sanpham ON chitietsanpham.IDSanPham = sanpham.IDSanPham
			order by chitietsanpham.IDChiTiet desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT chitietsanpham.IDSize as CTIDSize,chitietsanpham.IDSanPham as CTIDSanPham,chitietsanpham.IDChiTiet,chitietsanpham.SoLuong, size.TenSize, sanpham.TenSanPham
			FROM chitietsanpham
			JOIN Size ON chitietsanpham.IDSize = size.IDSize
			JOIN sanpham ON chitietsanpham.IDSanPham = sanpham.IDSanPham 
            WHERE chitietsanpham.IDChiTiet='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($IDSize,$IDSanPham,$SoLuong,$id){
			$IDSize = $this->fm->validation($IDSize);
			$IDSize = mysqli_real_escape_string($this->db->link, $IDSize);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($IDSanPham)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE chitietsanpham SET IDSize = '$IDSize' , IDSanPham = '$IDSanPham' , SoLuong = '$SoLuong'  WHERE IDChiTiet = '$id'";
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
			$query = "DELETE FROM chitietbosuutap where IDChiTiet = '$id'";
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