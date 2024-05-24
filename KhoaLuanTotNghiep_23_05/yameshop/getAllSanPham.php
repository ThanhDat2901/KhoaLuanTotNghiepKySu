<?php 
header("Access-Control-Allow-Origin: *");
include('../classes/product.php');

$pr = new product();

$data = $pr->getAllSanPhamAPI();

// echo json_encode($data, JSON_UNESCAPED_UNICODE);

// Chuyển đổi dữ liệu từ chuỗi JSON thành mảng
// $data_array = json_decode(json_encode($data), true);

// // Duyệt qua mỗi phần tử trong mảng và thay thế các dấu '><\/span>' bằng '>'
// foreach ($data_array as &$product) {
//     $product['ThongTin'] = str_replace('><\/span>', '>', $product['ThongTin']);
// }

// // Chuyển đổi mảng đã được sửa đổi thành chuỗi JSON và trả về
// echo json_encode($data_array, JSON_UNESCAPED_UNICODE);


// Lặp qua mảng dữ liệu sản phẩm
foreach ($data as &$product) {
    // Xử lý dữ liệu trong cột ThongTin để loại bỏ các ký tự escape không mong muốn
    $product['ThongTin'] = str_replace('<\/span>', '</span>', $product['ThongTin']);
}

// Chuyển đổi mảng thành chuỗi JSON và trả về
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>