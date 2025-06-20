
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rider Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --background: #f9f9f9;
            --text: #333;
            --white: #fff;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--background);
            color: var(--text);
        }

        .navbar {
            background-color: var(--secondary);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .brand {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar .nav-links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 500;
        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }

        .dashboard {
            max-width: 1000px;
            margin: 50px auto;
            background: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .dashboard h2 {
            margin-top: 0;
            color: var(--primary);
        }

        .dashboard a {
            display: inline-block;
            margin: 10px 10px 0 0;
            padding: 12px 18px;
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .dashboard a:hover {
            background-color: #2a80c4;
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar .nav-links {
                margin-top: 10px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .dashboard {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="brand">TLMTS Dashboard</div>
        <div class="nav-links">
            <a href="../public/index.php">Home</a>
            <a href="my_rentals.php">My Rentals</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="dashboard">
        <h2>Welcome to your dashboard!</h2>
        <p>Access your rental details, browse available tricycles, and manage your account.</p>

        <a href="../public/index.php">🚲 View Available Tricycles</a>
        <a href="my_rentals.php">📁 View My Rentals</a>
        <a href="logout.php">🔓 Logout</a>
    </div>

</body>
</html>