<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

include '../classes/hoadon.php';
$brand = new hoadon();
$mail = new PHPMailer(true);
try {
    // Cấu hình gửi email
    $mail->isSMTP(); // Gửi qua SMTP
    $mail->Host       = 'smtp.gmail.com'; // Địa chỉ SMTP server
    $mail->SMTPAuth   = true; // Sử dụng SMTP authentication
    $mail->Username   = 'thuytrang17052901@gmail.com'; // Tài khoản SMTP
    $mail->Password   = 'eycgtprmaddpbpxx'; // Mật khẩu SMTP
    $mail->SMTPSecure = 'tls'; // Giao thức bảo mật
    $mail->Port       = 587; // Cổng kết nối SMTP

    // Lấy thông tin hóa đơn
    $show_brand = $brand->show_HoaDon();
    if($show_brand){
        while($result = $show_brand->fetch_assoc()){
            $email = $result['Email']; // Lấy email từ hóa đơn
            $email_sent = $result['email_sent']; // Trạng thái gửi email
            if (!$email_sent) { // Nếu email chưa được gửi
                // Gửi email
                $mail->setFrom('thuytrang17052901@gmail.com', 'YameShop.Vn');
                $mail->addAddress($email); // Thêm địa chỉ email người dùng
                $mail->isHTML(true); // Đặt định dạng email là HTML
                $mail->Subject = 'Xác nhận đơn hàng từ YameShop.Vn';
                // Nội dung email
                $mailContent = '
                    <p>Cảm ơn quý khách đã đặt hàng tại YameShop. Đơn hàng của bạn đã được xác nhận.</p>
                    <p><strong>Thông tin đơn hàng:</strong></p>
                    <ul>
                        <li style="color:blue">Tổng Tiền: ' . $result['ThanhTien'] . '</li>
                        <li>Người Mua: ' . $result['TenNguoiDung'] . '</li>
                        <li>Email Mua Hàng: ' . $result['Email'] . '</li>
                        <li>Địa Chỉ Giao Hàng: ' . $result['DiaChi'] . '</li>
                        <li>Ngày Mua: ' . $result['NgayLap'] . '</li>
                        <li>Số Điện Thoại: ' . $result['SDT'] . '</li>
                    </ul>
                    <p><strong>YameShop.Vn Hân Hạnh Được Phục Vụ</strong></p>
                ';
                $mail->Body = $mailContent;
                $mail->send(); // Gửi email

                // Cập nhật trạng thái gửi email trong cơ sở dữ liệu
                $brand->updateEmailSentStatus($result['ID'], 1);
            }
        }
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
