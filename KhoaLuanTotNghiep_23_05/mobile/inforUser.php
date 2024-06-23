<?php
    header("Access-Control-Allow-Origin: *");
    include 'connect.php';

    $Email = $_GET['Email'];

    $sql = $conn->prepare("SELECT * FROM thongtinnguoidung  WHERE Email = ?");
    $sql->execute([$Email]);
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
