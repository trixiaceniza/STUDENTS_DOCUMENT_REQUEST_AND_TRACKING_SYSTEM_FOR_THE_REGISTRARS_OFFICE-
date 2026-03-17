<?php
session_start();

// Check if user is logged in as student
if(!isset($_SESSION['role']) || $_SESSION['role'] != "student"){
    header("Location: ../../authentication/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>

<body>

    <h1>Student Dashboard</h1>

    <p>Welcome, Student!</p>

    <hr>

    <h3>Menu</h3>

    <a href="../request documents/add_req.php">
        Request Document
    </a>

    <br><br>

    <a href="../request documents/view_req.php">
        View My Requests
    </a>

    <br><br>

    <a href="../../authentication/logout.php">
        Logout
    </a>

</body>
</html>
```
