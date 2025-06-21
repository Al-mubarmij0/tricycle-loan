<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar">
    <div class="heading">TLMTS</div>
    <div class="nav-links">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="../rider/dashboard.php">Dashboard</a>
            <a href="../rider/my_rentals.php">My Rentals</a>
            <a href="../rider/logout.php">Logout</a>
        <?php else: ?>
            <a href="../public/index.php">Home</a>
            <a href="../public/register.php">Register</a>
            <a href="../public/login.php">Login</a>
        <?php endif; ?>
    </div>
</div>
