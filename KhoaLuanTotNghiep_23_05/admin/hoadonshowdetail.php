<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/hoadon.php' ?>
<?php
    $brand = new hoadon();
    if(isset($_GET['id'])){
        $id = $_GET['id']; 
        $show_brand_detail = $brand->show_HoaDonDetail($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Chi Tiết Hóa Đơn</h2>
        <div class="block">    
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Số Thứ Tự</th>
                        <th>Tên Người Dùng</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Địa Chỉ</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Hình Ảnh</th>
                        <th>Số Lượng Mua</th>
                        <th>Ngày Mua</th>
                        <th>Ghi Chú</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($show_brand_detail){
                        $i = 0;
                        while($result = $show_brand_detail->fetch_assoc()){
                            $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['TenNguoiDung'] ?></td>
                        <td><?php echo $result['SDT'] ?></td>
                        <td><?php echo $result['Email'] ?></td>
                        <td><?php echo $result['DiaChi'] ?></td>
                        <td><?php echo $result['TenSanPham'] ?></td>
                        <td><img src="<?php echo $result['HinhAnh'] ?>" width="50"/></td>
                        <td><?php echo $result['SoLuongMua'] ?></td>
                        <td><?php echo $result['NgayLap'] ?></td>
                        <td><?php echo $result['GhiChu'] ?></td>
                        <td><?php echo number_format($result['ThanhTien'], 0, ',', '.') ?> VND</td>
                        <td><button style="border-radius: 5px;" class="send-email-btn" data-email="<?php echo $result['Email']; ?>">Xác Nhận Đơn Hàng</button></td>
                    </tr>
                    <?php
                }
                    }
                    ?>
                </tbody>
            </table>
       </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
    $(document).ready(function () {
        $('.send-email-btn').click(function () {
            var email = $(this).data('email');
            var button = $(this);

            // Khóa nút và thay đổi văn bản
            button.prop('disabled', true).addClass('confirmed').text('Đã Xác Nhận');

            $.ajax({
                url: 'senemail.php',
                method: 'POST',
                data: { email: email },
                success: function (response) {
                    alert('Email xác nhận đã được gửi thành công đến người.');
                },
                error: function (xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                    
                    // Mở khóa nút nếu có lỗi xảy ra
                    button.prop('disabled', false).removeClass('confirmed').text('Xác Nhận Đơn Hàng');
                }
            });
        });
    });
</script>

<style>
.confirmed {
    pointer-events: none; /* Khóa nút */
    background-color: #ccc; /* Màu nền */
    color: #000; /* Màu văn bản */
    border-radius: 5px; /* Độ cong của góc */
}
</style>
