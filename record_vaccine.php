<?php
include("includes/auth.php");
include("includes/db_connect.php");

authenticate('nurse');

$query = "SELECT record.id, users.username, services.name AS service_name, record.status 
          FROM record 
          JOIN register ON record.register_id = register.id 
          JOIN users ON register.user_id = users.id 
          JOIN services ON register.service_id = services.id 
          WHERE record.status = 'pending'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Vaccination Record - Nurse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<header>
        <div class="logo">Logo</div>
        <div class="header-links">
            <a href="logout.php">Đăng xuất</a>
        </div>
    </header>
<h2>Danh sách phiếu tiêm cần hoàn thành</h2>
    <table>
        <tr>
            <th>Tên khách hàng</th>
            <th>Dịch vụ</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['service_name']; ?></td>
                <td><?php echo $row['status'] == 'pending' ? 'Chưa hoàn thành' : 'Đã hoàn thành'; ?></td>
                <td>
                    <?php if ($row['status'] == 'pending'): ?>
                        <form action="complete_vaccination.php" method="POST">
                            <input type="hidden" name="record_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Hoàn thành</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
