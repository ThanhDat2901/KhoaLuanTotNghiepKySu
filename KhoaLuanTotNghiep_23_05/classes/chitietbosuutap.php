<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class chitietbosuutap
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function getAllSanPhamBoSuuTapByID($id)
		{
			$sql = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'  AND sanpham.isDel=0 ORDER BY sanpham.IDSanPham DESC";
			$result = $this->db->select($sql);
			return $result;
		}
		public function getAllSanPhamBoSuuTapPhanTrang($id,$limit, $offset)
		{
			$sql = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'  AND sanpham.isDel=0  ORDER BY sanpham.IDSanPham DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public  function getBoSuuTapByPriceAsc($id,$limit, $offset) 
		{
			$sql = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'  AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi ASC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		
		public  function getBoSuuTapByPriceDesc($id,$limit, $offset) 
		{
			$sql = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'  AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public function countAllBoSuuTap($id)
		{
			$sql = "SELECT COUNT(*) FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'  AND sanpham.isDel=0";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); // Sử dụng fetch_row() để lấy dòng kết quả
			$count = $row[0]; // Lấy giá trị của cột đầu tiên trong dòng kết quả
			return $count;
		}
		public function getChiTietBoSuuTapById($id){
			$query = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'  AND sanpham.isDel=0 ORDER BY sanpham.IDSanPham DESC LIMIT 4";
			$result = $this->db->select($query);
			$data = [];
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
			}
			return $data;
		}
		public function insert_brand($IDBoSuuTap,$IDSanPham){

			$IDBoSuuTap = $this->fm->validation($IDBoSuuTap);
			$IDBoSuuTap = mysqli_real_escape_string($this->db->link, $IDBoSuuTap);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			
			if(empty($IDBoSuuTap)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
	
				else{
				$query = "INSERT INTO chitietbosuutap(IDBoSuuTap,IDSanPham) VALUES('$IDBoSuuTap','$IDSanPham')";
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
		public function show_bosuutap_by_name(){
			$query = "SELECT * FROM bosuutap order by IDBoSuuTap desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_sanpham_by_name(){
			$query = "SELECT * FROM sanpham where sanpham.isDel=0  order by IDSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_chitiet(){
			$query = "SELECT chitietbosuutap.IDChiTiet, bosuutap.TenBoSuuTap, sanpham.TenSanPham
			FROM chitietbosuutap
			JOIN bosuutap ON chitietbosuutap.IDBoSuuTap = bosuutap.IDBoSuuTap
			JOIN sanpham ON chitietbosuutap.IDSanPham = sanpham.IDSanPham
			order by chitietbosuutap.IDChiTiet desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT IDChiTiet, TenBoSuuTap, sanpham.TenSanPham,chitietbosuutap.IDBoSuuTap as CTIDBoSuuTap, chitietbosuutap.IDSanPham as CTIDSanPham
			FROM chitietbosuutap
			JOIN bosuutap ON chitietbosuutap.IDBoSuuTap = bosuutap.IDBoSuuTap
			JOIN sanpham ON chitietbosuutap.IDSanPham = sanpham.IDSanPham
			WHERE chitietbosuutap.IDChiTiet = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($IDBoSuuTap,$IDSanPham,$id){
			$IDBoSuuTap = $this->fm->validation($IDBoSuuTap);
			$IDBoSuuTap = mysqli_real_escape_string($this->db->link, $IDBoSuuTap);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($IDSanPham)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE chitietbosuutap SET IDBoSuuTap = '$IDBoSuuTap' , IDSanPham = '$IDSanPham'  WHERE IDChiTiet = '$id'";
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
		public function check_existing_product($IDBoSuuTap, $IDSanPham) {
			$IDBoSuuTap = $this->db->link->real_escape_string($IDBoSuuTap);
			$IDSanPham = $this->db->link->real_escape_string($IDSanPham);
	
			$query = "SELECT * FROM chitietbosuutap WHERE IDBoSuuTap = '$IDBoSuuTap' AND IDSanPham = '$IDSanPham'";
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