<?php
session_start();
include 'Include/db.php';

/*
This page checks if a user is logged in.
If logged in → redirect to their dashboard
If not logged in → redirect to login page
*/

if(!isset($_SESSION['user_id'])){
    header("Location: authentication/login.php");
    exit();
}

// Redirect based on role
if($_SESSION['role'] == "admin"){
    header("Location: admin/dashboard/dashboard.php");
    exit();
}

if($_SESSION['role'] == "student"){
    header("Location: student/dashboard/dashboard.php");
    exit();
}

?>

