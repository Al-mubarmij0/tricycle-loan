<?php
include '../includes/db.php';

$id = $_POST['id'] ?? null;

if ($id) {
    $conn->query("UPDATE rental_requests SET return_status='returned' WHERE id=$id");
    // Optionally, update tricycle status to 'available'
    $tricycle_id = $conn->query("SELECT tricycle_id FROM rental_requests WHERE id=$id")->fetch_row()[0];
    $conn->query("UPDATE tricycles SET status='available' WHERE id=$tricycle_id");
}

header('Location: return_requests.php');
exit;
