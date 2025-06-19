<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tricycle_id = $_POST['tricycle_id'];
$rental_duration_id = $_POST['rental_duration_id'];

$stmt = $conn->prepare("INSERT INTO rental_requests (user_id, tricycle_id, rental_duration_id) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $user_id, $tricycle_id, $rental_duration_id);
$stmt->execute();

echo "Booking submitted successfully. <a href='../rider/dashboard.php'>Go to Dashboard</a>";
