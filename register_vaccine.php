<?php
include("includes/db_connect.php");

// Kiểm tra nếu người dùng đã nhấn nút đăng ký
if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
   
    // Thêm bản ghi vào bảng register
    $query = "INSERT INTO register (customer_name, dob, service,gender) 
              VALUES ('$fullname', '$birthdate', '$service','$gender')";
              
    if (mysqli_query($conn, $query)) {
        echo "<p style='color: green;'>Đăng ký tiêm chủng thành công!</p>";
    } else {
        echo "<p style='color: red;'>Đã xảy ra lỗi: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tiêm chủng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="images/clinic_logo.png" alt="Logo Phòng Tiêm Chủng">
        <div class="header-links">
            <a href="index.php">Trang chủ</a>
        </div>
    </header>

    <main>
        <form action="register_vaccine.php" method="POST">
            <h2>Đăng ký tiêm chủng</h2>
            
            <label for="fullname">Họ và tên:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Họ và tên" required>
            
            <label for="gender">Giới tính:</label>
            <select id="gender" name="gender" required>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
            
            <label for="birthdate">Ngày sinh:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            
            <label for="service">Dịch vụ:</label>
            <select id="service" name="service" required>
                <?php
                include("includes/db_connect.php");
                $query = "SELECT * FROM services";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['name']} - {$row['price']}.000 VND</option>";
                }
                ?>
            </select>
            
            <button type="submit" name="submit">Đăng ký</button>
        </form>
    </main>

    <footer>
        <p>Địa chỉ: 123 Đường ABC, TP XYZ | Số điện thoại: 0123 456 789</p>
    </footer>
</body>
</html>

