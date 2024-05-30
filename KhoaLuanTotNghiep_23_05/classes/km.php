<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class km
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($TenKhuyenMai,$TienKhuyenMai,$NgayBatDau,$NgayKetThuc){

			$TenKhuyenMai = $this->fm->validation($TenKhuyenMai);
			$TenKhuyenMai = mysqli_real_escape_string($this->db->link, $TenKhuyenMai);
			$TienKhuyenMai = mysqli_real_escape_string($this->db->link, $TienKhuyenMai);
			$NgayBatDau = mysqli_real_escape_string($this->db->link, $NgayBatDau);
			$NgayKetThuc = mysqli_real_escape_string($this->db->link, $NgayKetThuc);
			
			if($TenKhuyenMai=="" || $TenKhuyenMai=="" || $TienKhuyenMai=="" || $NgayBatDau=="" || $NgayKetThuc==""){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}
			else{
				$check_email = "SELECT * FROM chuongtrinhkhuyenmai WHERE TenKhuyenMai='$TenKhuyenMai' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Đã tồn tại khuyến mãi này</span>";
					return $alert;
				}else{
				$query = "INSERT INTO chuongtrinhkhuyenmai(TenKhuyenMai,TienKhuyenMai,NgayBatDau,NgayKetThuc) VALUES('$TenKhuyenMai','$TienKhuyenMai','$NgayBatDau','$NgayKetThuc')";
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
		public function show_brand_DateOver(){
			$query = "SELECT * FROM chuongtrinhkhuyenmai WHERE NgayKetThuc > CURDATE() AND isDel != 1 ORDER BY IDKhuyenMai DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_brand(){
			$query = "SELECT * FROM chuongtrinhkhuyenmai  WHERE IDKhuyenMai != 25 AND isDel != 1 order by IDKhuyenMai desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM chuongtrinhkhuyenmai where IDKhuyenMai = '$id'";
			$result = $this->db->select($query);
			return $result;
		}


		public function update_brand($TenKhuyenMai,$TienKhuyenMai,$NgayBatDau,$NgayKetThuc,$id){
			$TenKhuyenMai = $this->fm->validation($TenKhuyenMai);
			$TenKhuyenMai = mysqli_real_escape_string($this->db->link, $TenKhuyenMai);
			$TienKhuyenMai = mysqli_real_escape_string($this->db->link, $TienKhuyenMai);
			$NgayBatDau = mysqli_real_escape_string($this->db->link, $NgayBatDau);
			$NgayKetThuc = mysqli_real_escape_string($this->db->link, $NgayKetThuc);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if($TenKhuyenMai=="" || $TienKhuyenMai=="" || $NgayBatDau=="" || $NgayKetThuc==""){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE chuongtrinhkhuyenmai SET TenKhuyenMai = '$TenKhuyenMai',TienKhuyenMai = '$TienKhuyenMai',NgayBatDau  = '$NgayBatDau ',NgayKetThuc = '$NgayKetThuc' WHERE IDKhuyenMai = '$id'";
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
			$query = "UPDATE `chuongtrinhkhuyenmai` SET `isDel`= 1 WHERE `IDKhuyenMai` = '$id'";
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

	}
?>