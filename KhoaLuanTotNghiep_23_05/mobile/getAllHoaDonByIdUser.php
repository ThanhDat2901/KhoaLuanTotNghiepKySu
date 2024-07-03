<?php
    header("Access-Control-Allow-Origin: *");
    include('connect.php');

    $IDNguoiDung = $_GET['IDNguoiDung'];

    $sql = $conn->prepare("SELECT
                              h.IDHoaDon,
                              h.ThanhTien,
                              h.TrangThai,
                              h.LyDoHuy,
                              h.LyDoTra,
                              h.LyDoDoi,
                              sp.TenSanPham,
                              sp.HinhAnh,
                              sp.IDMau,
                              sp.GiaDau,
                              sp.GiaCuoi,
                              cts.IDSize,
                              cth.SoLuong
                            FROM
                              hoadon h
                              JOIN chitiethoadon cth ON h.IDHoaDon = cth.IDHoaDon
                              JOIN chitietsanpham cts ON cth.IDChiTiet = cts.IDChiTiet
                              JOIN sanpham sp ON cts.IDSanPham = sp.IDSanPham
                            WHERE
                              h.IDNguoiDung = ?");
    $sql->execute([$IDNguoiDung]);
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);