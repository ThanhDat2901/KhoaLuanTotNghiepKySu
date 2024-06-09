<?php

  header("Access-Control-Allow-Origin: *");
  include('connect.php');

  $email = $_POST['email'];
  $matkhau = $_POST['matkhau'];
  
  $sql = $conn->prepare("SELECT thongtinnguoidung.IDNguoiDung, TenNguoiDung, Email, MatKhau,phanquyen.IDQuyen as idpq FROM thongtinnguoidung,phanquyen,quyen 
        WHERE thongtinnguoidung.IDNguoiDung = phanquyen.IDNguoiDung
        and quyen.IDQuyen = phanquyen.IDQuyen
         and Email='$email' and MatKhau='$matkhau'");
  $sql->execute();
  echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);
  
  
  
?>