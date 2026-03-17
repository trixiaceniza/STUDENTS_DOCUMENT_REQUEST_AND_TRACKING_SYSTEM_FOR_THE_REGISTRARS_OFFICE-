<?php
session_start();
include 'db.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

// Handle form submission
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "User not found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logingfgfgrf</title>
<style>
    /* General reset */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to right, #eafe4f49, #fe6600);
    }

    .login-card {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        width: 350px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        text-align: center;
    }

    .login-card h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-card input[type="email"],
    .login-card input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .login-card input[type="submit"] {
        width: 100%;
        padding: 12px;
        margin-top: 15px;
        border: none;
        border-radius: 5px;
        background-color: #4ffec7;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .login-card input[type="submit"]:hover {
        background-color: #00f2fe;
    }

    .login-card .error {
        color: red;
        margin-bottom: 10px;
    }

    .login-card .register-link {
        margin-top: 15px;
        font-size: 14px;
    }

    .login-card .register-link a {
        color: #4ffea1;
        text-decoration: none;
        font-weight: bold;
    }

    .login-card .register-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 400px) {
        .login-card {
            width: 90%;
            padding: 30px;
        }
    }
</style>
</head>
<body>

<div class="login-card">
    <h2>Student Login</h2>
    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <div class="register-link">
        Don't have an account? <a href="register.php">Register here</a>
    </div>
</div>

</body>
</html>