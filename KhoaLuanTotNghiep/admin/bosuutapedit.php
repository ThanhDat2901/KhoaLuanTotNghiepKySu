<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/bosuutap.php' ?>
<?php
   
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
       echo "<script>window.location ='bosuutaplist.php'</script>";
    }else{
         $id = $_GET['catid']; 
    }
     $cat = new category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $TenBoSuuTap = $_POST['TenBoSuuTap'];
        $updateCat = $cat->update_category($TenBoSuuTap,$id);
        
    }

?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thay Đổi Chủ Đề Bộ Sưu Tập</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updateCat)){
                    echo $updateCat;
                }
                ?>
                <?php
                    $get_cate_name = $cat->getcatbyId($id);
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){
                       
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['TenBoSuuTap'] ?>" name="TenBoSuuTap" placeholder="Thay đổi chủ đề Bộ Sưu Tập..." class="medium" />
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