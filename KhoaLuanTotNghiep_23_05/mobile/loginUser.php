<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $Email = $_GET['Email'];
    $MatKhau = $_GET['MatKhau'];

    $sql = $conn->prepare("SELECT * FROM thongtinnguoidung  WHERE Email = ? AND MatKhau = ?");
    $sql->execute([$Email, $MatKhau]);
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
