<?php
include("includes/auth.php");
include("includes/db_connect.php");

authenticate('manager');

// Thêm các chức năng quản lý dịch vụ, người dùng, và thống kê tại đây
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Manage Dashboard - Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">Logo</div>
        <div class="header-links">
        <a href="index.php">Trang chủ</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
    </header>
    <main>
    <h2>Bảng điều khiển quản lý</h2>
    <div class="tabs">
        <a href="manage_services.php">|Quản lý dịch vụ|</a>
        <a href="manage_users.php">|Quản lý người dùng|</a>
        <a href="report.php">|Thống kê|</a>
    
    </div>
    </main>
</body>
</html>
