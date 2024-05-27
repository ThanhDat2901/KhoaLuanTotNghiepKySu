<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/mausac.php' ?>
<?php
   
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location ='brandlist.php'</script>";
    }else{
         $id = $_GET['brandid']; 
    }
     $brand = new mausac();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $TenMau = $_POST['TenMau'];
        $MaMau = $_POST['MaMau'];
        $updateBrand = $brand->update_brand($TenMau,$MaMau,$id);
        
    }

?>
<?php  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Màu</h2>
        <div class="block copyblock"> 
            <?php
            if(isset($updateBrand)){
                echo $updateBrand;
            }
            ?>
            <?php
                $get_brand_name = $brand->getbrandbyId($id);
                if($get_brand_name){
                    while($result = $get_brand_name->fetch_assoc()){
            ?>
             <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" id="tenMauInput" value="<?php echo $result['TenMau'] ?>" name="TenMau" class="medium" readonly  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Thẻ input để hiển thị mã màu -->
                            <input type="text" id="maMauInput" name="MaMau" value="<?php echo $result['MaMau'] ?>" readonly class="medium" readonly />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Bảng màu -->
                            <div id="colorTable"></div>
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
    window.onload = function() {
        const colorTable = document.getElementById('colorTable');
        const maMauInput = document.getElementById('maMauInput');
        const tenMauInput = document.getElementById('tenMauInput');
        
        // Mảng màu mẫu
        const colors =[
        
        { code: '#000000', name: 'Đen' },
        { code: '#000080', name: 'Xanh Dương Sáng' },
        { code: '#0000FF', name: 'Xanh Dương' },
        { code: '#006400', name: 'Xanh Lá Đậm Sáng' },
        { code: '#008000', name: 'Xanh Lá Sáng' },
        { code: '#008080', name: 'Xanh Da Trời Sáng' },
        { code: '#00CED1', name: 'Xanh Lam Đậm' },
        { code: '#00FA9A', name: 'Xanh Lá Đậm Sáng' },
        { code: '#00FF00', name: 'Xanh Lá' },
        { code: '#00FF7F', name: 'Xanh Lục Sáng' },
        { code: '#00FFFF', name: 'Xanh Lam Sáng' },
        { code: '#00FFFF', name: 'Xanh Biển Sáng' },
        { code: '#191970', name: 'Xanh Đậm Sáng' },
        { code: '#1E90FF', name: 'Xanh Dương Nhạt Sáng' },
        { code: '#20B2AA', name: 'Xanh Biển Nhạt Sáng' },
        { code: '#228B22', name: 'Xanh Rừng Sáng' },
        { code: '#2E8B57', name: 'Xanh Biển Sáng' },
        { code: '#2E8B57', name: 'Xanh Biển' },
        { code: '#2F4F4F', name: 'Xám Dương Sáng' },
        { code: '#2F4F4F', name: 'Xám Lam Sáng' },
        { code: '#32CD32', name: 'Xanh Lá' },
        { code: '#3CB371', name: 'Xanh Lá Đậm' },
        { code: '#40E0D0', name: 'Xanh Lơ Nhạt Sáng' },
        { code: '#4169E1', name: 'Xanh Dương Đậm Sáng' },
        { code: '#4682B4', name: 'Xanh Thép Sáng' },
        { code: '#483D8B', name: 'Xanh Lơ Đậm Sáng' },
        { code: '#48D1CC', name: 'Xanh Lơ Đậm' },
        { code: '#4B0082', name: 'Xanh Lơ Sáng' },
        { code: '#556B2F', name: 'Xanh Lá Vàng Đậm Sáng' },
        { code: '#5F9EA0', name: 'Xanh Dương Phục Hồi Sáng' },
        { code: '#6495ED', name: 'Xanh Dương Nhạt Đậm Sáng' },
        { code: '#663399', name: 'Tím Đậm Sáng' },
        { code: '#66CDAA', name: 'Xanh Lơ Đậm Sáng' },
        { code: '#696969', name: 'Xám Đậm Sáng' },
        { code: '#6A5ACD', name: 'Xanh Lam Đậm Sáng' },
        { code: '#6B8E23', name: 'Xanh Lá Vàng Đậm' },
        { code: '#708090', name: 'Xám Đậm' },
        { code: '#778899', name: 'Xám Lam Nhạt Sáng' },
        { code: '#7B68EE', name: 'Xanh Lam Trung Bình Sáng' },
        { code: '#7CFC00', name: 'Xanh Lục Cỏ Sáng' },
        { code: '#7FFF00', name: 'Vàng Lục Sáng' },
        { code: '#800000', name: 'Nâu Sáng' },
        { code: '#800080', name: 'Tím Sáng' },
        { code: '#808000', name: 'Óc Chó Sáng' },
        { code: '#808080', name: 'Xám' },
        { code: '#87CEEB', name: 'Xanh Lơ Nhạt Sáng' },
        { code: '#87CEFA', name: 'Xanh Lơ Nhạt Đậm Sáng' },
        { code: '#8A2BE2', name: 'Tím Xanh Sáng' },
        { code: '#8B0000', name: 'Đỏ Đậm Sáng' },
        { code: '#8B4513', name: 'Nâu Đậm Sáng' },
        { code: '#8FBC8F', name: 'Xanh Lục Biển Đậm Sáng' },
        { code: '#90EE90', name: 'Xanh Lục Nhạt Sáng' },
        { code: '#9370DB', name: 'Tím Nhạt Sáng' },
        { code: '#9400D3', name: 'Tím Đậm Sáng' },
        { code: '#98FB98', name: 'Xanh Lục Nhạt Sáng' },
        { code: '#9932CC', name: 'Tím Đậm Đậm Sáng' },
        { code: '#9ACD32', name: 'Xanh Lá Vàng Sáng' },
        { code: '#A0522D', name: 'Nâu Đậm Sáng' },
        { code: '#A52A2A', name: 'Nâu Sáng' },
        { code: '#A9A9A9', name: 'Xám Đậm Đậm Sáng' },
        { code: '#ADD8E6', name: 'Xanh Lam Nhạt Đậm Sáng' },
        { code: '#ADFF2F', name: 'Xanh Lá Vàng Sáng' },
        { code: '#AFEEEE', name: 'Xanh Lam Nhạt Sáng' },
        { code: '#B0C4DE', name: 'Xanh Lam Nhạt Đậm Sáng' },
        { code: '#B0E0E6', name: 'Xanh Bảo Ngọc Sáng' },
        { code: '#B22222', name: 'Gạch Lửa Sáng' },
        { code: '#B8860B', name: 'Nâu Đậm Đậm Sáng' },
        { code: '#BA55D3', name: 'Hồng Đậm Sáng' },
        { code: '#BC8F8F', name: 'Nâu Sáng Đậm Sáng' },
        { code: '#BDB76B', name: 'Nâu Lục Sáng' },
        { code: '#C0C0C0', name: 'Bạc Sáng' },
        { code: '#C71585', name: 'Đỏ Hồng Đậm Sáng' },
        { code: '#CD5C5C', name: 'Đỏ Gạch' },
        { code: '#CD853F', name: 'Nâu Đậm Đậm Sáng' },
        { code: '#D2691E', name: 'Sôcôla Sáng' },
        { code: '#D2B48C', name: 'Màu Da Sáng' },
        { code: '#D3D3D3', name: 'Xám Nhạt Sáng' },
        { code: '#D8BFD8', name: 'Hoa Cải Sáng' },
        { code: '#DA70D6', name: 'Hồng Dã Quỳ Sáng' },
        { code: '#DB7093', name: 'Hồng Tím Nhạt Sáng' },
        { code: '#DC143C', name: 'Màu Máu Sáng' },
        { code: '#DDA0DD', name: 'Hồng Tím Đậm Sáng' },
        { code: '#DEB887', name: 'Nâu Sáng Đậm' },
        { code: '#E0FFFF', name: 'Xanh Lam Đậm Đậm Sáng' },
        { code: '#E6E6FA', name: 'Lavender Sáng' },
        { code: '#E9967A', name: 'Đỏ Tươi Sáng' },
        { code: '#EE82EE', name: 'Tím Sáng' },
        { code: '#EEE8AA', name: 'Màu Bơ Sáng' },
        { code: '#F08080', name: 'Hồng Nhạt Sáng' },
        { code: '#F0E68C', name: 'Da Lừa Sáng' },
        { code: '#F0F8FF', name: 'Xanh Lam Đậm Nhạt Sáng' },
        { code: '#F0FFF0', name: 'Nha Đam Sáng' },
        { code: '#F0FFFF', name: 'Trắng Sáng' },
        { code: '#F4A460', name: 'Nâu Đậm Đậm Sáng' },
        { code: '#F5DEB3', name: 'Da Lừa Sáng Đậm Sáng' },
        { code: '#F5F5DC', name: 'Màu Kem Sáng' },
        { code: '#F5F5F5', name: 'Xám Nhạt Sáng' },
        { code: '#F5FFFA', name: 'Menta Sáng' },
        { code: '#F8F8FF', name: 'Ghost White Sáng' },
        { code: '#FA8072', name: 'Salmon Sáng' },
        { code: '#FAEBD7', name: 'Da Cam Sáng' },
        { code: '#FAF0E6', name: 'Lavender Sáng Đậm Sáng' },
        { code: '#FAFAD2', name: 'Vàng Đậm Sáng' },
        { code: '#FDF5E6', name: 'Da Cam Sáng Đậm Sáng' },
        { code: '#FF0000', name: 'Đỏ Sáng' },
        { code: '#FF00FF', name: 'Hồng Sáng' },
        { code: '#FF00FF', name: 'Tím Sáng' },
        { code: '#FF1493', name: 'Hồng Nhạt Sáng' },
        { code: '#FF4500', name: 'Đỏ Cam Sáng' },
        { code: '#FF6347', name: 'Cà Chua Sáng' },
        { code: '#FF69B4', name: 'Hồng Nóng' },
        { code: '#FF7F50', name: 'San Hô Sáng' },
        { code: '#FF8C00', name: 'Cam Đậm Sáng' },
        { code: '#FFA07A', name: 'Đỏ Hồng Sáng' },
        { code: '#FFA500', name: 'Cam Sáng' },
        { code: '#FFB6C1', name: 'Hồng Nhạt Sáng' },
        { code: '#FFC0CB', name: 'Hồng Sáng' },
        { code: '#FFD700', name: 'Vàng Rực' },
        { code: '#FFDAB9', name: 'Peach Puff Sáng' },
        { code: '#FFDEAD', name: 'Nâu Cam Sáng' },
        { code: '#FFE4B5', name: 'Da Lừa Sáng' },
        { code: '#FFE4C4', name: 'Kem Sáng' },
        { code: '#FFE4E1', name: 'Hồng Phấn Sáng' },
        { code: '#FFEBCD', name: 'Almond Sáng' },
        { code: '#FFEFD5', name: 'Da Cam Sáng Nhạt Sáng' },
        { code: '#FFF0F5', name: 'Lavender Blush Sáng' },
        { code: '#FFF5EE', name: 'Sea Shell Sáng' },
        { code: '#FFF8DC', name: 'Corn Silk Sáng' },
        { code: '#FFFACD', name: 'Vàng Chanh Sáng' },
        { code: '#FFFAF0', name: 'Nha Đam Sáng' },
        { code: '#FFFAFA', name: 'Bông Gòn Sáng' },
        { code: '#FFFF00', name: 'Vàng Sáng' },
        { code: '#FFFFE0', name: 'Ivory Sáng' },
        { code: '#FFFFF0', name: 'Mật Ong Sáng' },
        { code: '#FFFFFF', name: 'Trắng' }
    ];
        
        // Hiển thị bảng màu
        colors.forEach(color => {
            const colorBox = document.createElement('div');
            colorBox.className = 'color-box';
            colorBox.style.backgroundColor = color.code;
            colorBox.onclick = function() {
                maMauInput.value = color.code;
                tenMauInput.value = color.name;
            }
            colorTable.appendChild(colorBox);
        });
    }
</script>

<style>
    .color-box {
        width: 20px;
        height: 20px;
        display: inline-block;
        margin: 5px;
        cursor: pointer;
        border: 1px solid #ccc;
    }
    #colorTable {
        margin-top: 10px;
    }
    
</style>
