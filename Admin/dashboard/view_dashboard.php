<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../../authentication/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
</head>

<body>

<h1>Registrar Dashboard</h1>

<p>Welcome, Administrator</p>

<hr>

<h3>Menu</h3>

<a href="../manage_requests/view_requests.php">
View Student Requests
</a>

<br><br>

<a href="../../authentication/logout.php">
Logout
</a>

</body>
</html>