<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class chitiethoadon
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_ChiTietHoaDonGuest($IDHoaDon,$IDChiTiet,$SoLuong){

			$IDHoaDon = $this->fm->validation($IDHoaDon);
			$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
            $IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
            $SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);

			
				$query = "INSERT INTO chitiethoadon(IDHoaDon,IDChiTiet,SoLuong)
				 VALUES('$IDHoaDon','$IDChiTiet','$SoLuong')";
				$result = $this->db->insert($query);
				if($result){
                    $querycapnhap = "UPDATE chitietsanpham SET SoLuong = SoLuong - '$SoLuong' WHERE IDChiTiet = '$IDChiTiet'";
                    $resultcapnhap = $this->db->update($querycapnhap);
					$alert = "<span class='success'>thêm thành công</span>";
					return $alert;
				}else{
					return "<span class='error'>thêm thất bại</span>";
				}

		}
		public function show_ChiTietHoaDon_ByIdHoaDon($IDHoaDon){
			$IDHoaDon = $this->fm->validation($IDHoaDon);
			$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
			$query = "SELECT chitiethoadon.* FROM `chitiethoadon`,hoadon WHERE chitiethoadon.IDHoaDon = hoadon.IDHoaDon and hoadon.IDHoaDon =$IDHoaDon";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>