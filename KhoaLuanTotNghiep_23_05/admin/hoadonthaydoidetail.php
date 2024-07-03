<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/chitiethoadon.php' ?>
<?php include '../classes/chitietsanpham.php' ?>
<?php
      $ctsp = new chitietsanpham();
   if(isset($_GET['id'])){
     $id = $_GET['id']; 
     $IdHoaDon = $_GET['idhoadon'];
    }
     $brand = new chitiethoadon();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $IDSize = $_POST['IDSize'];
        $IDSanPham = $_POST['IDSanPham'];
        $SoLuongMua = $_POST['SoLuongMua'];
        $get_idChiTiet =   $brand->show_ChiTietSanPham_ByIdSize_IdSanPham($IDSize,$IDSanPham);
        $result_get_idChiTiet = $get_idChiTiet->fetch_assoc();

        $IDChiTiet = $result_get_idChiTiet['IDChiTiet'];
        $updateSoluongctsp = $ctsp->update_chitietsoluongsanpham($id,$SoLuongMua);
        $updateBrand = $brand->update_chitiethoadon($result_get_idChiTiet['IDChiTiet'],$IdHoaDon,$SoLuongMua);
        
    }

?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thay Đổi Hàng</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updateBrand)){
                    echo $updateBrand;
                }
                ?>
                <?php
                    $get_brand_name = $brand->show_ChiTietHoaDon_ByIdChiTietHoaDon($IdHoaDon,$id);
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                       
                ?>
        <form action="" method="post">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2" style="padding: 10px 0;">
                        <input type="hidden" id="IDSanPham" value="<?php echo $result['IDSanPham']; ?>" name="IDSanPham">
                        <input type="hidden" id="SoLuongMua" value="<?php echo $result['SoLuongMua']; ?>" name="SoLuongMua">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;"><?php echo $result['TenSanPham']; ?></label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;">
                        <img src="<?php echo $result['HinhAnh']; ?>" width="90" style="border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                    </td>
                </tr>
                <tr>
                        <td>
                            <label>Tên Size</label>
                        </td>
                        <td>
                            <select style="width: 250px;" id="selectNguoiDung" name="IDSize">
                                <option>--------Chọn Size-------</option>
                                <?php
                                $catlist = $ctsp->getSizeById($result['IDSanPham']);
                                if ($catlist) {
                                    while ($result2 = $catlist->fetch_assoc()) {
                                ?>
                                <option
                                    <?php if ($result2['IDSize'] == $result['CTIDSize']) { echo 'selected'; } ?>
                                    value="<?php echo $result2['IDSize']; ?>"><?php echo $result2['TenSize']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                <tr>
                    <td colspan="2" style="padding: 10px 0;">
                        <input type="submit" name="submit" value="Lưu" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 10px; cursor: pointer; border-radius: 4px;">
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