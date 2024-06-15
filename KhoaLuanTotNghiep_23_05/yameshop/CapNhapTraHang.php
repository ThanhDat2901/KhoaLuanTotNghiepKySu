<?php
  include('connect.php');
  $IDHoaDon  = $_GET['IDHoaDon '];
  $sql = $conn->prepare("UPDATE hoadon SET  TrangThai = 8 WHERE IDHoaDon=$IDHoaDon ");
	$sql->execute();
  echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);