<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar">
    <div class="heading">TLMTS</div>
    <div class="nav-links">
        <a href="../public/index.php">Home</a>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="../public/register.php">Register</a>
            <a href="../public/login.php">Login</a>
        <?php else: ?>
            <a href="../rider/dashboard.php">Dashboard</a>
            <a href="../rider/logout.php">Logout</a>
        <?php endif; ?>
    </div>
</div>
