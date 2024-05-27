<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitietmausac.php' ?>

<?php
    // Check if brandid is set and not NULL
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        // Redirect to brandlist.php if brandid is not set or NULL
        echo "<script>window.location ='brandlist.php'</script>";
    } else {
        // Get the brandid
        $id = $_GET['brandid'];
    }
    
    $brand = new chitietmausac();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the submitted data
        $IDMau = $_POST['IDMau'];
        $IDSanPham = $_POST['IDSanPham'];
        
        // Check if the product is already associated with the product set
        $isProductInSet = $brand->check_existing_product($IDMau, $IDSanPham);
        
        if($isProductInSet) {
            // Product is already in the set, display an appropriate message
            $updateBrand = "<span style='color: red;'>Sản phẩm đang tồn tại trong bộ sản phẩm này.</span>";
        } else {
            // Product is not in the set, proceed with the update
            $updateBrand = $brand->update_brand($IDMau,$IDSanPham,$id);
        }
    }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Màu Sắc Của Sản Phẩm</h2>
        <div class="block copyblock"> 
            <?php
            // Display the update message
            if(isset($updateBrand)){
                echo $updateBrand;
            }
            ?>
            
            <?php
                // Fetch the brand details
                $get_brand_name = $brand->getbrandbyId($id);
                if($get_brand_name){
                    while($result = $get_brand_name->fetch_assoc()){
            ?>
            
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Màu</label>
                        </td>
                        <td>
                        <select style="width: 310px;" id="select" name="IDMau" onchange="changeColor()">
                                <?php
                                // Fetch and display product set names
                                $cat = new chitietmausac();
                                $catlist = $cat->show_bosanpham_by_name();

                                if($catlist){
                                    while($result1 = $catlist->fetch_assoc()){
                                        ?>
                                        <option <?php if($result1['IDMau']==$result['CTIDMau']){ echo 'selected'; } ?> value="<?php echo $result1['IDMau'] ?>"><?php echo $result1['TenMau'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Màu Sắc</label>
                        </td>
                        <td>
                        <div id="colorBox" style="width: 30px; height: 30px; border: 1px solid black;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tên Sản Phẩm</label>
                        </td>
                        <td>
                            <select style="width: 310px;" id="select" name="IDSanPham">
                                <option>--------Chọn Sản Phẩm--------</option>
                                <?php
                                // Fetch and display product names
                                $cat = new chitietmausac();
                                $catlist = $cat->show_sanpham_by_name();

                                if($catlist){
                                    while($result2 = $catlist->fetch_assoc()){
                                ?>
                                <option <?php if($result2['IDSanPham']==$result['CTIDSanPham']){ echo 'selected'; } ?> value="<?php echo $result2['IDSanPham'] ?>"><?php echo $result2['TenSanPham'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php
                    }
                }
            ?>
            
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>
<script type="text/javascript">
    function validateForm() {
        var IDBo = document.getElementById('IDMau').value;
        var IDSanPham = document.getElementById('IDSanPham').value;
        if (IDBo == '' || IDSanPham == '') {
            alert("Vui lòng chọn Màu Sắc và Sản Phẩm cần thêm.");
            return false;
        }
        return true;
    }
   // Đối tượng ánh xạ tên màu sang mã HEX
   function changeColor() {
        var selectBox = document.getElementById("select");
        var colorBox = document.getElementById("colorBox");
        var selectedColor = selectBox.options[selectBox.selectedIndex].text;

        // Tạo một mảng chứa các đối tượng màu và tên
        var colorMap = [
                    { code: '#FF5733', name: 'Cam Đỏ' },
                    { code: '#33FF57', name: 'Xanh Lá Vàng' },
                    { code: '#3357FF', name: 'Xanh Dương' },
                    { code: '#F1C40F', name: 'Vàng' },
                    { code: '#8E44AD', name: 'Tím' },
                    { code: '#1ABC9C', name: 'Xanh Lam Nhạt' },
                    { code: '#2ECC71', name: 'Xanh Lá Cây' },
                    { code: '#E74C3C', name: 'Đỏ' },
                    { code: '#3498DB', name: 'Xanh Da Trời' },
                    { code: '#34495E', name: 'Xanh Đậm' },
                    { code: '#FFFFFF', name: 'Trắng' },
                    { code: '#000000', name: 'Đen' },
                    { code: '#808080', name: 'Xám' },
                    { code: '#FF0000', name: 'Đỏ Sáng' },
                    { code: '#00FF00', name: 'Xanh Lá Sáng' },
                    { code: '#0000FF', name: 'Xanh Dương Sáng' },
                    { code: '#FFFF00', name: 'Vàng Sáng' },
                    { code: '#FFA500', name: 'Cam Sáng' },
                    { code: '#800080', name: 'Tím Sáng' },
                    { code: '#00FFFF', name: 'Xanh Lam Sáng' },
                    { code: '#FFC0CB', name: 'Hồng Sáng' },
                    { code: '#800000', name: 'Nâu Sáng' },
                    { code: '#808000', name: 'Óc Chó Sáng' },
                    { code: '#008080', name: 'Xanh Da Trời Sáng' },
                    { code: '#000080', name: 'Xanh Dương Sáng' },
                    { code: '#FFD700', name: 'Vàng Rực' },
                    { code: '#ADFF2F', name: 'Xanh Lá Vàng Sáng' },
                    { code: '#FF69B4', name: 'Hồng Nóng' },
                    { code: '#CD5C5C', name: 'Đỏ Gạch' },
                    { code: '#4B0082', name: 'Xanh Lơ Sáng' },
                    { code: '#7FFF00', name: 'Vàng Lục Sáng' },
                    { code: '#D2691E', name: 'Sôcôla Sáng' },
                    { code: '#DC143C', name: 'Màu Máu Sáng' },
                    { code: '#00CED1', name: 'Xanh Lam Đậm' },
                    { code: '#FF4500', name: 'Đỏ Cam Sáng' },
                    { code: '#DA70D6', name: 'Hồng Dã Quỳ Sáng' },
                    { code: '#B0E0E6', name: 'Xanh Bảo Ngọc Sáng' },
                    { code: '#6A5ACD', name: 'Xanh Lam Đậm Sáng' },
                    { code: '#98FB98', name: 'Xanh Lục Nhạt Sáng' },
                    { code: '#AFEEEE', name: 'Xanh Lam Nhạt Sáng' },
                    { code: '#DB7093', name: 'Hồng Tím Nhạt Sáng' },
                    { code: '#FFE4E1', name: 'Hồng Phấn Sáng' },
                    { code: '#4682B4', name: 'Xanh Thép Sáng' },
                    { code: '#D2B48C', name: 'Màu Da Sáng' },
                    { code: '#FFB6C1', name: 'Hồng Nhạt Sáng' },
                    { code: '#20B2AA', name: 'Xanh Biển Nhạt Sáng' },
                    { code: '#778899', name: 'Xám Lam Nhạt Sáng' },
                    { code: '#B22222', name: 'Gạch Lửa Sáng' },
                    { code: '#228B22', name: 'Xanh Rừng Sáng' },
                    { code: '#FF6347', name: 'Cà Chua Sáng' },
                    { code: '#FF7F50', name: 'San Hô Sáng' },
                    { code: '#5F9EA0', name: 'Xanh Dương Phục Hồi Sáng' },
                    { code: '#7B68EE', name: 'Xanh Lam Trung Bình Sáng' },
                    { code: '#9ACD32', name: 'Xanh Lá Vàng Sáng' },
                    { code: '#2E8B57', name: 'Xanh Biển Sáng' },
                    { code: '#EE82EE', name: 'Tím Sáng' },
                    { code: '#F08080', name: 'Hồng Nhạt Sáng' },
                    { code: '#8A2BE2', name: 'Tím Xanh Sáng' },
                    { code: '#7CFC00', name: 'Xanh Lục Cỏ Sáng' },
                    { code: '#40E0D0', name: 'Xanh Lơ Nhạt Sáng' },
                    { code: '#8B0000', name: 'Đỏ Đậm Sáng' },
                    { code: '#BA55D3', name: 'Hồng Đậm Sáng' },
                    { code: '#7FFFD4', name: 'Xanh Biển Sáng' },
                    { code: '#D8BFD8', name: 'Hoa Cải Sáng' },
                    { code: '#FFE4B5', name: 'Da Lừa Sáng' },
                    { code: '#A52A2A', name: 'Nâu Sáng' },
                    { code: '#8FBC8F', name: 'Xanh Lục Biển Đậm Sáng' },
                    { code: '#FFFACD', name: 'Vàng Chanh Sáng' },
                    { code: '#FA8072', name: 'Salmon Sáng' },
                    { code: '#D3D3D3', name: 'Xám Nhạt Sáng' }
        ];

        // Duyệt qua mảng colorMap để tìm màu tương ứng với tên đã chọn
        for (var i = 0; i < colorMap.length; i++) {
            if (colorMap[i].name === selectedColor) {
                // Thiết lập màu nền của ô vuông bằng mã màu tương ứng
                colorBox.style.backgroundColor = colorMap[i].code;
                break;
            }
        }
    }
</script>

