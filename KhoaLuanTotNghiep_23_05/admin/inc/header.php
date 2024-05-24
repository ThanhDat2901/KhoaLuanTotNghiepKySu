<?php  require_once '../init.php'; ?>
<?php if(isset($_SESSION['login_admin'])): ?>	

<?php
    include '../lib/session.php';

    // Session::checkSession();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <style>
    /* CSS cho hiệu ứng hover */
    .floatleft.logo .chat-text {
        display: block;
        position: absolute;
        top: 50px; /* Điều chỉnh vị trí top tùy theo kích thước của hình */
        left: 0;
        right: 0;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .floatleft.logo:hover .chat-text {
        opacity: 1;
    }
    .floatleft {
            float: left;
        }

        .middle {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Adjust height as needed */
            width: 100%;
            overflow: hidden; /* Hide overflow to create scrolling effect */
        }

        h1 {
            white-space: nowrap; /* Prevent text from wrapping */
            display: inline-block;
            animation: scroll 10s linear infinite, colorChange 10s linear infinite;
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes colorChange {
            0% {
                color: red;
            }
            25% {
                color: orange;
            }
            50% {
                color: yellow;
            }
            75% {
                color: green;
            }
            100% {
                color: blue;
            }
        }
        .theme-switch-wrapper {
    display: flex;
    align-items: center;
}

.theme-switch {
    position: relative;
    display: inline-block;
    width: 50px; /* Điều chỉnh kích thước thanh gạc */
    height: 25px; /* Điều chỉnh kích thước thanh gạc */
    margin-right: 10px;
}

.theme-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 25px; /* Điều chỉnh hình dạng thanh gạc */
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px; /* Điều chỉnh kích thước nút trượt */
    width: 20px; /* Điều chỉnh kích thước nút trượt */
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Default Light Mode Styles */
body {
    background-color: white;
    color: black;
}

/* Dark Mode Styles */
.dark-mode {
    background-color: black;
    color: white;
}

/* Additional styles for dark mode */
.dark-mode .box {
    background-color: #333;
    border-color: #555;
}

.dark-mode .block {
    background-color: #444;
    color: #ddd;
}
    
</style>
</head>

<body>
    <div class="container_12">       
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/yamelogo2.png" alt="Logo" />
				</div>
                
                <div class="floatleft middle" style="height:100px;margin-top: -80px;">
                    <h1>Quản Lý Hệ Thống</h1>
                    <div class="theme-switch-wrapper" style="margin-left:77%">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <span class="slider round"></span>
                        </label>
                        <em>Chuyển Giao Diện</em>
                    </div>
                </div> 
                <div class="floatright">
                    
                    <div class="floatleft">
                        <img style="width:20px;height:20px" src="img/admin.png" alt="Profile Pic" /></div>
                        
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Xin Chào</li>
                            <li style="color: red;"> <?php echo $_SESSION['admin'] ?> </li>
                            <li><a href="../logout.php">Đăng Xuất</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
            <div class="floatleft logo" style="position: fixed; bottom: 0; right: 0; padding: 20px;">
                <a href="https://www.ciciai.com/chat/10057177786116" style="display: inline-block;">
                    <img style="width:40px;height:40px;border-radius: 50%;" src="img/yamelogo2.png" alt="Tư Vấn Khách Hàng" />
                    <span style="color:white;" class="chat-text">Tư Vấn Khách Hàng</span>
                </a>    
            </div>
        </div>
        <div class="clear">
        </div>
        
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Các Chức Năng</span></a> </li>
				<li class="ic-typography"><a href="changepassword.php"><span><i class="fas fa-key"></i> Đổi Mật Khẩu</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Hóa Đơn</span></a></li>
                <li class="ic-charts"><a href="../products.php"><span>Trang Bán Hàng</span></a></li>


            </ul>

        </div>
        
        <div class="clear">
        <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const toggleSwitch = document.getElementById('checkbox');
                    const body = document.body;

                    toggleSwitch.addEventListener('change', function () {
                        if (toggleSwitch.checked) {
                            body.classList.add('dark-mode');
                            localStorage.setItem('theme', 'dark');
                        } else {
                            body.classList.remove('dark-mode');
                            localStorage.setItem('theme', 'light');
                        }
                    });

                    // Load the preference from localStorage
                    const savedTheme = localStorage.getItem('theme');
                    if (savedTheme && savedTheme === 'dark') {
                        body.classList.add('dark-mode');
                        toggleSwitch.checked = true;
                    }
                });
            </script>
            
        </div>
<?php else:?>
<?php   header('location: ../login.php'); ?>
<?php endif ?>    