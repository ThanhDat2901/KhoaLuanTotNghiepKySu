<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/hoadon.php' ?>
<!-- <?php
    $brand = new hoadon();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?> -->
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Hóa Đơn Bán Hàng</h2>
                <div class="block">    
                <?php

                if(isset($delbrand)){
                    echo $delbrand;
                }

                ?>    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Số Thứ Tự</th>
							<th>Tên Người Dùng</th>
							<th>Số Điện Thoại</th>
							<th>Email</th>
                            <th>Địa Chỉ</th>
                            <th>Ngày Mua</th>
                            <th>Ghi Chú</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_brand = $brand->show_HoaDon();
						if($show_brand){
							$i = 0;
							while($result = $show_brand->fetch_assoc()){
								$i++;
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['TenNguoiDung'] ?></td>
							<td><?php echo $result['SDT'] ?></td>
							<td><?php echo $result['Email'] ?></td>
                            <td><?php echo $result['DiaChi'] ?></td>
                            <td><?php echo $result['NgayLap'] ?></td>
                            <td><?php echo $result['GhiChu'] ?></td>
                            <td><?php echo $result['ThanhTien'] ?></td>
							<td><button class="send-email-btn" data-email="<?php echo $result['Email']; ?>">Xác Nhận Đơn Hàng</button></td>
                            
							<!-- <td><a href="chitietsanphamedit.php?brandid=<?php echo $result['IDChiTiet'] ?>">Thay Đổi</a> || <a onclick = "return confirm('bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDChiTiet'] ?>">Xóa</a></td> -->
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
            $.ajax({
                url: 'senemail.php', // Đường dẫn tới script xử lý gửi email
                method: 'POST',
                data: { email: email },
                success: function (response) {
                    alert('Email xác nhận đã được gửi thành công đến người.');
                },
                error: function (xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                }
            });
        });
    });
</script>

