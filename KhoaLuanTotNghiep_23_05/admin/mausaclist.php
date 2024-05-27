<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/mausac.php' ?>
<?php
    $brand = new mausac();
    if (isset($_GET['delid'])) {
        $id = $_GET['delid'];
        $delbrand = $brand->del_brand($id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh Sách Màu Sắc</h2>
        <div class="block">    
        <?php
        if (isset($delbrand)) {
            echo $delbrand;
        }
        ?>    
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Số Thứ Tự</th>
                        <th>Tên Màu</th>
                        <th>Màu</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $show_brand = $brand->show_brand();
                    if ($show_brand) {
                        $i = 0;
                        while ($result = $show_brand->fetch_assoc()) {
                            $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['TenMau'] ?></td>
                        <td><div style="width: 20px; height: 20px; background-color: <?php echo $result['MaMau']; ?>; border: 1px solid black;"></div></td>
                        <td><a href="mausacedit.php?brandid=<?php echo $result['IDMau'] ?>">Thay Đổi</a> || <a onclick="return confirm('bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDMau'] ?>">Xóa</a></td>
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

<style>
    .color-box {
        width: 30px;
        height: 30px;
        border: 1px solid #ccc;
        display: inline-block;
    }
</style>
