<?php
  include('connect.php');
  $name  = $_GET['name'];
  $sql = $conn->prepare("SELECT * FROM cities WHERE name LIKE ?");
  $likeName = "%$name%";
  $sql->execute([$likeName]);
  $data = $sql->fetch(PDO::FETCH_ASSOC);
  
  echo json_encode($data, JSON_UNESCAPED_UNICODE);