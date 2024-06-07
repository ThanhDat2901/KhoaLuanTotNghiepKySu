<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class comment
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		
		public function show_comment(){
			$query = "	SELECT comment.*,thongtinnguoidung.TenNguoiDung, sanpham.TenSanPham
						FROM 
							comment 
						INNER JOIN 
							thongtinnguoidung ON comment.IDNguoiDung = thongtinnguoidung.IDNguoiDung 
						INNER JOIN 
							sanpham ON comment.IDSanPham = sanpham.IDSanPham 
						WHERE 
							comment.isDel != 1 
						ORDER BY 
							comment.IDComment DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM comment where IDComment = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function del_brand($id){
			$query = "UPDATE comment SET isDel = 1 where IDComment = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa thất bại</span>";
				return $alert;
			}
			
		}
		


	}
?>