<?php
session_start();
include('../../Include/db.php');

// Only students allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] != "student") {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial; background: linear-gradient(to right, #36d1dc, #5b86e5); color: #333; margin:0; padding:0; }
        header { background: #fff; padding:15px 30px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
        header a { padding:8px 12px; background:red; color:white; text-decoration:none; border-radius:5px; }
        main { padding:30px; }
        .menu a { display:block; margin:15px 0; padding:12px 15px; background:#fff; color:#333; text-decoration:none; border-radius:8px; width:250px; transition:.3s; }
        .menu a:hover { background:#4facfe; color:white; }
    </style>
</head>
<body>

<header>
    <h1>Student Dashboard</h1>
    
</header>

<main>
    <p>Welcome, <strong><?php echo htmlspecialchars($student_name); ?></strong> 👋</p>

    <div class="menu">
        <a href="Student/request_documents/add_req.php">Request Document</a>
        <a href="Student/request_documents/view_req.php">View My Requests</a>

       
    </div>
</main>

</body>
     <a href="../logout.php">Logout</a>
</html>