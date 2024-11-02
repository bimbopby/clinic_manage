<?php
include("includes/db_connect.php");
include("includes/auth.php");
authenticate("manager");

// Thống kê số lượng bệnh nhân theo tháng
$query_patients = "SELECT MONTH(register_date) AS month, COUNT(*) AS total FROM register GROUP BY month";
$result_patients = mysqli_query($conn, $query_patients);

// Thống kê doanh thu theo bác sĩ và thời gian
$query_revenue = "SELECT doctor, SUM(price) AS total_revenue FROM record 
                  JOIN services ON record.service = services.name 
                  WHERE record.inject_vaccine = 1
                  GROUP BY doctor";
$result_revenue = mysqli_query($conn, $query_revenue);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <div class="logo">Logo</div>
        <div class="header-links">
            <a href="index.php">Trang chủ</a>    
            <a href="manage_dashboard.php">Quay lại</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
    </header>    
<h2>Thống kê</h2>

    <h3>Thống kê khách hàng</h3>
    <table border="1">
        <tr>
            <th>Tháng</th>
            <th>Số lượng khách hàng</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_patients)): ?>
        <tr>
            <td><?php echo $row['month']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Doanh số</h3>
    <table border="1">
        <tr>
            <th>Bác sĩ</th>
            <th>Doanh thu</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_revenue)): ?>
        <tr>
            <td><?php echo $row['doctor']; ?></td>
            <td><?php echo $row['total_revenue']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
