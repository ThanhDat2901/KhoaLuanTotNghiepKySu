<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class cart
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
        public function add($IDSanPham,$IDNguoiDung,$SoLuong)
        {
            // $IDSanPham = $this->fm->validation($IDSanPham);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
            $SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
            $sql = "INSERT INTO giohang(IDSanPham,IDNguoiDung,SoLuong) VALUES ('$IDSanPham','$IDNguoiDung','$SoLuong')";

        }
        // public function add_to_cart($quantity, $id){

		// 	$quantity = $this->fm->validation($quantity);
		// 	$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		// 	$id = mysqli_real_escape_string($this->db->link, $id);
		// 	$sId = session_id();
		// 	$check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId ='$sId'";
		// 	$result_check_cart = $this->db->select($check_cart);
		// 	if($result_check_cart){
		// 		$msg = "<span class='error'>Product Already Added</span>";
		// 		return $msg;
		// 	}else{

			
			
		// 	$query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,image,price,productName) VALUES('$id','$quantity','$sId','$image','$price','$productName')";
		// 	$insert_cart = $this->db->insert($query_insert);
		// 		if($insert_cart){
		// 			header("Location:cart.php");
		// 		}else{
		// 			header("Location:404.php");
		// 		}
		// 	}
			
		// }

	}
?>