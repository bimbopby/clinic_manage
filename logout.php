<?php
session_start();
session_destroy();  // Hủy session hiện tại
header("Location: login.php");  // Chuyển hướng về trang đăng nhập
exit();
?>
