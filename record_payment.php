<?php
include("includes/auth.php");
include("includes/db_connect.php");

authenticate('cashier');

$query = "SELECT record.id, users.username, services.name AS service_name, services.price 
          FROM record 
          JOIN register ON record.register_id = register.id 
          JOIN users ON register.user_id = users.id 
          JOIN services ON register.service_id = services.id 
          WHERE record.status = 'completed' AND NOT EXISTS 
          (SELECT * FROM invoice WHERE invoice.record_id = record.id)";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Record Payment - Cashier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <div class="logo">Logo</div>
        <div class="header-links">
           
            <a href="logout.php">Đăng xuất</a>
        </div>
    </header> 

<h2>Phiếu tiêm hoàn thành cần thanh toán</h2>
    <table>
        <tr>
            <th>Tên khách hàng</th>
            <th>Dịch vụ</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['service_name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <form action="generate_invoice.php" method="POST">
                        <input type="hidden" name="record_id" value="<?php echo $row['id']; ?>">
                        <button type="submit">In hoá đơn</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
