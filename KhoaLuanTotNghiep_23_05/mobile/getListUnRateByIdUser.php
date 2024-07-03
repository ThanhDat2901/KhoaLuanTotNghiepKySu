<?php
    header("Access-Control-Allow-Origin: *");
    include('connect.php');

    $IDNguoiDung = $_GET['IDNguoiDung'];

    $sql = $conn->prepare("SELECT
                                sp.IDSanPham,
                                sp.TenSanPham,
                                sp.HinhAnh,
                                sp.IDMau,
                                cts.IDSize,
                                hd.IDHoaDon
                            FROM
                                sanpham sp
                                JOIN chitietsanpham cts ON sp.IDSanPham = cts.IDSanPham
                                JOIN chitiethoadon cthd ON cts.IDChiTiet = cthd.IDChiTiet
                                JOIN hoadon hd ON cthd.IDHoaDon = hd.IDHoaDon AND hd.IDNguoiDung = ?
                            WHERE
                                hd.IDHoaDon NOT IN (
                                    SELECT IDHoaDon
                                    FROM comment
                                )
                                AND hd.TrangThai = 6");
    $sql->execute([$IDNguoiDung]);
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);