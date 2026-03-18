<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy session and cookie
if (session_id() != "" || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}
session_destroy();

// Prevent browser caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to index.php after logout
header("Location: index.php");
exit();