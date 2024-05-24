<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/km.php' ?>
<?php
   
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location ='brandlist.php'</script>";
    }else{
         $id = $_GET['brandid']; 
    }
     $brand = new km();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $TenKhuyenMai = $_POST['TenKhuyenMai'];
        $TienKhuyenMai = $_POST['TienKhuyenMai'];
        $NgayBatDau = $_POST['NgayBatDau'];
        $NgayKetThuc = $_POST['NgayKetThuc'];

        // Kiểm tra nếu ngày bắt đầu nhỏ hơn ngày hiện tại, không cho phép insert
        if(strtotime($NgayBatDau) < strtotime(date('Y-m-d'))) {
            $updateBrand = "Ngày bắt đầu không thể nhỏ hơn ngày hiện tại!";
        } elseif(strtotime($NgayKetThuc) < strtotime($NgayBatDau)) {
            $updateBrand = "Ngày kết thúc không thể nhỏ hơn ngày bắt đầu!";
        } else {
            $updateBrand = $brand->update_brand($TenKhuyenMai,$TienKhuyenMai,$NgayBatDau,$NgayKetThuc,$id);
        }
    }
?>
<?php  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Khuyến Mãi</h2>

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
                            <label>Tên Khuyến Mãi</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['TenKhuyenMai'] ?>" name="TenKhuyenMai" placeholder="Thay đổi tên Khuyến Mãi..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Khuyến Mãi (%)</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['TienKhuyenMai'] ?>" name="TienKhuyenMai" placeholder="Thay đổi tiền Khuyến Mãi..." class="medium" id="TienKhuyenMai" />                                
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ngày Bắt Đầu</label>
                        </td>
                        <td>
                            <input type="date" value="<?php echo $result['NgayBatDau'] ?>" name="NgayBatDau" placeholder="Ngày bắt đầu..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ngày Kết Thúc</label>
                        </td>
                        <td>
                            <input type="date" value="<?php echo $result['NgayKetThuc'] ?>" name="NgayKetThuc" placeholder="Ngày hết hạn.." class="medium" />
                        </td>
                    </tr>
					<tr> 
                        <td>
                            <input  id="save-button" disabled type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
            <div id="error-message" style="display: none; color: red;"></div>
                   
            <?php
            }
        }                
            ?>

        </div>
    </div>
</div>
<script>
    document.getElementById("TienKhuyenMai").addEventListener("input", function() {
        var input = this.value.trim();
        var errorMessage = document.getElementById("error-message");

        // Kiểm tra nếu dữ liệu nhập vào không phải là số hoặc vượt quá 100
        if (isNaN(input) || input < 1 || input > 99) {
            errorMessage.textContent = "Nhập số từ 1 đến 99.";
            errorMessage.style.display = "block";
            document.getElementById("save-button").disabled = true; // Vô hiệu hóa nút lưu
        } else {
            errorMessage.style.display = "none";
            document.getElementById("save-button").disabled = false; // Kích hoạt lại nút lưu
        }
    });

    // Kiểm tra khi nhập ngày bắt đầu, không được nhỏ hơn ngày hiện tại
    document.querySelector('input[name="NgayBatDau"]').addEventListener('change', function() {
        var selectedDate = new Date(this.value);
        var today = new Date();

        if(selectedDate < today) {
            alert("Ngày bắt đầu không thể nhỏ hơn ngày hiện tại!");
            this.value = ''; // Xóa giá trị đã nhập
        }
    });

    // Kiểm tra khi nhập ngày kết thúc, không được nhỏ hơn ngày bắt đầu
    document.querySelector('input[name="NgayKetThuc"]').addEventListener('change', function() {
        var endDate = new Date(this.value);
        var startDate = new Date(document.querySelector('input[name="NgayBatDau"]').value);

        if(endDate < startDate) {
            alert("Ngày kết thúc không thể nhỏ hơn ngày bắt đầu!");
            this.value = ''; // Xóa giá trị đã nhập
        }
    });
</script>
<?php include 'inc/footer.php';?>