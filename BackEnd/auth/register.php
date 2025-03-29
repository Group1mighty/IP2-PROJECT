<?php
session_start(); // Start a session
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "User already exists. Please log in.";
        $_SESSION['message_type'] = "error";
    } else {
        // Hash password and insert user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (user_name, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful! You can now log in.";
            $_SESSION['message_type'] = "success"; 
        } else {
            $_SESSION['message'] = "Something went wrong. Please try again.";
            $_SESSION['message_type'] = "error";
        }
    }
    $stmt->close();
    $conn->close();
    // Redirect back to login page
    /*header("Location: ../../FronEnd/homepage/signup/signup.html?from=course1");
    exit();*/
// After successful registration logic
    ;
      // You can now use this variable for redirection or other logic
      header("Location: ./login.php?from=" . urlencode($_GET['from']));
        exit();

}
?>
