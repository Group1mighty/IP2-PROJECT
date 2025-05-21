<?php
session_start();
require './db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_SESSION['username'];
$comment = $_POST['comment'];
$photoUrl = isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture'])
    ? $_SESSION['profile_picture']
    : '../pictures/person.png';
    if (!empty($username) && !empty($comment)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO comments (username, comment_text, photo_url) VALUES (?, ?, ?);");
        $stmt->bind_param("sss", $username, $comment, $photoUrl);
        if ($stmt->execute()) {
            header("Location: ./dashbord.php?alertMessage=you're comment has been added&alertType=good");
            exit();
        } else {
            header("Location: ./dashbord.php?alertMessage=error couldnt add you're comment&alertType=bad");
            exit();
        }

        $stmt->close();
    } 
    else {
        header("Location: ./dashbord.php?alertMessage=Please add comment first&alertType=bad");
        exit();
    }
}
else{
    header("Location: ./dashbord.php?alertMessage=error couldnt add you're comment&alertType=bad");
    exit();
}
?>