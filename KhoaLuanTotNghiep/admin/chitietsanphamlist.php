<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietsanpham.php' ?>
<?php
    $brand = new chitietsanpham();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi Tiết Size Của Sản Phẩm</h2>
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
							<th>Tên Sản Phẩm</th>
							<th>Tên Size</th>
							<th>Số Lượng</th>
							<th>Thao Tác</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_brand = $brand->show_chitiet();
						if($show_brand){
							$i = 0;
							while($result = $show_brand->fetch_assoc()){
								$i++;
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['TenSanPham'] ?></td>
							<td><?php echo $result['TenSize'] ?></td>
							<td><?php echo $result['SoLuong'] ?></td>
							<td><a href="chitietsanphamedit.php?brandid=<?php echo $result['IDChiTiet'] ?>">Thay Đổi</a> || <a onclick = "return confirm('bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDChiTiet'] ?>">Xóa</a></td>
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

