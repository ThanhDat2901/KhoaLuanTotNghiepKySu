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
				 VALUES('$IDNguoiDung','$TenNguoiDung','$SDT','$Email','$DiaChi','$NgayLap','$GhiChu','$ThanhTien',0,0)";
				$result = $this->db->insert($query);
				if($result){
					$inserted_id = mysqli_insert_id($this->db->link);
					$alert = "<span class='success'>thêm thành công</span>";
					return $inserted_id;
				}else{
					return "<span class='error'>thêm thất bại</span>";
				}

		}
		public function show_HoaDon(){
			$query = "SELECT * FROM hoadon order by IDHoaDon desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_HoaDonDetail($id){
			$query = "SELECT sanpham.*, chitiethoadon.SoLuong as SoLuongMua, hoadon.* 
					  FROM chitiethoadon, chitietsanpham, hoadon, sanpham 
					  WHERE sanpham.IDSanPham = chitietsanpham.IDSanPham 
					  AND hoadon.IDHoaDon = chitiethoadon.IDHoaDon 
					  AND chitiethoadon.IDChiTiet = chitietsanpham.IDChiTiet 
					  AND hoadon.IDHoaDon = '$id' 
					  ORDER BY hoadon.IDHoaDon DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function tongTienTheoNgay() {
			$query = "SELECT NgayLap, SUM(ThanhTien) as TongTien
			FROM hoadon GROUP BY NgayLap";
			return $this->db->select($query);
			}

		public function tongTienTheoThang() {
				$query = "SELECT DATE_FORMAT(NgayLap, '%Y-%m') as Thang, SUM(ThanhTien) as TongTien FROM hoadon GROUP BY Thang";
				return $this->db->select($query);
			}
			
		public function tongTienTheoNam() {
				$query = "SELECT YEAR(NgayLap) as Nam, SUM(ThanhTien) as TongTien FROM hoadon GROUP BY Nam";
				return $this->db->select($query);
			}
	}
?>