<?php
  include('connect.php');

  $sql = $conn->prepare("SELECT * FROM cities");
	$sql->execute();
  echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);