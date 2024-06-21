<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
	// include_once '../classes/km.php';
?>

<?php
	/**
	 * 
	 */
	class product
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}


		/* API */
		public function getAllSanPhamAPI()
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai  ORDER BY sanpham.IDSanPham DESC";
			$result = $this->db->select($sql);		
			$products = array();		
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					$products[] = $row;
				}
			}
			return $products;
		}
		/* TRANG SAN PHAM */
		public function getPage()
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE sanpham.isDel=0 ORDER BY sanpham.IDSanPham DESC LIMIT 4";
			$result = $this->db->select($sql);
			return $result;
		}
		public function getAllSanPham()
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE sanpham.isDel=0  ORDER BY sanpham.IDSanPham DESC";
			$result = $this->db->select($sql);
			return $result;
		}
		public function getAllSanPhamPhanTrang($limit, $offset)
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE sanpham.isDel=0  ORDER BY sanpham.IDSanPham DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public  function getByPriceAsc($limit, $offset) 
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE sanpham.isDel=0  ORDER BY sanpham.GiaCuoi ASC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}

		public  function getByPriceDesc($limit, $offset) 
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE sanpham.isDel=0  ORDER BY sanpham.GiaCuoi DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public function countAll()
		{
			$sql = "SELECT COUNT(*) FROM sanpham WHERE sanpham.isDel=0";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
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
		/* SEARCH*/
		public  function getAllSanPhamSearch($search, $limit, $offset){
 
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE TenSanPham LIKE '%$search%' OR sanpham.IDSanPham LIKE '%$search%' AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi ASC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public  function getSearchByPriceAsc($search,$limit, $offset) 
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE TenSanPham LIKE '%$search%' OR sanpham.IDSanPham LIKE '%$search%' AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi ASC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}

		public  function getSearchByPriceDesc($search,$limit, $offset) 
		{
			$sql = "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai WHERE TenSanPham LIKE '%$search%' OR sanpham.IDSanPham LIKE '%$search%' AND sanpham.isDel=0  ORDER BY sanpham.GiaCuoi DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public function countAllSearch($search)
		{
			$sql = "SELECT COUNT(*) FROM sanpham WHERE TenSanPham LIKE '%$search%' OR sanpham.IDSanPham LIKE '%$search%'  AND sanpham.isDel=0 ";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}


		public function getAvailableQuantity($IDChiTiet) {
			// Thực hiện truy vấn để lấy số lượng sản phẩm còn trong cửa hàng dựa trên IDChiTiet
			$sql = "SELECT SoLuong FROM chitietsanpham WHERE IDChiTiet = $IDChiTiet";
		
			// Thực hiện truy vấn bằng phương thức select
			$result = $this->db->select($sql);
		
			if ($result) {
				// Nếu có kết quả trả về, trả về giá trị số lượng
				$row = $result->fetch_assoc();
				return $row['SoLuong'];
			} else {
				// Nếu không có kết quả, trả về 0
				return 0;
			}
		}

		public function getChiTietBoSuuTapById($id){
			$query = "SELECT * FROM `chitietbosuutap`,bosuutap,sanpham 
			WHERE sanpham.IDSanPham = chitietbosuutap.IDSanPham 
				and bosuutap.IDBoSuuTap = chitietbosuutap.IDBoSuuTap 
				and bosuutap.IDBoSuuTap= '$id' AND sanpham.isDel=0   ORDER BY sanpham.IDSanPham DESC LIMIT 4";
			$result = $this->db->select($query);
			$data = [];
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
			}
			return $data;
		}
		public function getSizeById($id){
			$query = "SELECT sanpham.*,size.*,chitietsanpham.* FROM sanpham,size,chitietsanpham  where sanpham.IDSanPham = chitietsanpham.IDSanPham AND size.IDSize = chitietsanpham.IDSize AND sanpham.IDSanPham  =  '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproductbyId($id){
			$query = "SELECT sanpham.*,chuongtrinhkhuyenmai.*,mausac.* FROM sanpham,chuongtrinhkhuyenmai,mausac  where sanpham.IDKhuyenMai=chuongtrinhkhuyenmai.IDKhuyenMai AND sanpham.IDMau = mausac.IDMau AND IDSanPham =  '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproductbyIdChiTietSanPham($id){
			$query = "SELECT sanpham.*,size.*,chitietsanpham.*,mausac.* FROM sanpham,size,chitietsanpham,mausac  where sanpham.IDSanPham = chitietsanpham.IDSanPham AND sanpham.IDMau = mausac.IDMau AND size.IDSize = chitietsanpham.IDSize AND chitietsanpham.IDChiTiet='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function search_product($tukhoa){
			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT * FROM sanpham WHERE TenSanPham LIKE '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;

		}
		public function insert_product($data,$files){
			
			$TenSanPham = mysqli_real_escape_string($this->db->link, $data['TenSanPham']);
			$ThongTin = mysqli_real_escape_string($this->db->link, html_entity_decode($data['ThongTin'], ENT_QUOTES, 'UTF-8'));
			$GiaDau = mysqli_real_escape_string($this->db->link, $data['GiaDau']);
			// $GiaCuoi = mysqli_real_escape_string($this->db->link, $data['GiaCuoi']);
			
			 $IDMau = mysqli_real_escape_string($this->db->link, $data['IDMau']);
			// $IDBoSuuTap = mysqli_real_escape_string($this->db->link, $data['IDBoSuuTap']);
			$IDLoai = mysqli_real_escape_string($this->db->link, $data['IDLoai']);
			$IDKhuyenMai = mysqli_real_escape_string($this->db->link, $data['IDKhuyenMai']);
			// $IDSize = mysqli_real_escape_string($this->db->link, $data['IDSize']);
			$HinhAnh = mysqli_real_escape_string($this->db->link, $data['HinhAnh']);

			$type = mysqli_real_escape_string($this->db->link, $data['type']);


			$GiaCuoi = $this->calculate_discounted_price($GiaDau, $IDKhuyenMai);

			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			// $permited  = array('jpg', 'jpeg', 'png', 'gif');
			// $file_name = $_FILES['HinhAnh']['name'];
			// $file_size = $_FILES['HinhAnh']['size'];
			// $file_temp = $_FILES['HinhAnh']['tmp_name'];

			// $div = explode('.', $file_name);
			// $file_ext = strtolower(end($div));
			// $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			// $uploaded_image = "uploads/".$unique_image;
			
			if($TenSanPham=="" || $GiaDau=="" || $GiaCuoi==""  || $ThongTin=="" 
			|| $IDLoai=="" || $IDKhuyenMai==""| $HinhAnh =="" || $IDMau == ""){
				$alert = "<span class='error'>Nhập đầy đủ thông tin sản phẩm</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM sanpham WHERE TenSanPham='$TenSanPham' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Sản phẩm này đã tồn tại</span>";
					return $alert;
				}else{
				//move_uploaded_file($file_temp,$uploaded_image);
				$query = "INSERT INTO sanpham(TenSanPham,ThongTin,GiaDau,GiaCuoi,IDLoai,IDKhuyenMai,type,HinhAnh,IDMau,isDel) VALUES('$TenSanPham','$ThongTin','$GiaDau','$GiaCuoi','$IDLoai','$IDKhuyenMai','$type','$HinhAnh','$IDMau',0)";
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
		public function insert_slider($data,$files){
			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($sliderName=="" || $type==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Slider Added Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Slider Added Not Success</span>";
						return $alert;
					}
				}
				
				
			}
		}
		public function show_slider(){
			$query = "SELECT * FROM tbl_slider where type='1' order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_slider_list(){
			$query = "SELECT * FROM tbl_slider order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_product(){
			$query = "SELECT sanpham.*, loaisanpham.TenLoai, chuongtrinhkhuyenmai.TenKhuyenMai, mausac.MaMau, sanpham.IDSanPham as spid
			FROM sanpham 
			INNER JOIN loaisanpham ON sanpham.IDLoai = loaisanpham.IDLoai 
			INNER JOIN chuongtrinhkhuyenmai ON sanpham.IDKhuyenMai = chuongtrinhkhuyenmai.IDKhuyenMai 
			INNER JOIN mausac ON sanpham.IDMau = mausac.IDMau 
			WHERE sanpham.isDel != 1 
			ORDER BY sanpham.IDSanPham DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_type_slider($id,$type){

			$type = mysqli_real_escape_string($this->db->link, $type);
			$query = "UPDATE tbl_slider SET type = '$type' where sliderId='$id'";
			$result = $this->db->update($query);
			return $result;
		}
		public function del_slider($id){
			$query = "DELETE FROM tbl_slider where sliderId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Slider Deleted Successfully</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Slider Deleted Not Success</span>";
				return $alert;
			}
		}
		public function update_product($data,$files,$id){
			$TenSanPham = mysqli_real_escape_string($this->db->link, $data['TenSanPham']);
			$ThongTin = mysqli_real_escape_string($this->db->link, html_entity_decode($data['ThongTin'], ENT_QUOTES, 'UTF-8'));
			$GiaDau = mysqli_real_escape_string($this->db->link, $data['GiaDau']);
			// $GiaCuoi = mysqli_real_escape_string($this->db->link, $data['GiaCuoi']);
			
			$IDMau = mysqli_real_escape_string($this->db->link, $data['IDMau']);
			// $IDBoSuuTap = mysqli_real_escape_string($this->db->link, $data['IDBoSuuTap']);
			$IDLoai = mysqli_real_escape_string($this->db->link, $data['IDLoai']);
			$IDKhuyenMai = mysqli_real_escape_string($this->db->link, $data['IDKhuyenMai']);
			// $IDSize = mysqli_real_escape_string($this->db->link, $data['IDSize']);
			$HinhAnh = mysqli_real_escape_string($this->db->link, $data['HinhAnh']);


			$TienKhuyenMai = $this->getdiscountbyId($IDKhuyenMai);
			$GiaCuoi = $GiaDau - ($GiaDau * $TienKhuyenMai / 100);

			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			// $permited  = array('jpg', 'jpeg', 'png', 'gif');

			// $file_name = $_FILES['HinhAnh']['name'];
			// $file_size = $_FILES['HinhAnh']['size'];
			// $file_temp = $_FILES['HinhAnh']['tmp_name'];

			// $div = explode('.', $file_name);
			// $file_ext = strtolower(end($div));
			// // $file_current = strtolower(current($div));
			// $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			// $uploaded_image = "uploads/".$unique_image;


			if($TenSanPham=="" || $ThongTin==""  || $GiaDau=="" || $GiaCuoi=="" 
			|| $IDLoai=="" || $IDKhuyenMai=="" || $type =="" || $IDMau ==""){
				$alert = "<span class='error'>Không thể để trống</span>";
				return $alert;
			}else{
				if(!empty($HinhAnh)){
					//Nếu người dùng chọn ảnh
					// if ($file_size > 20480) {

		    		//  $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					// return $alert;
				    // } 
					// elseif (in_array($file_ext, $permited) === false) 
					// {
				    //  // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    // $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					// return $alert;
					// }
					// move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE sanpham SET
					TenSanPham = '$TenSanPham',
					ThongTin = '$ThongTin',
					GiaDau = '$GiaDau',
					GiaCuoi = '$GiaCuoi',
					
					IDLoai = '$IDLoai',
					IDKhuyenMai = '$IDKhuyenMai',
					
					type = '$type', 
					HinhAnh = '$HinhAnh',
					IDMau = '$IDMau'
					WHERE IDSanPham = '$id'";					
				}else{
					$query = "UPDATE 
					sanpham SET
					TenSanPham = '$TenSanPham',
					GiaDau = '$GiaDau',
					GiaCuoi = '$GiaCuoi',
					 
					ThongTin = '$ThongTin',
					IDLoai = '$IDLoai',
					IDKhuyenMai = '$IDKhuyenMai',
					IDMau = '$IDMau',
					type = '$type'
					
					WHERE IDSanPham = '$id'";
					
				}
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
		public function CapNhapTienKhuyenMai($IDSanPham)
		{
			$IDSanPham  = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$sql = "UPDATE sanpham SET GiaCuoi = GiaDau,IDKhuyenMai = 25 WHERE IDSanPham  = '$IDSanPham'";
			$update_cart = $this->db->update($sql);

			if ($update_cart) {
				return "Cập nhật thành công";
			} else {
				return "Cập nhật thất bại";
			}
		}
		public function SelectSanPhamKhuyenMai($IDSanPham){
			$IDSanPham  = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$query = "SELECT * FROM sanpham,chuongtrinhkhuyenmai WHERE sanpham.IDKhuyenMai = chuongtrinhkhuyenmai.IDKhuyenMai AND sanpham.IDSanPham ='$IDSanPham'";
			$result = $this->db->select($query);
			return $result;
		} 
		public function del_product($id){
			$query = "UPDATE sanpham SET isDel = 1 where IDSanPham = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa thất bại</span>";
				return $alert;
			}
			
		}
		public function del_wlist($proid,$customer_id){
			$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}
		//END BACKEND 
		public function getproduct_feathered(){
			$query = "SELECT * FROM tbl_product where type = '0' order by productId desc LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		} 
		
		public function getproduct_new(){
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		} 
		public function get_details($id){
			$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'

			";

			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestDell(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '6' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestOppo(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '3' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestHuawei(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '4' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestSamsung(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '2' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_compare($customer_id){
			$query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_wishlist($customer_id){
			$query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertCompare($productid, $customer_id){
			
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_compare = $this->db->select($check_compare);

			if($result_check_compare){
				$msg = "<span class='error'>Product Already Added to Compare</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if($insert_compare){
						$alert = "<span class='success'>Added Compare Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Added Compare Not Success</span>";
						return $alert;
					}
			}
		}
		public function insertWishlist($productid, $customer_id){
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span class='error'>Product Already Added to Wishlist</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if($insert_wlist){
						$alert = "<span class='success'>Added to Wishlist Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Added to Wishlist Not Success</span>";
						return $alert;
					}
			}
		}
		public function getdiscountbyId($id){
			$query = "SELECT TienKhuyenMai FROM chuongtrinhkhuyenmai WHERE IDKhuyenMai = '$id'";
				$result = $this->db->select($query);
				if ($result && $result->num_rows > 0) {
					// Lấy dữ liệu từ hàng đầu tiên
					$row = $result->fetch_assoc();
					// Lấy giá trị của cột TienKhuyenMai
					$TienKhuyenMai = $row['TienKhuyenMai'];
					// Trả về giá trị TienKhuyenMai
					return $TienKhuyenMai;
				} else {
					// Trường hợp không có dữ liệu hoặc có lỗi xảy ra
					return 0;
				}
		}
		public function calculate_discounted_price($GiaDau, $IDKhuyenMai) {
			$TienKhuyenMai = $this->getdiscountbyId($IDKhuyenMai);
			$GiaCuoi = $GiaDau - ($GiaDau * $TienKhuyenMai / 100);
			return $GiaCuoi;
		}


	}
?>