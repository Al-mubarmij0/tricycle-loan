<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM tricycles WHERE id = $id");
}

header("Location: manage_tricycles.php");
exit;
