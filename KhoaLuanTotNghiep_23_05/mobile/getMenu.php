<?php
include('connect.php');

$sql = $conn->prepare(
  "SELECT menutrangchu.IdRow, menutrangchu.IDBoSuuTap, bosuutap.TenBoSuuTap AS NameBoSuuTap
                          FROM menutrangchu
                          INNER JOIN bosuutap ON menutrangchu.IDBoSuuTap = bosuutap.IDBoSuuTap"
);
$sql->execute();
echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
