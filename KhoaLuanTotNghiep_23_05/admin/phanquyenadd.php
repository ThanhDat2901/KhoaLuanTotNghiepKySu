<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/phanquyen.php' ?>
<?php include '../classes/quyen.php' ?>
<?php include '../classes/nguoidung.php' ?>
 <?php
    $brand = new phanquyen();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $IDQuyen = $_POST['IDQuyen'];
        $IDNguoiDung = $_POST['IDNguoiDung'];
        $insertBrand = $brand->insert_brand($IDQuyen,$IDNguoiDung);
        
    }
?> 
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Phân Quyền Cho Tài Khoản</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($insertBrand)){
                    echo $insertBrand;
                }
                ?> 
                 <form action="phanquyenadd.php" method="post" onsubmit="return validateForm()">
                 <table class="form">   
                        <tr>
                            <td>
                                <label>Tên Người Dùng</label>
                            </td>
                            <td>
                                <select style="width: 250px;" id="selectNguoiDung" name="IDNguoiDung">
                                    <option>--------Chọn Người Dùng-------</option>
                                    <?php
                                    $cat = new nguoidung();
                                    $catlist = $cat->show_nguoidung_by_name();

                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['IDNguoiDung'] ?>"><?php echo $result['TenNguoiDung'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>               
                        <tr>
                            <td>
                                <label>Tên Quyền</label>
                            </td>
                            <td>
                                <select style="width: 250px;" id="selectQuyen" name="IDQuyen">
                                    <option>--------Chọn Quyền-------</option>
                                    <?php
                                    $cat = new quyen();
                                    $catlist = $cat->show_brand();

                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $result['IDQuyen'] ?>"><?php echo $result['TenQuyen'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input id="submitButton" type="submit" name="submit" value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
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