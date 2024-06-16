<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class hoadon
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_HoaDonGuest($IDNguoiDung,$TenNguoiDung,$SDT,$Email,$DiaChi,$NgayLap,$GhiChu,$ThanhTien){

			$IDNguoiDung = $this->fm->validation($IDNguoiDung);
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
            $TenNguoiDung = mysqli_real_escape_string($this->db->link, $TenNguoiDung);
            $SDT = mysqli_real_escape_string($this->db->link, $SDT);
            $Email = mysqli_real_escape_string($this->db->link, $Email);
            $DiaChi = mysqli_real_escape_string($this->db->link, $DiaChi);
            $NgayLap = mysqli_real_escape_string($this->db->link, $NgayLap);
            $GhiChu = mysqli_real_escape_string($this->db->link, $GhiChu);
            $ThanhTien = mysqli_real_escape_string($this->db->link, $ThanhTien);
			
				$query = "INSERT INTO hoadon(IDNguoiDung,TenNguoiDung,SDT,Email,DiaChi,NgayLap,GhiChu,ThanhTien,TrangThai,isDel)
				 VALUES('$IDNguoiDung','$TenNguoiDung','$SDT','$Email','$DiaChi','$NgayLap','$GhiChu','$ThanhTien',1,0)";
				$result = $this->db->insert($query);
				if($result){
					$inserted_id = mysqli_insert_id($this->db->link);
					$alert = "<span class='success'>thêm thành công</span>";
					return $inserted_id;
				}else{
					return "<span class='error'>thêm thất bại</span>";
				}

		}
		public function show_TrangThai(){
			$query = "SELECT * FROM trangthai ";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_HoaDon(){
			$query = "SELECT * FROM hoadon,TrangThai WHERE hoadon.TrangThai = TrangThai.IDTrangThai order by IDHoaDon desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_HoaDonByID($IDHoaDon){
			$query = "SELECT * FROM hoadon where IDHoaDon ='$IDHoaDon'";
			$result = $this->db->select($query);
			return $result;
		}
		public function DanhSachHoaDonByIDNguoiDung($IDNguoiDung){
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$query = "SELECT * FROM hoadon,trangthai where hoadon.TrangThai = trangthai.IDTrangThai and IDNguoiDung = '$IDNguoiDung' ORDER BY hoadon.IDHoaDon DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function KiemTraDanhSachHoaDonByIDNguoiDung($IDNguoiDung,$IDTrangThai){
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
			$IDTrangThai = mysqli_real_escape_string($this->db->link, $IDTrangThai);
			$query = "SELECT * FROM hoadon,trangthai where hoadon.TrangThai = trangthai.IDTrangThai and IDNguoiDung = '$IDNguoiDung' and hoadon.TrangThai = '$IDTrangThai'";
			$result = $this->db->select($query);
			return $result;
		}
		public function TrangThaiDonHang($IDNguoiDung,$IDTrangThai,$IDHoaDon){
			$IDNguoiDung = mysqli_real_escape_string($this->db->link, $IDNguoiDung);
            $IDTrangThai = mysqli_real_escape_string($this->db->link, $IDTrangThai);
			$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
			$query = "SELECT chitiethoadon.*,thongtinnguoidung.*,chitietsanpham.*,sanpham.*,TrangThai.*,hoadon.*,mausac.*,size.*,chitiethoadon.SoLuong AS SoluongInCTHD 
			FROM hoadon,chitiethoadon,thongtinnguoidung,chitietsanpham,sanpham,TrangThai,mausac,size 
			WHERE size.IDSize = chitietsanpham.IDSize 
			and sanpham.IDMau = mausac.IDMau 
			AND hoadon.IDHoaDon = chitiethoadon.IDHoaDon 
			and hoadon.IDNguoiDung = thongtinnguoidung.IDNguoiDung 
			and chitiethoadon.IDChiTiet = chitietsanpham.IDChiTiet 
			and chitietsanpham.IDSanPham = sanpham.IDSanPham 
			and hoadon.TrangThai = TrangThai.IDTrangThai 
			and TrangThai.IDTrangThai='$IDTrangThai' 
			and  thongtinnguoidung.IDNguoiDung = '$IDNguoiDung'
			and hoadon.IDHoaDon='$IDHoaDon'
			ORDER BY hoadon.IDHoaDon DESC
			";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_HoaDonDetail($id){
			$query = "SELECT sanpham.*, chitiethoadon.SoLuong as SoLuongMua, hoadon.*,hoadon.IDHoaDon as IdHoaDonFake,chitietsanpham.*
					  FROM chitiethoadon, chitietsanpham, hoadon, sanpham 
					  WHERE sanpham.IDSanPham = chitietsanpham.IDSanPham 
					  AND hoadon.IDHoaDon = chitiethoadon.IDHoaDon 
					  AND chitiethoadon.IDChiTiet = chitietsanpham.IDChiTiet 
					  AND hoadon.IDHoaDon = '$id' 
					  ORDER BY hoadon.IDHoaDon DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_SanPhamTrongHoaDon($id){
			$query = "SELECT sanpham.IDSanPham as idsp,sanpham.*
					  FROM chitiethoadon, chitietsanpham, hoadon, sanpham 
					  WHERE sanpham.IDSanPham = chitietsanpham.IDSanPham 
					  AND hoadon.IDHoaDon = chitiethoadon.IDHoaDon 
					  AND chitiethoadon.IDChiTiet = chitietsanpham.IDChiTiet 
					  AND hoadon.IDHoaDon = '$id' 
					  ORDER BY hoadon.IDHoaDon DESC
					  LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function tongTienTheoNgay() {
			$query = "SELECT DATE_FORMAT(NgayLap, '%Y-%m-%d') AS NgayLap,
				SUM(ThanhTien) AS TongTien
					FROM hoadon
					WHERE isdel = 0 AND (trangthai = 6 OR trangthai = 14) 
					GROUP BY DATE_FORMAT(NgayLap, '%Y-%m-%d');";
			return $this->db->select($query);
			}

		public function tongTienTheoThang() {
				$query = "SELECT DATE_FORMAT(NgayLap, '%Y-%m') as Thang, SUM(ThanhTien) as TongTien FROM hoadon where isdel=0 AND (trangthai = 6 OR trangthai = 14)  GROUP BY Thang";
				return $this->db->select($query);
			}
			
		public function tongTienTheoNam() {
				$query = "SELECT YEAR(NgayLap) as Nam, SUM(ThanhTien) as TongTien FROM hoadon where isdel=0 AND (trangthai = 6 OR trangthai = 14)  GROUP BY Nam";
				return $this->db->select($query);
			}
			public function CapNhatTrangthaiHoaDon($IDHoaDon)
			{
				$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);

				$sql = "UPDATE hoadon SET TrangThai = 2 WHERE IDHoaDon = '$IDHoaDon'";
				$update_cart = $this->db->update($sql);

				if ($update_cart) {
					return "Cập nhật thành công";
				} else {
					return "Cập nhật thất bại";
				}
			}
			public function CapNhatTrangthai($IDHoaDon,$IDTrangThai)
			{
				$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
				$IDTrangThai = mysqli_real_escape_string($this->db->link, $IDTrangThai);
				$sql = "UPDATE hoadon SET TrangThai = '$IDTrangThai' WHERE IDHoaDon = '$IDHoaDon'";
				$update_cart = $this->db->update($sql);

				if ($update_cart) {
					return "Cập nhật thành công";
				} else {
					return "Cập nhật thất bại";
				}
			}
			public function CapNhatTrangthaiTraHang($IDHoaDon,$IDTrangThai,$LyDoTra)
			{
				$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
				$IDTrangThai = mysqli_real_escape_string($this->db->link, $IDTrangThai);
				$LyDoTra = mysqli_real_escape_string($this->db->link, $LyDoTra);
				$sql = "UPDATE hoadon SET TrangThai = '$IDTrangThai', LyDoTra = '$LyDoTra' WHERE IDHoaDon = '$IDHoaDon'";
				$update_cart = $this->db->update($sql);

				if ($update_cart) {
					return "Cập nhật thành công";
				} else {
					return "Cập nhật thất bại";
				}
			}
			public function CapNhatTrangthaiDoiHang($IDHoaDon,$IDTrangThai,$LyDoDoi)
			{
				$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
				$IDTrangThai = mysqli_real_escape_string($this->db->link, $IDTrangThai);
				$LyDoDoi = mysqli_real_escape_string($this->db->link, $LyDoDoi);
				$sql = "UPDATE hoadon SET TrangThai = '$IDTrangThai', LyDoDoi = '$LyDoDoi' WHERE IDHoaDon = '$IDHoaDon'";
				$update_cart = $this->db->update($sql);

				if ($update_cart) {
					return "Cập nhật thành công";
				} else {
					return "Cập nhật thất bại";
				}
			}			
			public function HuyDonHang($IDHoaDon,$LyDoHuy)
			{
				$IDHoaDon = mysqli_real_escape_string($this->db->link, $IDHoaDon);
				$LyDoHuy = mysqli_real_escape_string($this->db->link, $LyDoHuy);
				$sql = "UPDATE hoadon SET TrangThai = 7, LyDoHuy='$LyDoHuy' WHERE IDHoaDon = '$IDHoaDon'";
				$update_cart = $this->db->update($sql);

				if ($update_cart) {
					return true;
				} else {
					return false;
				}
			}
	}
?>