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
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vnyameshop@gmail.com';
    $mail->Password   = 'iugldephvsjgtcca';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Lấy thông tin hóa đơn
    $show_brand = $brand->show_HoaDon();
    if($show_brand){
        while($result = $show_brand->fetch_assoc()){
            $email = $result['Email'];
            $email_sent = $result['email_sent'];
            if (!$email_sent) {
                // Lấy chi tiết hóa đơn
                $orderDetails = $brand->show_HoaDonDetail($result['IDHoaDon']);
                
                $shopInfo = '
                    <div style="width: 100%; background-color: white; border: 2px solid blue; border-radius: 10px; padding: 10px; margin-bottom: 20px; text-align: center;">
                        <img src="https://toplist.vn/images/800px/yame-87031.jpg" alt="YameShop Logo" width="100"/>
                        <h2 style="color: black;">Cảm ơn bạn đã tin tưởng các sản phẩm và sử dụng dịch vụ của YameShop.Vn</h2>
                    </div>';

                $orderInfo = '
                    <div style="width: 100%; background-color: white; border: 2px solid blue; border-radius: 10px; padding: 10px; margin-bottom: 20px;">
                        <h3 style="color: black;">Thông tin đơn hàng:</h3>
                        <ul style="list-style-type: none; padding: 0; color: black;">
                            <li><strong>Tên Người Mua:</strong> ' . $result['TenNguoiDung'] . '</li>
                            <li><strong>Email Mua Hàng:</strong> ' . $result['Email'] . '</li>
                            <li><strong>Địa Chỉ Giao Hàng:</strong> ' . $result['DiaChi'] . '</li>
                            <li><strong>Ghi Chú:</strong> ' . $result['GhiChu'] . '</li>
                            <li><strong>Ngày Mua:</strong> ' . $result['NgayLap'] . '</li>
                            <li><strong>Số Điện Thoại:</strong> ' . $result['SDT'] . '</li>
                            <li><strong>Tổng Tiền:</strong> ' . number_format($result['ThanhTien'], 0, ',', '.') . ' VND</li>
                        </ul>
                    </div>';

                $productInfo = '
                    <div style="width: 100%; background-color: white; border: 2px solid blue; border-radius: 10px; padding: 10px;">
                        <h3 style="color: black;">Thông tin sản phẩm:</h3>
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Tên Sản Phẩm</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Số Lượng Mua</th>
                                    <th style="border: 1px solid #ddd; padding: 8px;">Hình Ảnh</th>
                                </tr>
                            </thead>
                            <tbody>';
                if ($orderDetails) {
                    while ($detail = $orderDetails->fetch_assoc()) {
                        $productInfo .= '
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;">' . $detail['TenSanPham'] . '</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">' . $detail['SoLuongMua'] . '</td>
                                <td style="border: 1px solid #ddd; padding: 8px;"><img src="' . $detail['HinhAnh'] . '" alt="' . $detail['TenSanPham'] . '" width="50"/></td>
                            </tr>';
                    }
                }
                $productInfo .= '
                            </tbody>
                        </table>
                    </div>';

                // Gửi email
                $mail->setFrom('thuytrang17052901@gmail.com', 'YameShop.Vn');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Xác nhận đơn hàng từ YameShop.Vn';
                $mailContent = '
                    <p style="color: black;">Cảm ơn quý khách đã đặt hàng tại YameShop. Đơn hàng của bạn đã được xác nhận.</p>
                    ' . $shopInfo . '
                    ' . $orderInfo . '
                    ' . $productInfo . '
                    <p style="color: black;"><strong>YameShop.Vn Hân Hạnh Được Phục Vụ</strong></p>';
                $mail->Body = $mailContent;
                $mail->send();

                // Cập nhật trạng thái gửi email trong cơ sở dữ liệu
                $brand->updateEmailSentStatus($result['IDHoaDon'], 1);
            }
        }
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
