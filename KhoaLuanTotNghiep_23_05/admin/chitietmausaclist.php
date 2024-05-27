<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietmausac.php' ?>
<?php
    $brand = new chitietmausac();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi Tiết Màu Sắc Của Sản Phẩm</h2>
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
							<th>Tên Màu</th>
                            <th>Màu Sắc</th> <!-- Thêm cột mới -->
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
							<td><?php echo $result['TenMau'] ?></td>
                            <td><div style="width: 20px; height: 20px; background-color: <?php echo $result['MaMau']; ?>; border: 1px solid black;"></div></td>
							<td><a href="chitietmausacedit.php?brandid=<?php echo $result['IDMauSanPham'] ?>">Thay Đổi</a> || <a onclick = "return confirm('bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDMauSanPham'] ?>">Xóa</a></td>
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
