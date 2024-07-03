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
                            c.Rate,
                            c.NoiDung,
                            c.IDHoaDon
                        FROM
                            comment c
                            JOIN sanpham sp ON c.IDSanPham = sp.IDSanPham
                            JOIN chitietsanpham cts ON sp.IDSanPham = cts.IDSanPham
                        WHERE
                            c.IDNguoiDung = ?");
    $sql->execute([$IDNguoiDung]);
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);