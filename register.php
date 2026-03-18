<?php
include('Include/db.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = strtolower($_POST['role']); // save lowercase

    $query = "INSERT INTO users (name, email, password, role)
              VALUES ('$name','$email','$password','$role')";

    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; background: linear-gradient(to right, #36d1dc, #5b86e5); }
        .box { width: 350px; margin: 80px auto; background: white; padding: 30px; border-radius: 10px; text-align: center; }
        input, select { width: 90%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: #4facfe; color: white; border: none; border-radius: 5px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Register</h2>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" name="register">Register</button>
    </form>

    <p><a href="login.php">Back to Login</a></p>
</div>

</body>
</html>