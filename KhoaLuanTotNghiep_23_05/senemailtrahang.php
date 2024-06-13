<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'classes/hoadon.php';
// Kết nối cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root"; // Thay thế bằng tên người dùng cơ sở dữ liệu của bạn
$password = ""; // Thay thế bằng mật khẩu của cơ sở dữ liệu của bạn
$dbname = "dbyameshop"; // Thay thế bằng tên của cơ sở dữ liệu của bạn
$hoadon = new hoadon();
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Khởi tạo biến response
$response = array('message' => '');

// Kiểm tra xem request có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu gửi từ AJAX
    $action = $_POST['action'];
    $idHoaDon = $_POST['idHoaDon'];
    // Nếu action là 'doi_tra_hang', thực hiện gửi email
    if ($action == 'doi_tra_hang') {
       
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'vnyameshop@gmail.com';
            $mail->Password   = 'iugldephvsjgtcca';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('vnyameshop@gmail.com', 'Admin');
            $mail->addAddress('vnyameshop@gmail.com', 'YameShop');

            //Content
            $mail->isHTML(true);
            $mail->Subject = '=?UTF-8?B?' . base64_encode('Yêu cầu đổi trả từ người dùng') . '?=';

            // Truy vấn dữ liệu từ bảng hoadon
            $sql = "SELECT * FROM hoadon where IDHoaDon = '$idHoaDon'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $email = $row['Email']; // Thay 'email' bằng tên cột chứa địa chỉ email trong bảng hoadon
                $mail->Body    = "Yêu cầu đổi trả từ email: <b>$email</b>";
            } else {
                $mail->Body    = "Không có thông tin đơn hàng nào.";
            }
            $Capnhaptrangthai = $hoadon->CapNhatTrangthai($idHoaDon,8);
            // Gửi email
            $mail->send();
            $response['message'] = 'Email đã được gửi đi';

        } catch (Exception $e) {
            $response['message'] = "Không thể gửi email. Lỗi Mailer: {$mail->ErrorInfo}";
        }
    } else {
        $response['message'] = 'Hành động không hợp lệ';
    }
} else {
    $response['message'] = 'Yêu cầu không hợp lệ';
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();

// Trả về phản hồi dưới dạng JSON
echo json_encode($response);
?>
