<?php

session_start();
include '../Include/connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role'] = $row['role'];

    if($row['role'] == "admin"){
        header("Location: ../Admin/dashboard/view_dashboard.php");
    }
    else{
        header("Location: ../Student/dashboard/view_dashboard.php");
    }

}else{

    echo "Invalid Username or Password";

}

?>