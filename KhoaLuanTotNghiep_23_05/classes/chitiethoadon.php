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
		public function update_chitiethoadon($IDChiTiet,$IDHoaDon,$SoLuong){
			$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
			$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
			$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
			// $id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($IDChiTiet)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE chitiethoadon SET IDChiTiet='$IDChiTiet' WHERE IDHoaDon = '$IDHoaDon'";
				$query2 = "UPDATE chitietsanpham SET SoLuong= SoLuong - '$SoLuong' WHERE IDChiTiet = '$IDChiTiet'";
				$result = $this->db->update($query);
				$result2 = $this->db->update($query2);
				if($result){
					$alert = "<span class='success'>Thay đổi thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thay đổi thất bại</span>";
					return $alert;
				}
			}

		}
		public function show_ChiTietHoaDon_ByIdHoaDon($IDHoaDon){
			$IDHoaDon = $this->fm->validation($IDHoaDon);
			$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
			$query = "SELECT chitiethoadon.* FROM `chitiethoadon`,hoadon WHERE chitiethoadon.IDHoaDon = hoadon.IDHoaDon and hoadon.IDHoaDon =$IDHoaDon";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_ChiTietHoaDon_ByIdChiTietHoaDon($IDHoaDon,$IDChiTiet){
			$IDChiTiet = $this->fm->validation($IDChiTiet);
			$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
			$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
			$query = "SELECT sanpham.*, chitiethoadon.SoLuong as SoLuongMua, hoadon.*,hoadon.IDHoaDon as IdHoaDonFake,chitietsanpham.*,chitietsanpham.IDChiTiet as IDChiTietDetail,chitietsanpham.IDSize as CTIDSize
					  FROM chitiethoadon, chitietsanpham, hoadon, sanpham 
					  WHERE sanpham.IDSanPham = chitietsanpham.IDSanPham 
					  AND hoadon.IDHoaDon = chitiethoadon.IDHoaDon 
					  AND chitiethoadon.IDChiTiet = chitietsanpham.IDChiTiet 
					  AND chitiethoadon.IDChiTiet= '$IDChiTiet' 
					    AND hoadon.IDHoaDon= '$IDHoaDon' 
					  ORDER BY hoadon.IDHoaDon DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_ChiTietSanPham_ByIdSize_IdSanPham($IDSize,$IDSanPham){		
			$IDSize = mysqli_real_escape_string($this->db->link, $IDSize);
			$IDSanPham = mysqli_real_escape_string($this->db->link, $IDSanPham);
			$query = "SELECT chitietsanpham.*
					  FROM chitietsanpham, sanpham ,size
					  WHERE sanpham.IDSanPham = chitietsanpham.IDSanPham                
                      and chitietsanpham.IDSize = size.IDSize
                      and chitietsanpham.IDSize='$IDSize'
                      and chitietsanpham.IDSanPham = '$IDSanPham'";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>