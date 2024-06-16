<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/hoadon.php' ?>
<?php include '../classes/chitietsanpham.php' ?>
<?php
$ctsp = new chitietsanpham();
    $brand = new hoadon();
    if(isset($_GET['id'])){
        $id = $_GET['id']; 
        $show_brand_detail = $brand->show_HoaDonDetail($id);

    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Chi Tiết Hóa Đơn</h2>
        <div class="block">    
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Số Thứ Tự</th>
                        <th>Tên Người Dùng</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Địa Chỉ</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Hình Ảnh</th>
                        <th>Số Lượng Mua</th>
                        <th>Ngày Mua</th>
                        <th>Ghi Chú</th>
                        <th>Tổng Tiền</th>
                        <!-- <th>Trạng Thái</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($show_brand_detail){
                        $i = 0;
                        while($result = $show_brand_detail->fetch_assoc()){
                            $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['TenNguoiDung'] ?></td>
                        <td><?php echo $result['SDT'] ?></td>
                        <td><?php echo $result['Email'] ?></td>
                        <td><?php echo $result['DiaChi'] ?></td>
                        <td><?php echo $result['TenSanPham'] ?></td>
                        <td><img src="<?php echo $result['HinhAnh'] ?>" width="50"/></td>
                        <td><?php echo $result['SoLuongMua'] ?></td>
                        <td><?php echo $result['NgayLap'] ?></td>
                        <td><?php echo $result['GhiChu'] ?></td>
                        <td><?php echo number_format($result['ThanhTien'], 0, ',', '.') ?> VND</td>
                    </tr>
                    <?php
                                 $lastResult = $result;
                                //  if($lastResult['TrangThai']==13){
                                //     $updatectsp = $ctsp->update_chitietsanphamtrahang($result['IDSize'],$result['IDSanPham'],$result['SoLuongMua'],$result['IDChiTiet']);
                                //  }
                }
                    }
                    ?>
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                <label for="IDTrangThai">Trạng Thái: </label>
                <?php if($lastResult['TrangThai']==1): ?>
                            <button style="border-radius: 5px;" class="send-email-btn" data-email="<?php echo $lastResult['IdHoaDonFake']; ?>">Xác Nhận Đơn Hàng</button>
                <?php else: ?>

                    <select style="width: 250px;" name="IDTrangThai" id="IDTrangThai">
                        <?php
                        $cat2 = new hoadon();
                        $catlist2 = $cat2->show_TrangThai();

                        if($catlist2){
                            while($result2 = $catlist2->fetch_assoc()){
                        ?>
                            <option
                                <?php
                                if ($result2['IDTrangThai'] == $lastResult['TrangThai']) { echo 'selected';  }
                                ?>
                                 value="<?php echo $result2['IDTrangThai'] ?>"><?php echo $result2['TenTrangThai'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>


                <?php endif ?>
            </div>

       </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    var trangThaiSelect = document.getElementById('IDTrangThai');
    var selectedValue = trangThaiSelect.value;

    function updateOptions() {
        for (var i = 0; i < trangThaiSelect.options.length; i++) {
            var option = trangThaiSelect.options[i];
            if (selectedValue == 2) {
                // Hide value=1 (Chờ Xác Nhận) and show value=3
                if (option.value == 1) {
                    option.style.display = 'none';
                } else if (option.value == 3) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'block'; // Display other options
                }
            } else {
                // Show all options if selectedValue is not 2
                option.style.display = 'block';
            }
        }
    }

    // Initial update based on selected value
    updateOptions();

    // Update options when the selected value changes
    trangThaiSelect.addEventListener('change', function () {
        selectedValue = trangThaiSelect.value;
        updateOptions();
    });
    });
</script> -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var trangThaiSelect = document.getElementById('IDTrangThai');
    var selectedValue = trangThaiSelect.value;
    var changeButton = document.createElement('button');
    changeButton.textContent = 'Thay đổi';
    changeButton.style.display = 'none'; // Hide the button initially
    changeButton.style.marginLeft = '10px';
    
    changeButton.addEventListener('click', function() {
        var IDHoaDon = "<?php echo $lastResult['IdHoaDonFake']; ?>";
        updateOptions();
        var IDTrangThai = trangThaiSelect.value;
        CapNhatTrangthai(IDHoaDon, IDTrangThai);
    });

    trangThaiSelect.parentElement.appendChild(changeButton);

    // function updateOptions() {
    //     for (var i = 0; i < trangThaiSelect.options.length; i++) {
    //         var option = trangThaiSelect.options[i];
    //         if (selectedValue == 2) {
    //             // Hide value=1 (Chờ Xác Nhận) and show value=3
    //             if (option.value == 1) {
    //                 option.style.display = 'none';
    //             } else if (option.value == 3) {
    //                 option.style.display = 'block';
    //             } else {
    //                 option.style.display = 'block'; // Display other options
    //             }
    //         } else {
    //             // Show all options if selectedValue is not 2
    //             option.style.display = 'block';
    //         }
    //     }
    // }
    function updateOptions() {
    var currentValue = parseInt(trangThaiSelect.value);
    for (var i = 0; i < trangThaiSelect.options.length; i++) {
        var option = trangThaiSelect.options[i];
        var optionValue = parseInt(option.value);
        if (optionValue < currentValue) {
            option.style.display = 'none'; // Ẩn các tùy chọn có giá trị nhỏ hơn giá trị hiện tại
        } else {
            option.style.display = 'block'; // Hiển thị các tùy chọn khác
        }
    }
}

    // Initial update based on selected value
    updateOptions();

    // Update options when the selected value changes
    // trangThaiSelect.addEventListener('change', function () {
    //         // selectedValue = trangThaiSelect.value;
    //         // updateOptions();
    //         // changeButton.style.display = 'inline-block'; // Show the button when a new option is selected

    //     var newValue = trangThaiSelect.value;
    //     if (newValue !== selectedValue) {
    //         selectedValue = newValue;
    //         updateOptions();
    //         if (selectedValue == 2) {
    //             changeButton.style.display = 'none'; // Ẩn nút "Thay đổi" khi chọn giá trị là 2
    //         } else {
    //             changeButton.style.display = 'inline-block'; // Hiển thị nút "Thay đổi" cho các giá trị khác
    //         }
    //     }
    // });
    trangThaiSelect.addEventListener('change', function () {
        var newValue = trangThaiSelect.value;
        if (newValue !== selectedValue) {
            selectedValue = newValue;
            // updateOptions();
            if (selectedValue !== "<?php echo $lastResult['TrangThai']; ?>") {
                changeButton.style.display = 'inline-block'; 
            } else {
                changeButton.style.display = 'none'; 
            }
        }
    });
    function CapNhatTrangthai(IDHoaDon, IDTrangThai) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'hoadoncapnhaptrangthai.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        };
        xhr.send('IDHoaDon=' + IDHoaDon + '&IDTrangThai=' + IDTrangThai);
    }
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
    $(document).ready(function () {
        $('.send-email-btn').click(function () {
            var email = $(this).data('email');
            var button = $(this);
            button.prop('disabled', true).addClass('confirmed').html('<button style="border-radius: 5px;">Đã Xác Nhận Đơn Hàng</button>');

            $.ajax({
                url: 'senemail.php',
                method: 'GET',
                data: { email: email },
                success: function (response) {
                    alert('Email xác nhận đã được gửi thành công đến người mua.');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert('Đã xảy ra lỗi: ' + error);
                    
                    button.prop('disabled', false).removeClass('confirmed').text('Xác Nhận Đơn Hàng');
                }
            });
        });
    });
</script>

<style>
.confirmed {
    pointer-events: none;
    background-color: #ccc; 
    color: #000;
    border-radius: 5px; 
}
</style>
