<?php
include("includes/db_connect.php");
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = md5($password);

    // Kiểm tra thông tin đăng nhập
    $query = "SELECT id, role FROM users WHERE username = '$username' AND password = '$hashed_password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Điều hướng tới trang chủ của role tương ứng
        switch ($user['role']) {
            case 'staff':
                header("Location: dashboard.php");
                break;
            case 'doctor':
                header("Location: screening.php");
                break;
            case 'nurse':
                header("Location: record_vaccination.php");
                break;
            case 'cashier':
                header("Location: record_payment.php");
                break;
            case 'manager':
                header("Location: manage_dashboard.php");
                break;
        }
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">Logo</div>
        <div class="header-links">
        <a href="index.php">Trang chủ</a>    
        </div>
    </header>
    <h2>Đăng nhập</h2>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
