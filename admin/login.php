<form method="POST" action="login.php">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Example: hardcoded admin credentials
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin_id'] = 1; // Arbitrary value to represent logged-in admin
        header("Location: dashboard.php");
    } else {
        echo "Invalid credentials.";
    }
}
?>
