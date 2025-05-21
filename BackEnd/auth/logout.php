<?php
require '../db.php';
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    
    // Remove token from database
    $stmt = $conn->prepare("DELETE FROM remember_tokens WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    // Expire cookie
    setcookie("remember_token", "", time() - 3600, "/");
}
session_start();
session_unset();    // Unset all session variables
session_destroy();  // Destroy the session
// Redirect to home page
header("Location:../../FronEnd/homepage/homeP.html");
exit();
?>