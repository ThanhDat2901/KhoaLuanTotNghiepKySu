<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/nguoidung.php' ?>
<?php include '../classes/quyen.php' ?>
<?php
   
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location ='brandlist.php'</script>";
    }else{
         $id = $_GET['brandid']; 
    }
     $brand = new nguoidung();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $TenNguoiDung = $_POST['TenNguoiDung'];
        $DiaChi = $_POST['DiaChi'];
        $SDT = $_POST['SDT'];
        $Email = $_POST['Email'];
        $MatKhau = $_POST['$1111'] ?? '';
        $updateBrand = $brand->update_brand1($TenNguoiDung,$DiaChi,$SDT,$Email,'$1111',$id);        
    }
?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thay Đổi Thông Tin Nhân Viên</h2>
                
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
                        <tr style="display:none;">
                            <td>
                                <label>Tên Người Dùng</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo htmlspecialchars($result['TenNguoiDung'], ENT_QUOTES, 'UTF-8'); ?>"  name="TenNguoiDung" id="usernameInput" placeholder="Thay đổi tên người dùng..." class="medium" />
                                <div id="usernameError" style="display: none; color: red;">Tên người dùng không được chứa ký tự số hoặc ký tự đặc biệt.</div>
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td>
                                <label>Địa Chỉ</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo $result['DiaChi'] ?>" name="DiaChi" placeholder="Thay đổi địa chỉ..." class="medium" />
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo htmlspecialchars($result['Email'], ENT_QUOTES, 'UTF-8'); ?>" name="Email" id="emailInput" placeholder="Thay đổi Email..." class="medium" />
                                 <div id="emailError" style="display: none; color: red;">Định dạng email không hợp lệ.</div>
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td>
                                <label>Số Điện Thoại</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="text" value="<?php echo htmlspecialchars($result['SDT'], ENT_QUOTES, 'UTF-8'); ?>" name="SDT" id="phoneInput" placeholder="Nhập số điện thoại..." class="medium" />
                                <div id="phoneError" style="display: none; color: red;">Số điện thoại không hợp lệ.</div>
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td>
                                <label>Mật Khẩu</label>
                            </td>
                            <td>
                                <input style="width: 300px;" type="password" value="<?php echo htmlspecialchars($result['MatKhau'], ENT_QUOTES, 'UTF-8'); ?>" name="MatKhau" id="passwordInput" placeholder="*****" class="medium" />
                                <div id="error" style="color: red;"></div>
                            </td>
                        </tr>
                        
						<tr> 
                            <td>
                                <input id="saveButton" type="submit" value="Đặt lại mật khẩu" />
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