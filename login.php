<?php
session_start();
include('Include/db.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password == $user['password']) { // Plain password for now
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = strtolower($user['role']); // lowercase for consistency
            $_SESSION['name'] = $user['name'];

            if ($_SESSION['role'] == 'admin') {
                header("Location: Admin/dashboard/view_dashboard.php");
            } else {
                header("Location: Student/dashboard/view_dashboard.php");
            }
            exit();
        } else {
            $error = "Incorrect password!";
        }

    } else {
        $error = "User not found!";
        $showRegister = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; background: linear-gradient(to right, #4facfe, #00f2fe); }
        .box { width: 350px; margin: 100px auto; background: white; padding: 30px; border-radius: 10px; text-align: center; }
        input { width: 90%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: #4facfe; color: white; border: none; border-radius: 5px; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<div class="box">
    <h2>Login</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <?php if (isset($showRegister)) { ?>
        <p>No account? <a href="register.php">Register here</a></p>
    <?php } ?>
</div>

</body>
</html>