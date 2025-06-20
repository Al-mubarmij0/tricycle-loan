
<!DOCTYPE html
<html>
<head>
    <title>Rider Login</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>
    <h2 style="text-align:center;">Rider Login</h2>
    <form method="POST" action="login_process.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required minlength="6">
        <button type="submit">Login</button>
    </form>
    <p style="text-align:center;">Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>
