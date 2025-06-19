<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // Redirect to admin login page if not logged in
    header("Location: login.php");
    exit();
}
?>
