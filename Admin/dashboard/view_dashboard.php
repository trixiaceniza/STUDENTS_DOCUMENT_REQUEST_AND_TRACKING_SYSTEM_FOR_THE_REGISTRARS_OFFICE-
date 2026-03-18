<?php
session_start();

// Only allow admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: login.php");
    exit();
}

$admin_name = "Administrator"; // You can replace with $_SESSION['name'] if stored
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #47fff6, #aec2e0);
            margin: 0;
            padding: 0;
        }

        header {
            background: #fff;
            padding: 20px 30px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        header h1 {
            margin: 0;
            color: #333;
        }

        main {
            text-align: center;
            padding: 50px 20px;
        }

        .welcome {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .menu a {
            display: block;
            width: 250px;
            padding: 15px;
            text-decoration: none;
            color: #333;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .menu a:hover {
            background: #1cddff;
            color: white;
        }

        .logout-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 8px 15px;
            background: #4bb7ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #3945e6;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            color: #fff;
        }
    </style>
</head>
<body>

<header>
    <h1>Registrar Dashboard</h1>
</header>

<main>
    <p class="welcome">Welcome, <strong><?php echo htmlspecialchars($admin_name); ?></strong> 👋</p>

    <div class="menu">
        <a href="../manage_requests/view_requests.php">View Student Requests</a>
        <!-- Add more menu items here if needed -->
    </div>

    <!-- Small Logout Button -->
    <a href="../logout.php" class="logout-btn">Logout</a>
</main>

<footer>
    <p>© 2026 ICAS Portal</p>
</footer>

</body>
</html>