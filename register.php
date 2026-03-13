<?php
session_start();
include 'db.php'; // your DB connection

$error = '';
$success = '';

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email is already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "Registration successful! <a href='login.php'>Login here</a>.";
            } else {
                $error = "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
    /* Fonts & reset */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Georgia', serif; }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f4ecd8; /* vintage cream background */
        background-image: repeating-linear-gradient(
            45deg,
            rgba(200,180,150,0.05),
            rgba(200,180,150,0.05) 1px,
            transparent 1px,
            transparent 20px
        );
    }

    .register-card {
        background: #fff8f0;
        padding: 40px;
        border-radius: 12px;
        width: 360px;
        box-shadow: 5px 5px 15px rgba(150,120,90,0.3);
        border: 2px solid #d2b48c;
        text-align: center;
    }

    .register-card h2 {
        margin-bottom: 20px;
        color: #6b4c3b;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
    }

    .register-card input[type="text"],
    .register-card input[type="email"],
    .register-card input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border-radius: 6px;
        border: 1px solid #c49a6c;
        background-color: #fdf2e9;
        font-family: 'Georgia', serif;
    }

    .register-card input[type="submit"] {
        width: 100%;
        padding: 12px;
        margin-top: 15px;
        border: 2px solid #c49a6c;
        border-radius: 6px;
        background-color: #e0c097;
        color: #4a2f1b;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .register-card input[type="submit"]:hover {
        background-color: #d9a76c;
        color: #fff8f0;
        border-color: #b37a4c;
    }

    .register-card .error { color: #b71c1c; margin-bottom: 10px; }
    .register-card .success { color: #2e7d32; margin-bottom: 10px; }

    .register-card .login-link {
        margin-top: 15px;
        font-size: 14px;
    }

    .register-card .login-link a {
        color: #6b4c3b;
        text-decoration: none;
        font-weight: bold;
    }

    .register-card .login-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 400px) {
        .register-card { width: 90%; padding: 30px; }
    }
</style>
</head>
<body>

<div class="register-card">
    <h2>Create Account</h2>
    <?php
        if ($error) echo "<div class='error'>$error</div>";
        if ($success) echo "<div class='success'>$success</div>";
    ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <input type="submit" name="register" value="Register">
    </form>
    <div class="login-link">
        Already have an account? <a href="login.php">Login here</a>
    </div>
</div>

</body>
</html>