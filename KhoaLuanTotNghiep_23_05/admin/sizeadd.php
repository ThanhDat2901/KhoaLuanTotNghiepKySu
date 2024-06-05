<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/size.php' ?>
<?php
    $brand = new size();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $TenSize = $_POST['TenSize'];
        
        // Kiểm tra nếu chuỗi chỉ chứa chữ cái in hoa hoặc số
        if (preg_match('/^[A-Z]+$/', $TenSize)) {
            $insertBrand = $brand->insert_brand($TenSize);
        } elseif (preg_match('/^[0-9]+$/', $TenSize)) {
            $sizeValue = intval($TenSize);
            if ($sizeValue >= 30 && $sizeValue <= 50) {
                $insertBrand = $brand->insert_brand($TenSize);
            } else {
                $insertBrand = "Tên Size phải là số từ 30 đến 50.";
            }
        } else {
            $insertBrand = "Tên Size chỉ chứa chữ cái in hoa hoặc số.";
        }
    }
?>
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
        var letterRegex = /^[A-Z]+$/;
        var numberRegex = /^[0-9]+$/;
        var sizeValue = parseInt(tenSize); // Chuyển đổi giá trị nhập vào thành số nguyên

        // Kiểm tra xem chuỗi nhập vào có chỉ chứa khoảng trắng hay không
        if (tenSize.trim() === '') {
            document.getElementById("errorDiv").innerHTML = "Tên Size không được để trống.";
            return false;
        }
        
        // Kiểm tra xem giá trị nhập vào có chỉ chứa chữ cái in hoa hoặc số
        if (letterRegex.test(tenSize)) {
            return true;
        } else if (numberRegex.test(tenSize) && sizeValue >= 30 && sizeValue <= 50) {
            return true;
        } else {
            document.getElementById("errorDiv").innerHTML = "Tên Size phải là chữ cái in hoa hoặc số từ 30 đến 50.";
            return false;
        }
    };
</script>
