<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class phanquyen
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function PhanQuyenNguoiDung($IDQuyen,$IDNguoiDung){
			$IDQuyen = $this->fm->validation($IDQuyen);
			$IDQuyen = mysqli_real_escape_string($this->db->link, $IDQuyen);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			
			if(empty($IDQuyen)){
				$alert = "<span class='error'>Vui lòng chọn Tên Người Dùng và Tên quyền</span>";
				return $alert;
			}else
					{
					$query = "INSERT INTO phanquyen(IDQuyen,IDNguoiDung) VALUES('$IDQuyen','$IDNguoiDung')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Phân quyền thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Phân quyền thất bại</span>";
						return $alert;
					}
				}
		}
		public function insert_brand($IDQuyen,$IDNguoiDung){
			$IDQuyen = $this->fm->validation($IDQuyen);
			$IDQuyen = mysqli_real_escape_string($this->db->link, $IDQuyen);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			
			if(empty($IDQuyen)){
				$alert = "<span class='error'>Vui lòng chọn Tên Người Dùng và Tên quyền</span>";
				return $alert;
			}else
					{
					$query = "INSERT INTO phanquyen(IDQuyen,IDNguoiDung) VALUES('$IDQuyen','$IDNguoiDung')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Phân quyền thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Phân quyền thất bại</span>";
						return $alert;
					}
				}
		}
		public function show_brand(){
			$query = "SELECT * FROM bosanpham order by IDBo desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_quyen_nguoidung(){
			$query = "SELECT phanquyen.IDPhanQuyen, thongtinnguoidung.TenNguoiDung, quyen.TenQuyen
			FROM phanquyen
			JOIN thongtinnguoidung ON phanquyen.IDNguoiDung = thongtinnguoidung.IDNguoiDung
			JOIN quyen ON phanquyen.IDQuyen = quyen.IDQuyen 
			order by phanquyen.IDPhanQuyen desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM phanquyen where IDPhanQuyen = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($IDQuyen,$IDNguoiDung,$id){

			$IDQuyen = $this->fm->validation($IDQuyen);
			$IDQuyen = mysqli_real_escape_string($this->db->link, $IDQuyen);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($IDQuyen)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE phanquyen SET IDQuyen = '$IDQuyen' , IDNguoiDung = '$IDNguoiDung' WHERE IDPhanQuyen = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Phân quyền thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Phân quyền thất bại/span>";
					return $alert;
				}
			}

		}
		public function update_PhanQuyen($IDQuyen,$IDNguoiDung){

			$IDQuyen = $this->fm->validation($IDQuyen);
			$IDQuyen = mysqli_real_escape_string($this->db->link, $IDQuyen);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);

			if(empty($IDQuyen)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE phanquyen SET IDQuyen = '$IDQuyen'  WHERE IDNguoiDung = '$IDNguoiDung'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Brand Updated Successfully</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Brand Updated Not Success</span>";
					return $alert;
				}
			}

		}
		public function del_brand($id){
			$query = "DELETE FROM phanquyen where IDPhanQuyen = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa Thành Công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa Thất Bại</span>";
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

	}
?>