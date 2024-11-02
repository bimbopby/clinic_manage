<?php
include("includes/db_connect.php");
include("includes/auth.php");
authenticate("manager");

$error = '';
$success = '';

// Thêm dịch vụ
if (isset($_POST['add_service'])) {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];

    $query = "INSERT INTO services (name, price) VALUES ('$service_name', '$price')";
    if (mysqli_query($conn, $query)) {
        $success = "Thêm dịch vụ thành công!";
    } else {
        $error = "Lỗi khi thêm dịch vụ.";
    }
}

// Xóa dịch vụ
if (isset($_GET['delete'])) {
    $service_id = $_GET['delete'];
    $query = "DELETE FROM services WHERE id = $service_id";
    mysqli_query($conn, $query);
}

// Lấy danh sách dịch vụ
$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Dịch Vụ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">Logo</div>
        <div class="header-links">
            <a href="manage_dashboard.php">Trang chủ</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
    </header>
    <h2>Quản lý Dịch Vụ</h2>
    
    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php elseif ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <form action="manage_services.php" method="POST">
        <label>Tên Dịch Vụ:</label>
        <input type="text" name="service_name" required>
        
        <label>Giá:</label>
        <input type="number" name="price" required>
        
        <button type="submit" name="add_service">Thêm Dịch Vụ</button>
    </form>

    <h3>Danh sách Dịch Vụ</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên Dịch Vụ</th>
            <th>Giá bán lẻ/liều(VNĐ)</th>
            <th>Hành động</th>
        </tr>
        <?php while ($service = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $service['id']; ?></td>
            <td><?php echo $service['name']; ?></td>
            <td><?php echo $service['price']; ?></td>
            <td>
                <a href="manage_services.php?delete=<?php echo $service['id']; ?>">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
