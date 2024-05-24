<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/menutrangchu.php' ?>

<?php
$brand = new menutrangchu();
$insertBrand = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDBoSuuTapArray = isset($_POST['IDBoSuuTap']) ? $_POST['IDBoSuuTap'] : array();
    if (!empty($IDBoSuuTapArray)) {
        foreach ($IDBoSuuTapArray as $IDBoSuuTap) {
            $insertBrand = $brand->insert_brand($IDBoSuuTap);
        }
    } else {
        $insertBrand = "<span class='error'>Chưa chọn Bộ Sưu Tập nào</span>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Menu Mới</h2>
        <div class="block copyblock"> 
            <?php
            if(isset($insertBrand)){
                echo $insertBrand;
            }
            ?> 
            <form action="menuadd.php" method="post" onsubmit="return validateForm()">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Chọn Bộ Sưu Tập</label>
                        </td>
                        <td>
                            <?php
                            $brand = new menutrangchu();
                            $brandlist = $brand->show_bosuutap();
                            $existingBrandlist = $brand->get_existing_bosuutap();
                            
                            $existingIDs = array();
                            if ($existingBrandlist) {
                                while ($row = $existingBrandlist->fetch_assoc()) {
                                    $existingIDs[] = $row['IDBoSuuTap'];
                                }
                            }

                            if ($brandlist) {
                                while ($result = $brandlist->fetch_assoc()) {
                                    if (!in_array($result['IDBoSuuTap'], $existingIDs)) {
                                        echo '<input type="checkbox" name="IDBoSuuTap[]" value="' . $result['IDBoSuuTap'] . '"> ' . $result['TenBoSuuTap'] . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
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
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var isChecked = false;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        alert("Vui lòng chọn ít nhất một Bộ Sưu Tập.");
        return false;
    }
    return true;
}
</script>
