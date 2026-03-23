<?php
session_start();
if(isset($_SESSION['role'])){
    if($_SESSION['role']=='admin'){
        header("Location: Admin/dashboard/view_dashboard.php");
    } else {
        header("Location: Student/dashboard/view_dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<style>
body {font-family: Arial; display:flex; justify-content:center; align-items:center; height:100vh;}
.container {border:1px solid #ccc; padding:20px; width:300px;}
</style>

</head>

<body>
<div class="container">

<h2>Login</h2>

<form method="POST" action="login.php">
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button type="submit">Login</button>

</form>

<p>No account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
