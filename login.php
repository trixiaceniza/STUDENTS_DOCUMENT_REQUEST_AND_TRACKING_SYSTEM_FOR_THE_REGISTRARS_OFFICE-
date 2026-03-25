<?php
session_start();
include 'Include/db.php';

// Prevent direct access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$email = $_POST['email'] ?? '';
$password = md5($_POST['password'] ?? '');

$stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role'] = $row['role'];

    if($row['role']=='admin'){
        header("Location: Admin/view_dashboard.php");
        exit();
    } else {
        header("Location: Student/view_dashboard.php");
        exit();
    }
} else {
    echo "Invalid login";
}
?>