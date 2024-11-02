<?php
include("includes/db_connect.php");
include("includes/auth.php");

// Lấy ID từ tham số truyền vào
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Truy vấn để lấy thông tin phiếu đăng ký từ bảng register
    $query = "SELECT r.customer_name, r.service, s.name AS service_name, s.price 
              FROM register r 
              JOIN services s ON r.service = s.id 
              WHERE r.id = '$id'";
    $result = mysqli_query($conn, $query);

    // Debug: In ra truy vấn SQL để kiểm tra
    // echo $query;

    $record = mysqli_fetch_assoc($result);
    
    // Nếu không tìm thấy bản ghi, thông báo lỗi
    if (!$record) {
        die("Không tìm thấy phiếu đăng ký. (ID: $id)"); // Thêm ID để dễ kiểm tra
    }
} else {
    die("ID không hợp lệ.");
}

// Kiểm tra nếu người dùng đã nhấn nút tạo phiếu khám
if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $doctor = mysqli_real_escape_string($conn, $_POST['doctor']);
    $screen_time = mysqli_real_escape_string($conn, $_POST['screen_time']);
    
    // Thêm bản ghi vào bảng record
    $query = "INSERT INTO record (customer_name, service, screening, screen_time, doctor, inject_vaccine) 
              VALUES ('$customer_name', '$service', 0, '$screen_time', '$doctor', 0)";
              
    if (mysqli_query($conn, $query)) {
        echo "<p style='color: green;'>Phiếu khám sàng lọc đã được tạo thành công!</p>";
    } else {
        echo "<p style='color: red;'>Đã xảy ra lỗi: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Phiếu Khám Sàng Lọc</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="images/clinic_logo.png" alt="Logo Phòng Tiêm Chủng">
        <div class="header-links">
            <a href="dashboard.php">Quay lại</a>
        </div>
    </header>

    <main>
        <form action="create_screening.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
            <h2>Tạo Phiếu Khám Sàng Lọc</h2>
            
            <label>Tên Khách Hàng:</label>
            <p><?php echo htmlspecialchars($record['customer_name']); ?></p>
            
            <label>Dịch Vụ:</label>
            <p><?php echo htmlspecialchars($record['service_name']); ?> - <?php echo htmlspecialchars($record['price']); ?>.000 VND</p>
            
            <input type="hidden" name="customer_name" value="<?php echo htmlspecialchars($record['customer_name']); ?>">
            <input type="hidden" name="service" value="<?php echo htmlspecialchars($record['service']); ?>">
            
            <label for="doctor">Chỉ định bác sĩ:</label>
            <select id="doctor" name="doctor" required>
                <?php
                // Lấy danh sách bác sĩ từ bảng users, giả định rằng bác sĩ có role là 'doctor'
                $query = "SELECT id, fullname FROM users WHERE role = 'doctor'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['fullname']}'>{$row['fullname']}</option>";
                }
                ?>
            </select>
            
            <label for="screen_time">Thời Gian Khám:</label>
            <input type="datetime-local" id="screen_time" name="screen_time" required>
            
            <button type="submit" name="submit">Tạo Phiếu Khám</button>
        </form>
    </main>

    <footer>
        <p>Địa chỉ: 123 Đường ABC, TP XYZ | Số điện thoại: 0123 456 789</p>
    </footer>
</body>
</html>
