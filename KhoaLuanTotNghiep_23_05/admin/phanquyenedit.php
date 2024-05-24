<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/quyen.php' ?>
<?php include '../classes/phanquyen.php' ?>
<?php include '../classes/nguoidung.php' ?>
<?php
   
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location ='brandlist.php'</script>";
    }else{
         $id = $_GET['brandid']; 
    }
     $brand = new phanquyen();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $IDQuyen = $_POST['IDQuyen'];
        $IDNguoiDung = $_POST['IDNguoiDung'];
        $updateBrand = $brand->update_brand($IDQuyen,$IDNguoiDung,$id);
        
    }

?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thay Đổi Quyền Tài Khoản</h2>
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
                 <form action="" method="post" onsubmit="return validateForm()">
                    <table class="form">	
                    <tr>
                            <td>
                                <label>Tên Người Dùng</label>
                            </td>
                            <td>
                                <select style="width: 310px;" id="select" name="IDNguoiDung">
                                    <option>--------Chọn Người Dùng--------</option>
                                    <?php
                                    $cat = new nguoidung();
                                    $catlist = $cat->show_nguoidung_by_name();

                                    if($catlist){
                                        while($result2 = $catlist->fetch_assoc()){
                                    ?>

                                    <option
                                    <?php
                                    if($result2['IDNguoiDung']==$result['IDNguoiDung']){ echo 'selected';  }
                                    ?>

                                    value="<?php echo $result2['IDNguoiDung'] ?>"><?php echo $result2['TenNguoiDung'] ?></option>

                                    <?php
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                    <tr>
                            <td>
                                <label>Quyền</label>
                            </td>
                            <td>
                                <select style="width: 310px;" id="select" name="IDQuyen">
                                    <option>--------Chọn Quyền Cho Tài Khoản--------</option>
                                    <?php
                                    $cat = new quyen();
                                    $catlist = $cat->show_brand();

                                    if($catlist){
                                        while($result3 = $catlist->fetch_assoc()){
                                    ?>

                                    <option
                                    <?php
                                    if($result3['IDQuyen']==$result['IDQuyen']){ echo 'selected';  }
                                    ?>

                                    value="<?php echo $result3['IDQuyen'] ?>"><?php echo $result3['TenQuyen'] ?></option>

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
        <script>
                function validateForm() {
                    var selectNguoiDung = document.getElementById("selectNguoiDung");
                    var selectQuyen = document.getElementById("selectQuyen");
                    var submitButton = document.getElementById("submitButton");

                    // Kiểm tra xem đã chọn tên người dùng và tên quyền chưa
                    if (selectNguoiDung.value === "--------Chọn Người Dùng-------" || selectQuyen.value === "--------Chọn Quyền-------") {
                        alert("Vui lòng chọn tên người dùng và tên quyền trước khi lưu!");
                        return false;
                    }
                }
    </script>
<?php include 'inc/footer.php';?>