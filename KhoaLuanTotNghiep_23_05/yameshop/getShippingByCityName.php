<?php
  include('connect.php');
  $name  = $_GET['name'];
  $sql = $conn->prepare("SELECT * FROM cities WHERE name LIKE ?");
  $likeName = "%$name%";
  $sql->execute([$likeName]);
  $data = $sql->fetch(PDO::FETCH_ASSOC);
  
  $cityId = $data['id'];
  $bac = range(1, 25);
  $trung = range(26, 44);
  $nam = range(45, 63);
  if (in_array((int)$cityId, $bac)) {
      $shippingFee = 39000; 
  } elseif (in_array((int)$cityId, $trung)) {
      $shippingFee = 29000; 
  } elseif (in_array((int)$cityId, $nam)) {
      $shippingFee = 19000; 
  } else {
      $shippingFee = 0;
  }
  $result = array(
    "city_id" => $cityId,
    "shipping_fee" => $shippingFee
);
  echo json_encode($result, JSON_UNESCAPED_UNICODE);