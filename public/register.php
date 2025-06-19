<!DOCTYPE html>
<html>
<head>
    <title>Rider Registration</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>
    <h2 style="text-align:center;">Register as Rider</h2>
    <form method="POST" action="register_process.php">
        <input type="text" name="full_name" placeholder="Full Name" required pattern="[A-Za-z ]+">
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="phone" placeholder="Phone" required pattern="[0-9]{11}">
        <input type="text" name="nin" placeholder="NIN" required minlength="11" maxlength="11">
        <input type="text" name="bvn" placeholder="BVN" required minlength="11" maxlength="11">
        <input type="password" name="password" placeholder="Password" required minlength="6">
        <button type="submit">Register</button>
    </form>
    <p style="text-align:center;">Already registered? <a href="login.php">Login</a></p>
</body>
</html>
