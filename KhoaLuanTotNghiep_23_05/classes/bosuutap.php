<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class category
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function DanhSachBoSuuTap(){
			$query = "SELECT * FROM bosuutap where isdel=0 order by IDBoSuuTap desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getChiTietBoSuuTapById($id){
			$query = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_category($TenBoSuuTap){

			$TenBoSuuTap = $this->fm->validation($TenBoSuuTap);
			$TenBoSuuTap = mysqli_real_escape_string($this->db->link, $TenBoSuuTap);
			
			if(empty($TenBoSuuTap)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}
			else{
				$check_email = "SELECT * FROM bosuutap WHERE TenBoSuuTap='$TenBoSuuTap' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Bộ sưu tập đã tồn tại</span>";
					return $alert;
				}else{
				$query = "INSERT INTO bosuutap(TenBoSuuTap,isDel) VALUES('$TenBoSuuTap',0)";
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
		public function show_category(){
			$query = "SELECT * FROM bosuutap WHERE isDel != 1 order by IDBoSuuTap  desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_category($TenBoSuuTap,$id){

			$TenBoSuuTap = $this->fm->validation($TenBoSuuTap);
			$TenBoSuuTap = mysqli_real_escape_string($this->db->link, $TenBoSuuTap);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($TenBoSuuTap)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE bosuutap SET TenBoSuuTap = '$TenBoSuuTap' WHERE IDBoSuuTap = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Thay đổi chủ đề Bộ Sưu Tập thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thay đổi thất bại</span>";
					return $alert;
				}
			}

		}
		public function del_category($id){
			$query = "UPDATE bosuutap SET isDel = 1 where IDBoSuuTap = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa thất bại</span>";
				return $alert;
			}
			
		}
		public function getcatbyId($id){
			$query = "SELECT * FROM bosuutap where IDBoSuuTap = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_category_fontend(){
			$query = "SELECT * FROM bosuutap WHERE isDel != 1 order by IDBoSuuTap desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_product_by_cat($id){
			$query = "SELECT * FROM tbl_product WHERE catId='$id' order by catId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_cat($id){
			$query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId FROM tbl_product,tbl_category WHERE tbl_product.catId=tbl_category.catId AND tbl_product.catId ='$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		


	}
?>