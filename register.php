<?php 
include 'Include/db.php'; 
?>

<form method="POST">
<input type="text" name="name" placeholder="Name" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<button type="submit" name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=MD5($_POST['password']);

    $conn->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
    echo "Registered successfully";
}
?>