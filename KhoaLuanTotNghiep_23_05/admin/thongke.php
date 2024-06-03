<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê Hóa Đơn</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    .chart-container {
        display: none;
    }
    .chart-container.active {
        display: block;
    }
    .button-container {
        margin-bottom: 20px;
    }
    @keyframes blink-color {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}

@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
}

.blink-text {
    animation: blink 1s infinite;
}

.blink-color-text {
    animation: blink-color 2s infinite;
}
    </style>
</head>
<body>
    <?php include 'inc/header.php';?>
    <?php include 'inc/sidebar.php';?>
    <?php include '../classes/hoadon.php'; ?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Thống Kê Hóa Đơn</h2>
            <div class="block">
            <?php
                    $hoadon = new hoadon();

                    // Thống kê theo ngày
                    $tongTienNgay = $hoadon->tongTienTheoNgay();
                    $ngay = [];
                    $tongTienNgayArray = [];
                    $tongTienNgayTotal = 0; // Tổng tiền theo ngày
                    if ($tongTienNgay) {
                        while ($result = $tongTienNgay->fetch_assoc()) {
                            $ngay[] = $result['NgayLap'];
                            $tongTienNgayArray[] = $result['TongTien'];
                            $tongTienNgayTotal += $result['TongTien']; // Tính tổng tiền theo ngày
                        }
                    }

                    // Thống kê theo tháng
                    $tongTienThang = $hoadon->tongTienTheoThang();
                    $thang = [];
                    $tongTienThangArray = [];
                    $tongTienThangTotal = 0; // Tổng tiền theo tháng
                    if ($tongTienThang) {
                        while ($result = $tongTienThang->fetch_assoc()) {
                            $thang[] = $result['Thang'];
                            $tongTienThangArray[] = $result['TongTien'];
                            $tongTienThangTotal += $result['TongTien']; // Tính tổng tiền theo tháng
                        }
                    }

                    // Thống kê theo năm
                    $tongTienNam = $hoadon->tongTienTheoNam();
                    $nam = [];
                    $tongTienNamArray = [];
                    $tongTienNamTotal = 0; // Tổng tiền theo năm
                    if ($tongTienNam) {
                        while ($result = $tongTienNam->fetch_assoc()) {
                            $nam[] = $result['Nam'];
                            $tongTienNamArray[] = $result['TongTien'];
                            $tongTienNamTotal += $result['TongTien']; // Tính tổng tiền theo năm
                        }
                    }
                    ?>

                <div class="button-container">
                    <button onclick="showChart('ngay')">Thống Kê Theo Ngày</button>
                    <button onclick="showChart('thang')">Thống Kê Theo Tháng</button>
                    <button onclick="showChart('nam')">Thống Kê Theo Năm</button>
                </div>

                <div class="chart-container active" id="chart-container-ngay">
                    <h3 class="blink-color-text">Thống Kê Theo Ngày</h3>
                    <p style="color:red">Tổng Tiền: <?php echo number_format($tongTienNgayTotal, 0, ',', '.'); ?> VND</p>
                    <canvas id="chartNgayBar"></canvas>
                    <canvas id="chartNgayLine"></canvas>
                </div>

                <div class="chart-container" id="chart-container-thang">
                    <h3 class="blink-color-text">Thống Kê Theo Tháng</h3>
                    <p style="color:red">Tổng Tiền: <?php echo number_format($tongTienThangTotal, 0, ',', '.'); ?> VND</p>
                    <canvas id="chartThangBar"></canvas>
                    <canvas id="chartThangLine"></canvas>
                </div>

                <div class="chart-container" id="chart-container-nam">
                    <h3 class="blink-color-text">Thống Kê Theo Năm</h3>
                    <p style="color:red">Tổng Tiền: <?php echo number_format($tongTienNamTotal, 0, ',', '.'); ?> VND</p>
                    <canvas id="chartNamBar"></canvas>
                    <canvas id="chartNamLine"></canvas>
                </div>

            </div>
        </div>
    </div>

    <script>
        function showChart(type) {
            document.querySelectorAll('.chart-container').forEach(container => {
                container.classList.remove('active');
            });
            document.getElementById('chart-container-' + type).classList.add('active');
        }

        // Biểu đồ cột và đường thống kê theo ngày
        const ctxNgayBar = document.getElementById('chartNgayBar').getContext('2d');
        const ctxNgayLine = document.getElementById('chartNgayLine').getContext('2d');

        const chartNgayBar = new Chart(ctxNgayBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($ngay); ?>,
                datasets: [{
                    label: 'Thóng Kê(Biểu Đồ Cột)',
                    data: <?php echo json_encode($tongTienNgayArray); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const chartNgayLine = new Chart(ctxNgayLine, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($ngay); ?>,
                datasets: [{
                    label: 'Thống Kê(Biểu Đồ Đường)',
                    data: <?php echo json_encode($tongTienNgayArray); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)', 
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ cột và đường thống kê theo tháng
        const ctxThangBar = document.getElementById('chartThangBar').getContext('2d');
        const ctxThangLine = document.getElementById('chartThangLine').getContext('2d');

        const chartThangBar = new Chart(ctxThangBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($thang); ?>,
                datasets: [{
                    label: 'Thống Kê(Biểu Đồ Cột)',
                    data: <?php echo json_encode($tongTienThangArray); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const chartThangLine = new Chart(ctxThangLine, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($thang); ?>,
                datasets: [{
                    label: 'Thống Kê(Biểu Đồ Đường)',
                    data: <?php echo json_encode($tongTienThangArray); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: false,
                    tension: 0.4 // Tạo đường mềm mại hơn
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ cột và đường thống kê theo năm
        const ctxNamBar = document.getElementById('chartNamBar').getContext('2d');
        const ctxNamLine = document.getElementById('chartNamLine').getContext('2d');

        const chartNamBar = new Chart(ctxNamBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nam); ?>,
                datasets: [{
                    label: 'T(Biểu Đồ Đường)',
                    data: <?php echo json_encode($tongTienNamArray); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const chartNamLine = new Chart(ctxNamLine, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($nam); ?>,
                datasets: [{
                    label: '(Biểu Đồ Cột)',
                    data: <?php echo json_encode($tongTienNamArray); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        function blinkHeader() {
            var header = document.querySelector('h3');
            header.classList.toggle('blink-text');
        }

        // Call the blinkHeader function every 1 second (1000 milliseconds)
        setInterval(blinkHeader, 1000);
    </script>
    <?php include 'inc/footer.php';?>
</body>
</html>
