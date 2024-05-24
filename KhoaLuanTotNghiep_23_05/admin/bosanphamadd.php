<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/bosanpham.php' ?>
 <?php
    $brand = new brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['TenBo'])) {
            $insertBrand = "Vui lòng nhập tên Bộ Sản Phẩm.";
        } else {
            $TenBo = $_POST['TenBo'];
            $insertBrand = $brand->insert_brand($TenBo);
        }
    }
?> 
<?php  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Bộ Sản Phẩm Mới</h2>
        <div class="block copyblock"> 
            <?php if(isset($insertBrand)) echo $insertBrand; ?> 
            <form name="brandForm" action="bosanphamadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="TenBo" placeholder="Nhập tên Bộ Sản Phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
<script type="text/javascript">
        function validateForm() {
            var tenBo = document.forms["brandForm"]["TenBo"].value;
            if (tenBo.trim() == "") {
                alert("Vui lòng nhập tên Bộ Sản Phẩm.");
                return false;
            }
        }
</script>