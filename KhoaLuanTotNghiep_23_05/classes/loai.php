<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class loai
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($TenLoai){

			$TenLoai = $this->fm->validation($TenLoai);
			$TenLoai = mysqli_real_escape_string($this->db->link, $TenLoai);
			
			if(empty($TenLoai)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}
			else{
				$check_email = "SELECT * FROM loaisanpham WHERE TenLoai='$TenLoai' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Loại sản phẩm này đã tồn tại</span>";
					return $alert;
				}else{
				$query = "INSERT INTO loaisanpham(TenLoai) VALUES('$TenLoai')";
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
		public function DanhSachLoaiSanPham(){
			$query = "SELECT * FROM loaisanpham order by IDLoai desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getAllLoaiSanPhamByID($id)
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai
			 WHERE loaisanpham.IDLoai= '$id' AND sanpham.isDel=0  ORDER BY sanpham.IDSanPham DESC ";
			$result = $this->db->select($sql);
			return $result;
		}
		public function getAllLoaiSanPhamPhanTrang($id,$limit, $offset)
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai
			WHERE loaisanpham.IDLoai= '$id' AND sanpham.isDel=0  ORDER BY sanpham.IDSanPham DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public  function getLoaiSanPhamByPriceAsc($id,$limit, $offset) 
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai
			WHERE loaisanpham.IDLoai= '$id' AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi ASC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		
		public  function getLoaiSanPhamByPriceDesc($id,$limit, $offset) 
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai
			WHERE loaisanpham.IDLoai= '$id' AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public function countAllLoaiSanPham($id)
		{
			$sql = "SELECT COUNT(*) FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai
			WHERE loaisanpham.IDLoai= '$id' AND sanpham.isDel=0";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}
		public function show_brand(){
			$query = "SELECT * FROM loaisanpham WHERE isDel != 1 order by IDLoai desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM loaisanpham where IDLoai = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($TenLoai,$id){

			$TenLoai = $this->fm->validation($TenLoai);
			$TenLoai = mysqli_real_escape_string($this->db->link, $TenLoai);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($TenLoai)){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE loaisanpham SET TenLoai = '$TenLoai' WHERE IDLoai = '$id'";
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
			$query = "UPDATE loaisanpham SET isDel = 1 where IDLoai = '$id'";
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
			$query = "SELECT * FROM loaisanpham order by IDLoai desc";
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