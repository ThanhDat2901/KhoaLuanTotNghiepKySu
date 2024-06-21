<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/km.php' ?>
<?php
    $brand = new km();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh Sách Chương Trình Khuyến Mãi</h2>
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
							<th>Tên Chương Trình</th>
							<th>Khuyến Mãi</th>
							<th>Ngày Bắt Đầu</th>
							<th>Ngày Kết Thúc</th>
							<th>Thao Tác</th>
						</tr>
					</thead>
					<tbody>
					<?php

						$current_date = date('Y-m-d'); // Lấy ngày hiện tại
						$show_brand = $brand->show_brand();
						if ($show_brand) {
							$i = 0;
							while ($result = $show_brand->fetch_assoc()) {
								$i++;
								$end_date = $result['NgayKetThuc'];
								$end_date_timestamp = strtotime($end_date);
								$class = ($end_date_timestamp < strtotime($current_date)) ? 'text-danger' : '';
					?>
						<tr class="odd gradeX">
							<td style="color: <?php echo ($end_date_timestamp < strtotime($current_date)) ? 'red' : 'inherit'; ?>"><?php echo $i; ?></td>
							<td style="color: <?php echo ($end_date_timestamp < strtotime($current_date)) ? 'red' : 'inherit'; ?>"><?php echo $result['TenKhuyenMai'] ?></td>
							<td style="color: <?php echo ($end_date_timestamp < strtotime($current_date)) ? 'red' : 'inherit'; ?>"><?php echo $result['TienKhuyenMai'] ?>%</td>
							<td style="color: <?php echo ($end_date_timestamp < strtotime($current_date)) ? 'red' : 'inherit'; ?>"><?php echo $result['NgayBatDau'] ?></td>
							<td style="color: <?php echo ($end_date_timestamp < strtotime($current_date)) ? 'red' : 'inherit'; ?>"><?php echo $result['NgayKetThuc'] ?></td>
							<?php if($result['TienKhuyenMai']==0):?>
								<td></td>
							<?php else:?>
							<td><a href="kmedit.php?brandid=<?php echo $result['IDKhuyenMai'] ?>">Thay Đổi</a> || <a onclick = "return confirm('Bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDKhuyenMai'] ?>">Xóa</a></td>
							<?php endif ?>
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
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

