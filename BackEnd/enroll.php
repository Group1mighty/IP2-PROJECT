<?php
require 'db.php';
session_start(); 
$title=$_GET['course_title'];
$stmt=$conn->prepare('SELECT id FROM courses WHERE title=?');
$stmt->bind_param("s",$title);
$stmt->execute();
$result=$stmt->get_result();
if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $id=$row['id'];
    }
$stmt=$conn->prepare('INSERT INTO enrollment (user_id, course_id) VALUES (?, ?);');
$stmt->bind_param("ii",$_SESSION['user_id'],$id);
$stmt->execute();
header("Location: dashbord.php");
exit;
?>