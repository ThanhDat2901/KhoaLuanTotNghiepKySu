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

		public function ThemDanhGia($IDNguoiDung,$IDSanPham,$Rate,$NoiDung,$ThoiGian,$IDHoaDon)
		{
			// $IDSanPham = $this->fm->validation($IDSanPham);
			$IDHoaDon= mysqli_real_escape_string($this->db->link, $IDHoaDon);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$Rate = mysqli_real_escape_string($this->db->link, $Rate);
			$NoiDung = mysqli_real_escape_string($this->db->link, $NoiDung);
			$ThoiGian = mysqli_real_escape_string($this->db->link, $ThoiGian);
			$sql = "INSERT INTO comment(IDNguoiDung,IDSanPham,Rate,NoiDung,ThoiGian,isDel,IDHoaDon) VALUES ('$IDNguoiDung','$IDSanPham','$Rate','$NoiDung','$ThoiGian',0,'$IDHoaDon')";
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
		public function show_commentSanPhamByIdNguoiDung($IDNguoiDung){
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$query = "	SELECT comment.*,thongtinnguoidung.TenNguoiDung, sanpham.TenSanPham,mausac.TenMau,sanpham.*
						FROM 
							comment 
						INNER JOIN 
							thongtinnguoidung ON comment.IDNguoiDung = thongtinnguoidung.IDNguoiDung 
						INNER JOIN 
							sanpham ON comment.IDSanPham = sanpham.IDSanPham 
						INNER JOIN 
							mausac ON sanpham.IDMau  = mausac.IDMau  
						WHERE 
							comment.isDel != 1  and comment.IDNguoiDung='$IDNguoiDung'
						ORDER BY 
							comment.IDComment DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_commentSanPhamPhanTrang($IDSanPham,$limit, $offset){
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
							comment.IDComment DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($query);
			return $result;
		}

		public function countAllComment()
		{
			
			$sql = "SELECT COUNT(*) FROM comment WHERE comment.isDel=0";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}
		public function countAllCommentByID($IDSanPham )
		{
			$IDSanPham = mysqli_real_escape_string($this->db->link,$IDSanPham);
			$sql = "SELECT COUNT(*) FROM comment WHERE comment.isDel=0 and IDSanPham='$IDSanPham' ";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}
		public function countAllCommentNguoiDungByID($IDSanPham )
		{
			$IDSanPham = mysqli_real_escape_string($this->db->link,$IDSanPham);
			$sql = "SELECT COUNT(*) FROM comment WHERE comment.isDel=0 and IDSanPham='$IDSanPham' ";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}
		
		public function countAllCommentByIDAndRate($IDSanPham,$Rate)
		{
			$IDSanPham = mysqli_real_escape_string($this->db->link,$IDSanPham);
			$sql = "SELECT COUNT(*) FROM comment WHERE comment.isDel=0 and IDSanPham = '$IDSanPham'and Rate ='$Rate'";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}
		public function countAllCommentByRate($Rate)
		{
			$Rate = mysqli_real_escape_string($this->db->link, $Rate);
			$sql = "SELECT COUNT(*) FROM comment WHERE comment.isDel=0 and Rate='$Rate'";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
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
			public function KiemTraNguoiDungDanhGiaByHoaDon($IDNguoiDung,$IDSanPham,$IDHoaDon)
			{
				$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
				$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$sql = "SELECT * FROM comment,hoadon WHERE comment.IDNguoiDung =hoadon.IDNguoiDung 
				 and comment.IDHoaDon = hoadon.IDHoaDon 
				and  hoadon.IDHoaDon='$IDHoaDon' 
				and comment.IDSanPham = '$IDSanPham' 
				And comment.IDNguoiDung ='$IDNguoiDung' 
				 AND (trangthai = 6 OR trangthai = 14 OR trangthai = 15 OR trangthai = 16)   ";
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