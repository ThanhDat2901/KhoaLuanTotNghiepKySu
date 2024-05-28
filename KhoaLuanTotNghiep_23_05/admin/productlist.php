<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/bosanpham.php';?>
<?php include '../classes/bosuutap.php';?>
<?php include '../classes/loai.php';?>
<?php include '../classes/km.php';?>
<?php include '../classes/size.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
        $id = $_GET['productid']; 
        $delpro = $pd->del_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh Sách Sản Phẩm</h2>
        <div class="block"> 
        <?php
        if(isset($delpro)){
        	echo $delpro;
        }
        ?> 
        	
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên Sản Phẩm</th>
					<th>Mô Tả</th>
					<th>Giá Ban Đầu</th>
					<th>Giá Sau Khuyến Mãi</th>
					<th>Loại Sản Phẩm</th>
					<th>Tên Khuyến Mãi</th>
					<th>Hình Ảnh</th>
					<th>Màu Sắc</th>
					<th>Kiểu Sản Phẩm</th>
					<th>Thao Tác</th>
				</tr>
			</thead>
			<tbody>
				<?php
			
				$pdlist = $pd->show_product();
				if($pdlist){
					$i = 0;
					while($result = $pdlist->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $fm->textShorten($result['TenSanPham'], 20) ?></td>
					<td><?php echo $fm->textShorten($result['ThongTin'], 40) ?></td>
					<td><?php echo $result['GiaDau'] ?></td>
					<td><?php echo $result['GiaCuoi'] ?></td>
					<td><?php echo $result['TenLoai'] ?></td>
					<td><?php echo $result['TenKhuyenMai'] ?></td>
					<!-- <td><img src="uploads/<?php echo $result['HinhAnh'] ?>" width="80"></td> -->
					<td><img src="<?php echo $result['HinhAnh'] ?>"  width="80"></td>
					<td><div style="width: 20px; height: 20px; background-color: <?php echo $result['MaMau']; ?>; border: 1px solid black;"></div></td>
					<td><?php 
						if($result['type']==0){
							echo 'Nổi Bật';
						}else{
							echo 'Không Nổi Bật';
						}
					?></td>
					<td><a href="productedit.php?productid=<?php echo $result['IDSanPham'] ?>">Thay Đổi</a> || <a href="?productid=<?php echo $result['IDSanPham'] ?>">Xóa</a></td>
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
