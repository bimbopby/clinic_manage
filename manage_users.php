<?php
include("includes/db_connect.php");
include("includes/auth.php");
authenticate("manager");

$error = '';
$success = '';

// Thêm người dùng
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    if (mysqli_query($conn, $query)) {
        $success = "Thêm người dùng thành công!";
    } else {
        $error = "Lỗi khi thêm người dùng.";
    }
}

// Xóa người dùng
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE id = $user_id";
    mysqli_query($conn, $query);
}

// Lấy danh sách người dùng
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Người Dùng</title>
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
    <h2>Quản lý Người Dùng</h2>
    
    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php elseif ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <form action="manage_users.php" method="POST">
        <label>Tên đăng nhập:</label>
        <input type="text" name="username" required>
        
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        
        <label>Vai trò:</label>
        <select name="role">
            <option value="staff">Nhân viên</option>
            <option value="doctor">Bác sĩ</option>
            <option value="cashier">Thu ngân</option>
            <option value="manager">Quản lý</option>
            <option value="nurse">Y tá</option>
        </select>
        
        <button type="submit" name="add_user">Thêm Người Dùng</button>
    </form>

    <h3>Danh sách Người Dùng</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td>
                <a href="manage_users.php?delete=<?php echo $user['id']; ?>">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
