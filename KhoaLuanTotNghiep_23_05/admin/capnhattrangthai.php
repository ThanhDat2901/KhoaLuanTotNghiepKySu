<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cập nhật trạng thái đơn hàng</title>
</head>
<body>

<h2>Cập nhật trạng thái đơn hàng</h2>

<form action="process_order_status.php" method="POST">
  <label for="new_status">Trạng thái mới:</label><br>
  <select name="new_status" id="new_status">
    <option value="Chờ xác nhận">Chờ xác nhận</option>
    <option value="Đang giao hàng">Đang giao hàng</option>
    <option value="Đã giao hàng">Đã giao hàng</option>
    <option value="Hủy đơn hàng">Hủy đơn hàng</option>
  </select><br><br>
  <label for="customer_email">Email người dùng:</label><br>
  <input type="email" id="customer_email" name="customer_email" required><br><br>
  <input type="submit" name="update_status" value="Cập nhật trạng thái">
</form>

</body>
</html>
