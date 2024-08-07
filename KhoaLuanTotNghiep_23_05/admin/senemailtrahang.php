<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

class Database {
    private $host = 'localhost';
    private $db = 'dbyameshop';
    private $user = 'root';
    private $pass = '';
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    public function showHoaDon() {
        $query = "SELECT Email FROM hoadon ORDER BY IDHoaDon DESC LIMIT 1";
        $stmt = $this->pdo->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$response = ['status' => 'error', 'message' => ''];

try {
    $mail = new PHPMailer(true);
    $db = new Database();
    $emailData = $db->showHoaDon();

    if ($emailData) {
        $userEmail = $emailData['Email'];
        // Cấu hình máy chủ
        $mail->SMTPDebug = 0;                      // Bật thông báo debug
        $mail->isSMTP();                           // Sử dụng SMTP
        $mail->Host       = 'smtp.example.com';    // Địa chỉ SMTP server
        $mail->SMTPAuth   = true;                  // Bật xác thực SMTP
        $mail->Username   = $userEmail;            // Sử dụng email lấy từ cơ sở dữ liệu
        $mail->Password   = 'iugldephvsjgtcca';    // Mật khẩu SMTP
        $mail->SMTPSecure = 'tls';                 // Mã hóa TLS
        $mail->Port       = 587;                   // Cổng TCP

        // Người nhận
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('vnyameshop@gmail.com', 'YameShop');     // Thêm người nhận

        // Nội dung email
        $mail->isHTML(true);                        // Định dạng email là HTML
        $mail->Subject = 'Yêu Cầu Đổi Trả';
        $mail->Body    = "Yêu cầu đổi trả từ email: <b>$userEmail</b>";
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $response['status'] = 'success';
        $response['message'] = 'Yêu cầu đổi trả đã được gửi.';
    } else {
        $response['message'] = "Không tìm thấy email trong cơ sở dữ liệu.";
    }
} catch (Exception $e) {
    $response['message'] = "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
} catch (PDOException $e) {
    $response['message'] = "Lỗi cơ sở dữ liệu: " . $e->getMessage();
}

echo json_encode($response);
?>
