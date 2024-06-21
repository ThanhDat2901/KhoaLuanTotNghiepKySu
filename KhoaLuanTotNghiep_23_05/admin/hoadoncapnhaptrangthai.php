<?php
// include 'path_to_your_hoadon_class.php'; // Thay đổi đường dẫn phù hợp
require '../classes/hoadon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['IDHoaDon']) && isset($_POST['IDTrangThai'])) {
        $IDHoaDon = $_POST['IDHoaDon'];
        $IDTrangThai = $_POST['IDTrangThai'];

        $hoadon = new hoadon();
        $result = $hoadon->CapNhatTrangthai($IDHoaDon,$IDTrangThai);
        $NgayGiao = date('Y-m-d H:i:s');
        if($IDTrangThai==6)
        {
            $capnhapgiaogiao = $hoadon->CapNhatNgayGiao($IDHoaDon,$NgayGiao);
        }
        // echo $result;
        // header("Location: hoadonshowdetail.php?id=$IDHoaDon");
        header("Location: hoadonshow.php");
        exit;
    } else {
        echo "Dữ liệu không hợp lệ";
    }
} else {
    echo "Phương thức yêu cầu không hợp lệ";
}
?>