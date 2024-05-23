<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/bosuutap.php' ?>
<?php
    $cat = new category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['catName'])) {
            $insertCat = "Vui lòng nhập tên Bộ Sưu Tập.";
        } else {
            $catName = $_POST['catName'];
            $insertCat = $cat->insert_category($catName);
        }
    }
?>
<?php  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Bộ Sưu Tập Mới</h2>
        <div class="block copyblock"> 
            <?php if(isset($insertCat)) echo $insertCat; ?> 
            <form name="categoryForm" action="bosuutapadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="catName" placeholder="Nhập chủ đề Bộ Sưu Tập..." class="medium" />
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
        var catName = document.forms["categoryForm"]["catName"].value;
        if (catName.trim() == "") {
            alert("Vui lòng nhập chủ đề Bộ Sưu Tập.");
            return false;
        }
    }
</script>