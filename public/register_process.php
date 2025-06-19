<?php
include '../includes/db.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$nin = $_POST['nin'];
$bvn = $_POST['bvn'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if email already exists
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "Email already exists. <a href='register.php'>Try again</a>";
} else {
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, nin, bvn, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $email, $phone, $nin, $bvn, $password);
    $stmt->execute();
    echo "Registration successful. <a href='login.php'>Login now</a>";
}
?>
