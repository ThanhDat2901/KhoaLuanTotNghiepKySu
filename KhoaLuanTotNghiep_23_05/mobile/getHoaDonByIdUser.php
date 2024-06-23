<?php
    header("Access-Control-Allow-Origin: *");
    include('connect.php');

    $IDNguoiDung = $_GET['IDNguoiDung'];

    $sql = $conn->prepare("SELECT * FROM hoadon WHERE IDNguoiDung = ?");
    $sql->execute([$IDNguoiDung]);
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);