<?php
include("includes/db_connect.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý phòng tiêm chủng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="images/clinic_logo.png" alt="Logo Phòng Tiêm Chủng">
        <div class="header-links">
            <a href="register_vaccine.php">Đăng ký tiêm chủng</a>    
            <a href="login.php">Đăng nhập</a>   
        </div>
    </header>

    <main>
        <h1>Dịch vụ tiêm chủng</h1>
        <table>
            <tr>
                <th>Dịch vụ</th>
                <th>Giá bán lẻ/liều(VNĐ)</th>
            </tr>
            <?php
            $query = "SELECT * FROM services";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>{$row['name']}</td><td>{$row['price']}.000 VND</td></tr>";
            }
            ?>
        </table>
    </main>

    <footer>
        <p>Địa chỉ: 123 Đường ABC, TP XYZ | Số điện thoại: 0123 456 789</p>
    </footer>
</body>
</html>
