<?php include 'inc/headernv.php';?>
<?php include 'inc/sidebarnv.php';?>
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
                        <th>Tổng Tiền</th>
                        <th>Xem Chi Tiết</th>
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
                        <td><?php echo number_format($result['ThanhTien'], 0, ',', '.') ?> VND</td>
                        <td><a href="hoadonshowdetail.php?id=<?php echo $result['IDHoaDon']; ?>"><button style="border-radius: 5px;">Chi Tiết Hóa Đơn</button></a></td>
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
</script>
