<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/bosanpham.php' ?>
<?php
    $brand = new brand();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh Sách Bộ Sản Phẩm</h2>
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
							<th>Tên Bộ Sản Phẩm</th>
							<th>Thao Tác</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$show_brand = $brand->show_brand();
						if($show_brand){
							$i = 0;
							while($result = $show_brand->fetch_assoc()){
								$i++;
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['TenBo'] ?></td>
							<td><a href="bosanphamedit.php?brandid=<?php echo $result['IDBo'] ?>">Thay Đổi</a> || <a onclick = "return confirm('bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDBo'] ?>">Xóa</a></td>
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

