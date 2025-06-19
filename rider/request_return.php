<?php
include '../includes/session_check.php';
include '../includes/db.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ensure this rental belongs to the rider
$conn->query("UPDATE rental_requests 
              SET return_status = 'return_pending' 
              WHERE id = $id AND user_id = $user_id");

header("Location: my_rentals.php");
