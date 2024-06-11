<?php require_once '../init.php'; ?>
<?php include 'inc/headernv.php';?>
<?php include 'inc/sidebarnv.php';?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sự Kiện</title>
    <style>
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        @keyframes colorChange {
            0% { color: red; }
            25% { color: blue; }
            50% { color: green; }
            75% { color: orange; }
            100% { color: red; }
        }

        .marquee {
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            animation: marquee 10s linear infinite;
            font-size: 24px;
            text-align: center;
        }

        .colorChange {
            animation: colorChange 4s infinite;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }

        .events {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .box {
            width: 80%; /* Điều chỉnh kích thước khối tổng thể */
            max-width: 1200px; /* Giới hạn chiều rộng tối đa */
            margin: 20px 0;
            padding: 20px;
        }

        .event {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 120%; /* Tăng kích thước theo yêu cầu */
            height: 100%; /* Chiều cao 100% */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .event img {
            width: 100%; /* Điều chỉnh chiều rộng hình ảnh */
            height: auto; /* Giữ tỷ lệ khung hình */
            max-height: 200px; /* Giới hạn chiều cao tối đa của hình ảnh */
        }

        .event h4 {
            padding: 10px;
            font-size: 20px; /* Tăng kích thước tiêu đề */
            text-align: center;
        }

        .event p {
            padding: 0 10px 10px;
            font-size: 16px; /* Tăng kích thước văn bản */
            text-align: center;
        }

        .event:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="grid_10 center">
        <div class="box round first grid">
            <h3 class="marquee colorChange">Phục vụ tận tâm, hài lòng mọi khách hàng!</h3>
            <h2>Sự Kiện Hot Trong Tháng <?php echo date('m-Y'); ?></h2>
            <div class="block">
                <div class="events">
                    <div class="event">
                        <img src="https://d3design.vn/uploads/5495874fhgtrty567.jpg" style="hight:100px" alt="Sự Kiện Giảm Giá Mùa Hè">
                        <h4>Giảm Giá Mùa Hè</h4>
                        <p>Giảm giá lên đến 50% cho các sản phẩm mùa hè.</p>
                    </div>
                    <div class="event">
                        <img src="https://khotainguyen.com/wp-content/uploads/2018/09/chao-mung-quoc-khanh-2-9.jpg" alt="Sự Kiện Mừng Ngày Quốc Khánh">
                        <h4>Mừng Ngày Quốc Khánh</h4>
                        <p>Ưu đãi đặc biệt nhân ngày Quốc Khánh.</p>
                    </div>
                    <!-- Thêm nhiều sự kiện khác nếu cần -->
                </div>
            </div>
        </div>
    </div>
    <?php include 'inc/footernv.php';?>
</body>
</html
