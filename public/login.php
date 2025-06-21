<!DOCTYPE html>
<html>
<head>
    <title>Rider Login</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .login-box {
            width: 400px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
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
        <h2>Rider Login</h2>
        <form method="POST" action="login_process.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required minlength="6">
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
