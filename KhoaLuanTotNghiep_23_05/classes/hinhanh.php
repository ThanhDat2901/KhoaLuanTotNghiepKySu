<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class hinhanh
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function showListAnhByIdSanPham($id){
			$query = "SELECT sanpham.*, hinhanh.IDSanPham as haIDSanPham,IDHinhAnh ,LinkHinh
			FROM sanpham,hinhanh 
			where hinhanh.IDSanPham = sanpham.IDSanPham AND sanpham.isDel=0 AND hinhanh.IDSanPham = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_brand($IDSanPham,$LinkHinh){

			$LinkHinh = $this->fm->validation($LinkHinh);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
            $LinkHinh = mysqli_real_escape_string($this->db->link, $LinkHinh);
			
			if(empty($LinkHinh)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
				else{
				$query = "INSERT INTO hinhanh(IDSanPham,LinkHinh) VALUES('$IDSanPham','$LinkHinh')";
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
		public function show_brand(){
			$query = "SELECT hinhanh.*,sanpham.TenSanPham

			FROM hinhanh 

			INNER JOIN sanpham ON hinhanh.IDSanPham = sanpham.IDSanPham 

			order by hinhanh.IDSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}

        public function show_product(){
			$query = "SELECT * FROM sanpham where sanpham.isDel=0 order by IDSanPham desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT sanpham.*, hinhanh.IDSanPham as haIDSanPham,IDHinhAnh ,LinkHinh
			FROM sanpham,hinhanh 
			where hinhanh.IDSanPham = sanpham.IDSanPham AND hinhanh.IDHinhAnh = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		

		public function update_brand($IDSanPham,$LinkHinh,$id){

			$LinkHinh = $this->fm->validation($LinkHinh);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$brandName = mysqli_real_escape_string($this->db->link, $LinkHinh);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($LinkHinh)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE hinhanh SET IDSanPham = '$IDSanPham', LinkHinh = '$LinkHinh'  WHERE IDHinhAnh = '$id'";
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
			$query = "DELETE FROM hinhanh where IDHinhAnh = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xó bộ sản phẩm thành công</span>";
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