<?php
  include('connect.php');
  $IDSanPham = $_GET['IDSanPham'];
  $sql = $conn->prepare("SELECT * FROM comment where isdel=0 and IDSanPham =$IDSanPham");
	$sql->execute();
  echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);