<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logged Out</title>
<style>
    /* General reset */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Georgia', serif; }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f4ecd8; /* vintage cream background */
        background-image: repeating-linear-gradient(
            45deg,
            rgba(200,180,150,0.05),
            rgba(200,180,150,0.05) 1px,
            transparent 1px,
            transparent 20px
        );
    }

    .logout-card {
        background: #fff8f0;
        padding: 40px 50px;
        border-radius: 12px;
        border: 2px solid #d2b48c;
        box-shadow: 5px 5px 15px rgba(150,120,90,0.3);
        text-align: center;
        width: 400px;
    }

    .logout-card h2 {
        color: #6b4c3b;
        font-family: 'Courier New', monospace;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .logout-card p {
        color: #4a2f1b;
        margin-bottom: 30px;
        font-size: 16px;
    }

    .logout-card a {
        text-decoration: none;
        color: #fff8f0;
        background-color: #e0c097;
        padding: 12px 25px;
        border-radius: 6px;
        border: 2px solid #c49a6c;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .logout-card a:hover {
        background-color: #d9a76c;
        color: #fff8f0;
        border-color: #b37a4c;
    }

    @media (max-width: 450px) {
        .logout-card { width: 90%; padding: 30px; }
    }
</style>
</head>
<body>

<div class="logout-card">
    <h2>You've Successfully Logged Out</h2>
    <p>Thank you for visiting. Click below to login again.</p>
    <a href="login.php">Login</a>
</div>

</body>
</html>