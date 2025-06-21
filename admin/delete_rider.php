<?php
session_start();
include '../includes/admin_session_check.php';
include '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_riders.php");
    exit;
}

$id = intval($_GET['id']);

// Optional: Prevent deleting admin accounts if they exist in the same table
$check = $conn->query("SELECT * FROM users WHERE id = $id");
if ($check->num_rows === 0) {
    header("Location: manage_riders.php?error=notfound");
    exit;
}

$delete = $conn->query("DELETE FROM users WHERE id = $id");

if ($delete) {
    header("Location: manage_riders.php?success=deleted");
} else {
    header("Location: manage_riders.php?error=failed");
}
exit;
