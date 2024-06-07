<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<!-- https://fontawesome.com/v5/search?q=user&m=free -->
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    /* CSS để định dạng menu */
    .menuitem {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        color: black;
        transition: transform 0.3s; /* Đảm bảo hiệu ứng chuyển động mềm mại */
    }


    /* CSS để thay đổi hiệu ứng khi hover */
    .menuitem:hover {
        transform: translateY(-5px); /* Khoảng cách chữ nổi lên */
        color:blue;
    }
    /* CSS để định dạng submenu */
    /* CSS để định dạng submenu */
    .submenu {
        list-style-type: none;
        padding: 0;
    }

    /* CSS để định dạng các mục trong submenu */
    .submenu li a {
        font-family: 'Open Sans', sans-serif; /* Đổi font chữ thành Times New Roman */
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        color: black;
        position: relative; /* Cần thiết để sử dụng transform */
        transition: transform 0.3s; /* Đảm bảo hiệu ứng chuyển động mềm mại */
    }

    /* CSS để thay đổi hiệu ứng khi hover */
    .submenu li a:hover {
        transform: translateX(10px); /* Di chuyển chữ qua bên phải */
    }
    
</style>

</head>
<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">

                 <li><a class="menuitem"><i class="fas fa-shopping-bag"></i> Đơn hàng</a>
                    <ul class="submenu">
                        <li><a href="hoadonshownv.php"><h style="color: red;font-size:14px">Chi Tiết Đơn Hàng</h></a> </li>
                        <li><a href="thongkenv.php"><h style="color: blue;font-size:14px">Thống Kê Đơn Hàng</h></a> </li>                 
                    </ul>
                </li>
                <li><a class="menuitem"><i class="far fa-address-card"></i> Thông Tin Cá Nhân</a>
                    <ul class="submenu">
                        <li><a href="nguoidungeditnv.php"><h style="color: red;font-size:14px">Thay Đổi Thông Tin</h></a> </li>                    
                    </ul>
                </li>
                <li><a class="menuitem"><i class="far fa-comment-alt"></i> Đánh Giá</a>
                    <ul class="submenu">
                        <li><a href="commentlist.php"><h style="color: red;font-size:14px">Danh Sách Đánh Giá</h></a> </li>                    
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</div>