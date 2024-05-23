<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/nguoidung.php' ?>
<?php include '../classes/quyen.php' ?>
<?php
    $brand = new nguoidung();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh Sách Tài Khoản</h2>
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
							<th>Tên Nhân Viên</th>
							<th>Địa Chỉ</th>
							<th>Số Điện Thoại</th>
							<th>Email</th>
							<th>Quyền</th>
							<th>Thao Tác</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_brand = $brand->show_nguoidung();
						if($show_brand){
							$i = 0;
							while($result = $show_brand->fetch_assoc()){
								$i++;
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['TenNguoiDung'] ?></td>
							<td><?php echo $result['DiaChi'] ?></td>
							<td><?php echo $result['SDT'] ?></td>
							<td><?php echo $result['Email'] ?></td>
							<td><?php echo $result['TenQuyen'] ?></td>
							<td><a href="nguoidungedit.php?brandid=<?php echo $result['IDNguoiDung'] ?>">Thay Đổi</a> || <a onclick = "return confirm('Bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDNguoiDung'] ?>">Xóa</a></td>
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

