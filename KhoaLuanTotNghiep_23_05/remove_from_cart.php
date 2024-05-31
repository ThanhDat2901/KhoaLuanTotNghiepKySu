<?php
require 'init.php';
require 'classes/giohang.php';
$gh = new giohang();
if(!isset($_SESSION['login_detail'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            header("Location: index.php");
            exit; 
        }

        $id = $_POST['id'];

        // $isFound = false;
        // foreach ($_SESSION['cart'] as $key => $item) {
        //     if ($item['IDChiTiet'] == $id) {
        //         unset($_SESSION['cart'][$key]);
        //         $isFound = true;
        //         break; 
        //     }
        // }

        // if (!$isFound) {
        //     header("Location: index.php");
        //     exit; 
        // }
        $cartIndex = array_search($id, array_column($_SESSION['cart'], 'IDChiTiet'));

        if ($cartIndex !== false) {
            unset($_SESSION['cart'][$cartIndex]);
            // Reindex the cart array to avoid gaps
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        } else {
            header("Location: index.php");
            exit; 
        }

        header("Location: cart.php");
        exit; 
    }
}
else
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            header("Location: index.php");
            exit; 
        }
        $isFound = false;
        
        $IDChiTiet = $_POST['id'];
        $IDNguoiDung=$_SESSION['user_id'];
        $capnhapgiohang= $gh->XoaSanPhamKhoiGioHang($IDChiTiet, $IDNguoiDung);
        if($capnhapgiohang){
            $isFound = true;
        }

        if (!$isFound) {
            header("Location: index.php");
            exit; 
        }
        header("Location: cartuser.php");
        exit; 
    }
}


?>