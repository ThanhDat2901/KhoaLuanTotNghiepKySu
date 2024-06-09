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

		public function ThemDanhGia($IDNguoiDung,$IDSanPham,$Rate,$NoiDung,$ThoiGian)
		{
			// $IDSanPham = $this->fm->validation($IDSanPham);
			
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$Rate = mysqli_real_escape_string($this->db->link, $Rate);
			$NoiDung = mysqli_real_escape_string($this->db->link, $NoiDung);
			$ThoiGian = mysqli_real_escape_string($this->db->link, $ThoiGian);
			$sql = "INSERT INTO comment(IDNguoiDung,IDSanPham,Rate,NoiDung,ThoiGian,isDel) VALUES ('$IDNguoiDung','$IDSanPham','$Rate','$NoiDung','$ThoiGian',0)";
			$insert_cart = $this->db->insert($sql);
			if($insert_cart){
							return true;
						}else{
							return false;
						}
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
		public function show_commentSanPham($IDSanPham){
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$query = "	SELECT comment.*,thongtinnguoidung.TenNguoiDung, sanpham.TenSanPham,mausac.TenMau
						FROM 
							comment 
						INNER JOIN 
							thongtinnguoidung ON comment.IDNguoiDung = thongtinnguoidung.IDNguoiDung 
						INNER JOIN 
							sanpham ON comment.IDSanPham = sanpham.IDSanPham 
						INNER JOIN 
							mausac ON sanpham.IDMau  = mausac.IDMau  
						WHERE 
							comment.isDel != 1  and comment.IDSanPham='$IDSanPham'
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
		public function KiemTraNguoiDungDanhGia($IDNguoiDung,$IDSanPham)
			{
				$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$sql = "SELECT * FROM comment WHERE IDSanPham = '$IDSanPham' And IDNguoiDung ='$IDNguoiDung'";
				$result = $this->db->select($sql);
				if ($result && mysqli_num_rows($result) > 0) {
					return 1;  
				} else {
					return -1; 
				}
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