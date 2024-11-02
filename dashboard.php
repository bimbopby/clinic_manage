<?php
include("includes/db_connect.php");
include("includes/auth.php");
authenticate("staff"); // Xác thực người dùng là staff

// Lấy danh sách đăng ký tiêm chủng
$query = "SELECT r.id, r.customer_name, r.dob, r.service, r.register_date 
          FROM register r";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Quản lý đăng ký tiêm chủng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="images/clinic_logo.png" alt="Logo Phòng Tiêm Chủng">
        <div class="header-links">
            <a href="index.php">Trang chủ</a>    
            <a href="logout.php">Đăng xuất</a>   
        </div>
    </header>
    <main>
    <h2>Danh sách đăng ký tiêm chủng</h2>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên Khách Hàng</th>
            <th>Ngày Sinh</th>
            <th>Dịch Vụ</th>
            <th>Ngày Đăng Ký</th>
            <th>Tạo phiếu khám sàng lọc</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['dob'])); ?></td>
            <td><?php echo $row['service']; ?></td>
            <td><?php echo date('d/m/Y H:i:s', strtotime($row['register_date'])); ?></td>
            <td>
                <a href="create_screening.php?id=<?php echo $row['id']; ?>">>></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    </main>
</body>
</html>
