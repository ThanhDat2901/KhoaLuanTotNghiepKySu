<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class size
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($TenSize){

			$TenSize = $this->fm->validation($TenSize);
			$TenSize = mysqli_real_escape_string($this->db->link, $TenSize);
			
			if(empty($TenSize)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}
			else{
				$check_email = "SELECT * FROM `size` WHERE TenSize='$TenSize' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Size này đã tồn tại</span>";
					return $alert;
				}else{
				$query = "INSERT INTO `size`(TenSize,isDel) VALUES('$TenSize','0')";
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
			$query = "SELECT * FROM `size` WHERE isDel != 1 order by IDSize desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM `size` where IDSize = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($TenSize,$id){

			$TenSize = $this->fm->validation($TenSize);
			$brandName = mysqli_real_escape_string($this->db->link, $TenSize);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($TenSize)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE `size` SET TenSize = '$TenSize',isDel = 0 WHERE IDSize = '$id'";
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
			$query = "UPDATE `size` SET isDel =1 where IDSize = '$id'";
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