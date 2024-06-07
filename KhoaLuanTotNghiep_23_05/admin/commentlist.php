<?php include 'inc/headernv.php';?>
<?php include 'inc/sidebarnv.php';?>
<?php include '../classes/comment.php'; ?>
<?php
    $brand = new comment();
    if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delbrand = $brand->del_brand($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Comment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .star-rating {
            color: #ffcc00;
            font-size: 14px; /* Điều chỉnh kích thước ngôi sao tại đây */
        }
        .star-rating .fa-star-half-alt {
            color: #ffcc00;
        }
    </style>
</head>
<body>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Danh Sách Comment</h2>
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
                        <th>Tên Sản Phẩm</th>
                        <th>Số Sao</th>
                        <th>Nội Dung</th>
                        <th>Đánh Giá</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $show_brand = $brand->show_comment();
                    if($show_brand){
                        $i = 0;
                        while($result = $show_brand->fetch_assoc()){
                            $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['TenNguoiDung'] ?></td>
                        <td><?php echo $result['TenSanPham'] ?></td>
                        <td class="star-rating"><?php echo displayStars($result['Rate']); ?></td>
                        <td><?php echo $result['NoiDung'] ?></td>
                        <td><?php echo $result['DanhGia'] ?></td>
                        <td><a onclick="return confirm('bạn có muốn xóa ?')" href="?delid=<?php echo $result['IDComment'] ?>">Xóa</a></td>
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
</body>
</html>

<?php
function displayStars($rate) {
    $fullStars = floor($rate);
    $halfStar = $rate - $fullStars;
    $stars = '';

    for ($i = 0; $i < $fullStars; $i++) {
        $stars .= '<i class="fas fa-star"></i>';
    }
    if ($halfStar >= 0.5) {
        $stars .= '<i class="fas fa-star-half-alt"></i>';
    }

    return $stars;
}
?>
