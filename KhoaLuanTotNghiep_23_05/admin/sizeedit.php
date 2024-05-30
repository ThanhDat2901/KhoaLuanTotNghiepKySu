<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/size.php' ?>

<?php
   
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location ='brandlist.php'</script>";
    }else{
         $id = $_GET['brandid']; 
    }
     $brand = new size();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $TenSize = $_POST['TenSize'];
        // Kiểm tra nếu chuỗi chứa ký tự đặc biệt
        if (!preg_match('/^[A-Za-z0-9\s]+$/', $TenSize)) {
            echo "<script>alert('Chỉ được phép nhập chữ cái, số và khoảng trắng.');</script>";
        } else {
            $updateBrand = $brand->update_brand($TenSize,$id);
        }
        
    }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay Đổi Size</h2>

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
            <form id="sizeForm" action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['TenSize'] ?>" name="TenSize" placeholder="Thay đổi size..." class="medium" />
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
            <?php
            }
        }
            ?>

        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>

<script>
    document.getElementById("sizeForm").addEventListener("submit", function(event) {
        var TenSize = document.getElementsByName("TenSize")[0].value;
        // Kiểm tra xem chuỗi có chứa ký tự đặc biệt hay không
        if (!/^[A-Za-z0-9\s]+$/.test(TenSize)) {
            document.getElementById("errorDiv").innerHTML = "Chỉ được phép nhập chữ cái, số và khoảng trắng.";
            event.preventDefault(); // Ngăn form được gửi đi
        }
    });
</script>
