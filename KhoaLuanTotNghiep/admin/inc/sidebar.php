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
                <li><a class="menuitem"><i class="fas fa-user"></i> Quyền </a>
                    <ul class="submenu" >
                        <li><a href="quyenadd.php"><h style="color: red;font-family: 'Open Sans', sans-serif; font-size:14px">Thêm quyền</h></a> </li>
                        <li><a href="quyenlist.php"><h style="color: blue;font-family: 'Open Sans', sans-serif; font-size:14px">Danh sách quyền</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-users-cog"></i> Phân Quyền Tài Khoản</a>
                    <ul class="submenu">
                        <li><a href="phanquyenadd.php"><h style="color: red;font-size:14px">Phân quyền cho tài khoản</h></a> </li>
                        <li><a href="phanquyenlist.php"><h style="color: blue;font-size:14px">Danh sách tài khoản và quyền</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-users"></i> Nhân Viên</a>
                    <ul class="submenu">
                        <li><a href="nguoidungadd.php"><h style="color: red;font-size:14px">Thêm tài khoản</h></a> </li>
                        <li><a href="nguoidunglist.php"><h style="color: blue;font-size:14px">Danh sách tài khoản</h></a> </li>
                        <li><a href="resetpass.php"><h style="color: green;font-size:14px">Đặt lại mật khẩu</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-images"></i> Bộ Sưu Tập</a>
                    <ul class="submenu">
                        <li><a href="bosuutapadd.php"><h style="color: red;font-size:14px">Thêm bộ sưu tập</h></a> </li>
                        <li><a href="bosuutaplist.php"><h style="color: blue;font-size:14px">Danh sách bộ sưu tập</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-image"></i> Chi Tiết Bộ Sưu Tập</a>
                    <ul class="submenu">
                        <li><a href="chitietbosuutapadd.php"><h style="color: red;font-size:14px">Thêm sản phẩm vào bộ sưu tập</h></a> </li>
                        <li><a href="chitietbosuutaplist.php"><h style="color: blue;font-size:14px">Chi tiết danh sách bộ sưu tập</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="far fa-images"></i> Bộ Sản Phẩm</a>
                    <ul class="submenu">
                        <li><a href="bosanphamadd.php"><h style="color: red;font-size:14px">Thêm bộ sản phẩm</h></a> </li>
                        <li><a href="bosanphamlist.php"><h style="color: blue;font-size:14px">Danh sách bộ sản phẩm</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="far fa-image"></i> Chi Tiết Bộ Sản Phẩm</a>
                    <ul class="submenu">
                        <li><a href="chitietbosanphamadd.php"><h style="color: red;font-size:14px">Thêm sản phẩm vào bộ sản phẩm</h></a> </li>
                        <li><a href="chitietbosanphamlist.php"><h style="color: blue;font-size:14px">Chi tiết danh sách bộ sản phẩm</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-layer-group"></i> Loại Sản Phẩm</a>
                    <ul class="submenu">
                        <li><a href="loaiadd.php"><h style="color: red;font-size:14px">Thêm loại sản phẩm</h></a> </li>
                        <li><a href="loailist.php"><h style="color: blue;font-size:14px">Danh sách loại sản phẩm</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-expand-arrows-alt"></i> Kích Cỡ</a>
                    <ul class="submenu">
                        <li><a href="sizeadd.php"><h style="color: red;font-size:14px">Thêm size</h></a> </li>
                        <li><a href="sizelist.php"><h style="color: blue;font-size:14px">Danh sách size</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-money-bill-alt"></i> Khuyến Mãi</a>
                    <ul class="submenu">
                        <li><a href="kmadd.php"><h style="color: red;font-size:14px">Thêm khuyến mãi</h></a> </li>
                        <li><a href="kmlist.php"><h style="color: blue;font-size:14px">Danh sách khuyến mãi</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-tshirt"></i> Sản Phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php"><h style="color: red;font-size:14px">Thêm sản phẩm</h></a> </li>
                        <li><a href="productlist.php"><h style="color: blue;font-size:14px">Danh sách sản phẩm</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-user-secret"></i> Chi Tiết Sản Phẩm</a>
                    <ul class="submenu">
                        <li><a href="chitietsanphamadd.php"><h style="color: red;font-size:14px">Thêm size cho sản phấm</h></a> </li>
                        <li><a href="chitietsanphamlist.php"><h style="color: blue;font-size:14px">Danh sách chi tiết sản phẩm</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-image"></i> Hình Ảnh Sản Phẩm</a>
                    <ul class="submenu">
                        <li><a href="hinhanhadd.php"><h style="color: red;font-size:14px">Thêm hình ảnh</h></a> </li>
                        <li><a href="hinhanhlist.php"><h style="color: blue;font-size:14px">Danh sách hình ảnh</h></a> </li>
                    </ul>
                </li>
                <li><a class="menuitem"><i class="fas fa-home"></i> Menu Trang Chủ</a>
                    <ul class="submenu">
                        <li><a href="menuadd.php"><h style="color: red;font-size:14px">Tạo Menu Trang Chủ</h></a> </li>
                        <li><a href="menulist.php"><h style="color: blue;font-size:14px">Danh Sách Các Menu Trang Chủ</h></a> </li>
                    </ul>
                </li>  
                 <li><a class="menuitem">Đơn hàng</a>
                    <ul class="submenu">
                        <li><a href="inbox.php">Liệt kê đơn hàng</a> </li>             
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</div>