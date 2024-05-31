<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class giohang
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
        public function ThemSanPhamVaoGioHang($IDChiTiet,$IDNguoiDung,$SoLuong)
			{
				// $IDSanPham = $this->fm->validation($IDSanPham);
				$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
				$sql = "INSERT INTO giohang(IDChiTiet,IDNguoiDung,SoLuong) VALUES ('$IDChiTiet','$IDNguoiDung','$SoLuong')";
				$insert_cart = $this->db->insert($sql);
				if($insert_cart){
								return true;
							}else{
								return false;
							}
			}
		public function KiemTraSanPhamTrongGioHang($IDChiTiet,$IDNguoiDung)
			{
				$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$sql = "SELECT * FROM giohang WHERE IDChiTiet = '$IDChiTiet' And IDNguoiDung ='$IDNguoiDung'";
				$result = $this->db->select($sql);

				if ($result && mysqli_num_rows($result) > 0) {
					return 1;  
				} else {
					return -1; 
				}
			}
		public function DemSoLuongSanPhamTrongGioHang($IDChiTiet,$IDNguoiDung)
			{
				$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$sql = "SELECT SoLuong FROM giohang WHERE IDChiTiet = '$IDChiTiet' And IDNguoiDung ='$IDNguoiDung'";
				$result = $this->db->select($sql);

				if ($result) {
					$row = mysqli_fetch_assoc($result);
					return $row['SoLuong']; 
				} else {
					return 0; 
				}
			}
			public function DemSoLuongSanPhamTrongGioHangByNguoiDung($IDNguoiDung)
			{
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$sql = "SELECT COUNT(*) FROM giohang where IDNguoiDung = '$IDNguoiDung'";
				$result = $this->db->select($sql);
				$row = $result->fetch_row(); 
				$count = $row[0]; 
				return $count;
			}
		public function CapNhatSoLuongSanPhamTrongGioHang($IDChiTiet, $IDNguoiDung, $SoLuong)
			{
				$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
				$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
				$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);

				$sql = "UPDATE giohang SET SoLuong = SoLuong + $SoLuong WHERE IDChiTiet = '$IDChiTiet' AND IDNguoiDung = '$IDNguoiDung'";
				$update_cart = $this->db->update($sql);

				if ($update_cart) {
					return "Cập nhật thành công";
				} else {
					return "Cập nhật thất bại";
				}
			}
			// public function XoaSanPhamKhoiGioHang($IDChiTiet, $IDNguoiDung){
			// 	$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
			// 	$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			// 	$query = "DELETE FROM giohang where IDChiTiet = '$IDChiTiet' AND IDNguoiDung = '$IDNguoiDung'";
			// 	$result = $this->db->delete($query);
			// 	if($result){
			// 		$alert = "<span class='success'>Xóa thành công</span>";
			// 		return $alert;
			// 	}else{
			// 		$alert = "<span class='error'>Xóa thất bại</span>";
			// 		return $alert;
			// 	}
				
			// }
			public function XoaSanPhamKhoiGioHang($IDChiTiet, $IDNguoiDung){
				// Kiểm tra nếu $IDChiTiet là một mảng
				if (is_array($IDChiTiet)) {
					// Duyệt qua mảng IDChiTiet và thực hiện xóa từng ID một
					foreach ($IDChiTiet as $ID) {
						// Escape ID để tránh lỗ hổng SQL injection
						$ID = mysqli_real_escape_string($this->db->link, $ID);
						$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
						
						// Tạo truy vấn xóa cho mỗi ID
						$query = "DELETE FROM giohang WHERE IDChiTiet = '$ID' AND IDNguoiDung = '$IDNguoiDung'";
						$result = $this->db->delete($query);
						
						// Kiểm tra kết quả của truy vấn và trả về thông báo tương ứng
						if($result){
							$alert = "<span class='success'>Xóa thành công</span>";
						} else {
							$alert = "<span class='error'>Xóa thất bại</span>";
						}
					}
				} else {
					// Nếu $IDChiTiet không phải là một mảng, xử lý như thông thường
					$IDChiTiet = mysqli_real_escape_string($this->db->link, $IDChiTiet);
					$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
					
					$query = "DELETE FROM giohang WHERE IDChiTiet = '$IDChiTiet' AND IDNguoiDung = '$IDNguoiDung'";
					$result = $this->db->delete($query);
			
					if($result){
						$alert = "<span class='success'>Xóa thành công</span>";
					} else {
						$alert = "<span class='error'>Xóa thất bại</span>";
					}
				}
			
				return $alert; 
			}
		public function DanhSachSanPhamGioHang(){
				$query = "SELECT * FROM giohang order by IDGioHang desc";
				$result = $this->db->select($query);
				return $result;
		}
		public function DanhSachSanPhamGioHangPhanTrang($IDNguoiDung,$limit, $offset)
		{
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$sql = "SELECT * FROM giohang where IDNguoiDung = '$IDNguoiDung'   ORDER BY IDGioHang DESC LIMIT $limit OFFSET $offset";
			$result = $this->db->select($sql);
			return $result;
		}
		public function DanhSachSanPhamGioHangKhongPhanTrang($IDNguoiDung)
		{
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$sql = "SELECT * FROM giohang where IDNguoiDung = '$IDNguoiDung'   ORDER BY IDGioHang DESC";
			$result = $this->db->select($sql);
			return $result;
		}
		public function countAll($IDNguoiDung)
		{
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$sql = "SELECT COUNT(*) FROM giohang where IDNguoiDung = '$IDNguoiDung' ";
			$result = $this->db->select($sql);
			$row = $result->fetch_row(); 
			$count = $row[0]; 
			return $count;
		}


	}
?>