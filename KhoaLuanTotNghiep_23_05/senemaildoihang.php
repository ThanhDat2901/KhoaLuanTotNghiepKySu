<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'classes/hoadon.php';
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "dbyameshop"; 
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
    $idHoaDon = $_POST['IDHoaDonDoiHang'];
    $LyDoDoi = $_POST['LyDoDoi'];
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
            $mail->Subject = '=?UTF-8?B?' . base64_encode('Yêu cầu đổi hàng từ người dùng') . '?=';

            // Truy vấn dữ liệu từ bảng hoadon
            $sql = "SELECT * FROM hoadon where IDHoaDon = '$idHoaDon'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $email = $row['Email']; // Thay 'email' bằng tên cột chứa địa chỉ email trong bảng hoadon

                $show_brand = $hoadon->show_HoaDonByID($idHoaDon);
                $orderDetails = $hoadon->show_HoaDonDetail($idHoaDon);
                $resulthoadon = $show_brand->fetch_assoc();
                $orderInfo = '
                    <div style="width: 100%; background-color: white; border: 2px solid blue; border-radius: 10px; padding: 10px; margin-bottom: 20px;">
                        <h3 style="color: black;">Thông tin đơn hàng:</h3>
                        <ul style="list-style-type: none; padding: 0; color: black;">
                            <li><strong>Tên Người Mua:</strong> ' . $resulthoadon['TenNguoiDung'] . '</li>
                            <li><strong>Email Mua Hàng:</strong> ' . $resulthoadon['Email'] . '</li>
                            <li><strong>Địa Chỉ Giao Hàng:</strong> ' . $resulthoadon['DiaChi'] . '</li>
                            <li><strong>Ghi Chú:</strong> ' . $resulthoadon['GhiChu'] . '</li>
                            <li><strong>Mã Hóa Đơn:</strong> ' . $resulthoadon['IDHoaDon'] . '</li>
                            <li><strong>Ngày Mua:</strong> ' . $resulthoadon['NgayLap'] . '</li>
                            <li><strong>Số Điện Thoại:</strong> ' . $resulthoadon['SDT'] . '</li>
                            <li><strong>Tổng Tiền:</strong> ' . number_format($resulthoadon['ThanhTien'], 0, ',', '.') . ' VND</li>
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


                $mailContent = '
                    <p style="color: black;">Yêu cầu đổi hàng từ email: <b>'.$email.'</b></p>
                    ' . $orderInfo . '
                    ' . $productInfo . '
                    <p style="color: black;"><strong>Yêu cầu xử lý</strong></p>';
                $mail->Body = $mailContent;

                // $mail->Body    = "Yêu cầu trả hàng từ email: <b>$email</b>";
            } else {
                $mail->Body    = "Không có thông tin đơn hàng nào.";
            }
            $Capnhaptrangthai = $hoadon->CapNhatTrangthaiDoiHang($idHoaDon,9,$LyDoDoi);
            // Gửi email
            $mail->send();
            $response['message'] = 'Đã gửi yêu cầu đổi hàng';

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
exit;
?>
