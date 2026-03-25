<?php
include '../db.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    $conn->query("INSERT INTO users (name,email,password)
                  VALUES ('$name','$email','$pass')");

    header("Location: manage_students.php");
}
?>

<form method="POST">
    Name: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Password: <input type="password" name="password"><br>
    <button name="submit">Add</button>
</form>