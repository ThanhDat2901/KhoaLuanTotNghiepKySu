<?php
  include('connect.php');
  $sql = $conn->prepare("SELECT * FROM comment where isdel=0");
	$sql->execute();
  echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);