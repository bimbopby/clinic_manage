<?php
session_start();

function authenticate($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != $role) {
        header("Location: login.php");
        exit();
    }
}
?>
