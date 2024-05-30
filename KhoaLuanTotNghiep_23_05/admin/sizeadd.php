<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/size.php' ?>
 <?php
    $brand = new size();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $TenSize = $_POST['TenSize'];
        
        // Kiểm tra nếu chuỗi chứa ký tự đặc biệt
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $TenSize)) {
            $insertBrand = $brand->insert_brand($TenSize);
        } else {
            $insertBrand = "Tên Size không được chứa ký tự đặc biệt.";
        }
    }
?> 
<?php  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Size</h2>
        <div class="block copyblock"> 
            <?php
            if(isset($insertBrand)){
                echo $insertBrand;
            }
            ?> 
            <form id="sizeForm" action="sizeadd.php" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Tên Size</label>
                        </td>
                        <td>
                            <input id="tenSizeInput" type="text" name="TenSize" placeholder="Nhập Size..." class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input id="saveButton" type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                    
                </table>
            </form>
            <div id="errorDiv" style="color: red;"></div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>
<script>
    document.getElementById("sizeForm").onsubmit = function() {
        var tenSize = document.getElementById("tenSizeInput").value;
        var regex = /[\'^£$%&*()}{@#~?><>,|=_+¬-]/;
        var sizeValue = parseInt(tenSize); // Chuyển đổi giá trị nhập vào thành số nguyên

        // Kiểm tra xem chuỗi nhập vào có chỉ chứa khoảng trắng hay không
        if (tenSize.trim() === '') {
            document.getElementById("errorDiv").innerHTML = "Tên Size không được để trống.";
            return false;
        }
        
        // Kiểm tra xem giá trị nhập vào có là số và nằm trong khoảng từ 30 đến 50 không
        if (isNaN(sizeValue) || sizeValue < 30 || sizeValue > 50 || regex.test(tenSize)) {
            document.getElementById("errorDiv").innerHTML = "Tên Size phải là số từ 30 đến 50 và không chứa ký tự đặc biệt.";
            return false;
        }
        return true;
    };
</script>
