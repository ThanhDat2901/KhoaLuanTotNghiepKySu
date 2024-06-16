

<?php
session_start();
require 'classes/giohang.php';
require 'classes/product.php';
$gh = new giohang();
$pr = new product();
if(isset($_SESSION['login_detail'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId']) && isset($_POST['action'])) {
        $IDChiTiet = $_POST['productId'];
        $action = $_POST['action'];
        $IDNguoiDung=$_SESSION['user_id'];
        if ($action === 'increase') {
            // Tăng số lượng sản phẩm
            $SoLuong=1;
            $soluongtronggiohang = $gh->DemSoLuongSanPhamTrongGioHang($IDChiTiet,$IDNguoiDung);
            $availableQuantity = $pr->getAvailableQuantity($IDChiTiet); 
            if ($soluongtronggiohang < $availableQuantity) {
                $capnhapsoluong = $gh->CapNhatSoLuongSanPhamTrongGioHang($IDChiTiet, $IDNguoiDung, $SoLuong);
            }
        } elseif ($action === 'decrease') {
            // Giảm số lượng sản phẩm
            $SoLuong = -1;
            $soluongtronggiohang = $gh->DemSoLuongSanPhamTrongGioHang($IDChiTiet,$IDNguoiDung);
            if ($soluongtronggiohang > 1) {
                $capnhapsoluong = $gh->CapNhatSoLuongSanPhamTrongGioHang($IDChiTiet, $IDNguoiDung, $SoLuong);
            }
        }

        // Trả về kết quả thành công
        echo 'success';
        header('Location: cartuser.php'); 
    } else {
        // Trả về lỗi nếu yêu cầu không hợp lệ
        http_response_code(400);
        echo 'Invalid request';
    }

   
}
else
{
    // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId']) && isset($_POST['action'])) {
    //     $IDChiTiet = $_POST['productId'];
    //     $action = $_POST['action'];

    //     if ($action === 'increase') {
    //         // Tăng số lượng sản phẩm
    //         if (isset($_SESSION['cart'][$IDChiTiet])) {
    //             $_SESSION['cart'][$IDChiTiet]['SoLuong']++;
    //         }
    //     } elseif ($action === 'decrease') {
    //         // Giảm số lượng sản phẩm
    //         if (isset($_SESSION['cart'][$IDChiTiet]) && $_SESSION['cart'][$IDChiTiet]['SoLuong'] > 1) {
    //             $_SESSION['cart'][$IDChiTiet]['SoLuong']--;
    //         }
    //     }

    //     echo 'success';
    //     header('Location: cart.php'); 
    // } else {
    //     http_response_code(400);
    //     echo 'Invalid request';
    // }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId']) && isset($_POST['action'])) {
        $IDChiTiet = $_POST['productId'];
        $action = $_POST['action'];
    
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    
        $cartIndex = array_search($IDChiTiet, array_column($_SESSION['cart'], 'IDChiTiet'));
    
        if ($action === 'increase') {
            $soluongtronggiohang = $_SESSION['cart'][$cartIndex]['SoLuong'];
            $availableQuantity = $pr->getAvailableQuantity($IDChiTiet); 
            // Increase the quantity
            if ($cartIndex !== false && $soluongtronggiohang < $availableQuantity) {
                $_SESSION['cart'][$cartIndex]['SoLuong']++;
            } 
            // else {
            //     $_SESSION['cart'][] = array(
            //         'IDChiTiet' => $IDChiTiet,
            //         'SoLuong' => 1
            //     );
            // }
        } elseif ($action === 'decrease') {
            if ($cartIndex !== false && $_SESSION['cart'][$cartIndex]['SoLuong'] > 1) {
                $_SESSION['cart'][$cartIndex]['SoLuong']--;
            }
        }
    
        echo 'success';
        header('Location: cart.php');
    } else {
        http_response_code(400);
        echo 'Invalid request';
    }
}

?>