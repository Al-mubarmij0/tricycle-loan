<!DOCTYPE html>
<html>
<head>
    <title>Rider Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .login-box {
            width: 450px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .login-box button:hover {
            background: #2980b9;
        }

        .login-box p {
            text-align: center;
            margin-top: 15px;
        }

        .login-box a {
            color: #3498db;
            text-decoration: none;
        }

        .login-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Register as Rider</h2>
        <form method="POST" action="register_process.php">
            <input type="text" name="full_name" placeholder="Full Name" required pattern="[A-Za-z ]+">
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone (11 digits)" required pattern="[0-9]{11}">
            <input type="text" name="nin" placeholder="NIN (11 digits)" required minlength="11" maxlength="11">
            <input type="text" name="bvn" placeholder="BVN (11 digits)" required minlength="11" maxlength="11">
            <input type="password" name="password" placeholder="Password" required minlength="6">
            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
