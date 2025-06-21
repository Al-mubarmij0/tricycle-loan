<?php
include '../includes/db.php';

$id = $_GET['id'];
$status = $_GET['status'];

if (in_array($status, ['approved', 'rejected'])) {
    $conn->query("UPDATE rental_requests SET status='$status' WHERE id=$id");
}

header('Location: rental_requests.php');
exit;
