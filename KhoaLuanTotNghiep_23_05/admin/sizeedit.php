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
        $updateBrand = $brand->update_brand($TenSize,$id);
        
    }

?>
<?php  ?>
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
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['TenSize'] ?>"name="TenSize" placeholder="Thay đổi size..." class="medium" oninput="validateInput(this)" />
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

        <script>
            function validateInput(input) {
                var regex = /^[a-zA-Z\s]+$/;

                var errorDiv = document.getElementById("errorDiv");

                if (!regex.test(input.value)) { // Nếu không phù hợp với biểu thức chính quy
                    errorDiv.innerHTML = "Vui lòng chỉ nhập chữ cái";
                    input.value = ""; // Xóa giá trị đã nhập
                    setTimeout(function() {
                        input.focus(); // Trở lại trường input
                    }, 1000); // Hiển thị thông báo lỗi trong 1 giây và sau đó tự động xóa đi
                    
                    // Vô hiệu hóa nút lưu
                    document.getElementById('saveButton').disabled = true;
                } else {
                    errorDiv.innerHTML = ""; // Xóa thông báo lỗi
                    // Kích hoạt nút lưu
                    document.getElementById('saveButton').disabled = false;
                }
            }
        </script>
<?php include 'inc/footer.php';?>