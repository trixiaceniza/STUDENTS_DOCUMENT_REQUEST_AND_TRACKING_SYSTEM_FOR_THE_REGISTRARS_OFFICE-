<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: Admin/dashboard/view_dashboard.php");
        exit();
    } else if ($_SESSION['role'] == 'student') {
        header("Location: Student/dashboard/view_dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academic Outcome Portal</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #333;
        }
        .container {
            text-align: center;
            padding: 100px 20px;
        }
        h1 {
            color: white;
            font-size: 40px;
        }
        p {
            color: white;
            font-size: 18px;
        }
        .card-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
        }
        .card {
            background: white;
            padding: 30px;
            width: 250px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card h2 {
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background: #4facfe;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
        .btn:hover {
            background: #007bff;
        }
        .register-link {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
        footer {
            margin-top: 100px;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>STUDENT'S DOCUMENT REQUEST</h1>
    <p>Select your role to continue</p>

    <div class="card-container">
        <!-- Student Card -->
        <div class="card">
            <h2>Student</h2>
            <p>Access your records, grades, and profile</p>
            <a href="login.php?role=student" class="btn">Student Login</a>
            <a href="register.php" class="register-link">Don't have an account? Register here</a>
        </div>

        <!-- Admin Card -->
        <div class="card">
            <h2>Admin</h2>
            <p>Manage students and system data</p>
            <a href="login.php?role=admin" class="btn">Admin Login</a>
            <a href="register.php" class="register-link">Don't have an account? Register here</a>
        </div>
    </div>

    <footer>
        <p>© 2026 ICAS Portal</p>
    </footer>
</div>
</body>
</html>