<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class chitietmausac
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($IDMau,$IDSanPham){

			$IDMau = $this->fm->validation($IDMau);
			$IDMau = mysqli_real_escape_string($this->db->link, $IDMau);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			
			if(empty($IDMau)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
	
				else{
				$query = "INSERT INTO mausacsanpam(IDMau,IDSanPham) VALUES('$IDMau','$IDSanPham')";
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
			$query = "SELECT * FROM mausac order by IDMau desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_sanpham_by_name(){
			$query = "SELECT * FROM sanpham order by IDSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_chitiet(){
			$query = "SELECT mausacsanpam.IDMauSanPham, mausac.TenMau, sanpham.TenSanPham,mausac.MaMau
			FROM mausacsanpam
			JOIN mausac ON mausacsanpam.IDMau = mausac.IDMau
			JOIN sanpham ON mausacsanpam.IDSanPham = sanpham.IDSanPham
			WHERE sanpham.isDel != 1
			order by mausacsanpam.IDMauSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT IDMauSanPham, TenMau, sanpham.TenSanPham,mausacsanpam.IDMau as CTIDMau, mausacsanpam.IDSanPham as CTIDSanPham
			FROM mausacsanpam
			JOIN mausac ON mausacsanpam.IDMau = mausac.IDMau
			JOIN sanpham ON mausacsanpam.IDSanPham = sanpham.IDSanPham
			WHERE mausacsanpam.IDMauSanPham = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($IDMau,$IDSanPham,$id){
			$IDMau = $this->fm->validation($IDMau);
			$IDMau = mysqli_real_escape_string($this->db->link, $IDMau);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($IDSanPham)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE mausacsanpam SET IDMau = '$IDMau' , IDSanPham = '$IDSanPham'  WHERE IDMauSanPham = '$id'";
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
			$query = "DELETE FROM mausacsanpam where IDMauSanPham = '$id'";
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
		public function check_existing_product($IDMau, $IDSanPham) {
			$IDMau = $this->db->link->real_escape_string($IDMau);
			$IDSanPham = $this->db->link->real_escape_string($IDSanPham);
	
			$query = "SELECT * FROM mausacsanpam WHERE IDMau = '$IDMau' AND IDSanPham = '$IDSanPham'";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>