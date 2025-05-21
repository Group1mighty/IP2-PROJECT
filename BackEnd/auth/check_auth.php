<?php
session_start();
require '../db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: ../dashbord.php");
    exit();
}

if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $stmt = $conn->prepare("SELECT user_id FROM remember_tokens WHERE token = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        if ($_GET['from']=== "course1") {
            $courseID=1;
            $stmt = $conn->prepare("SELECT user_id FROM enrollment WHERE course_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $courseID, $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows==0)
            {
                $course='GIT AND GIT HUB';
                $stmt = 'SELECT id FROM `courses` WHERE title= '.$course.';';
                $result = $conn->query($stmt);
                $stmt = $conn->prepare("INSERT INTO enrollment (user_id, course_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $_SESSION['user_id'], $result);
                $stmt->execute();
            }
            header("Location: ../dashbord.php");
        }
        else if($_GET['from']=="course2")
        {
            $courseID=2;
            $stmt = $conn->prepare("SELECT user_id FROM enrollment WHERE course_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $courseID, $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows==0)
            {
            $course='HTML';
            $stmt = 'SELECT id FROM `courses` WHERE title= '.$course.';';
            $result = $conn->query($stmt);
            $stmt = $conn->prepare("INSERT INTO enrollment (user_id, course_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $_SESSION['user_id'], $result);
            $stmt->execute();
            }
            header("Location: ../dashbord.php");
        }
        else if($_GET['from']=="course3")
        {
            $courseID=3;
            $stmt = $conn->prepare("SELECT user_id FROM enrollment WHERE course_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $courseID, $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows==0)
            {
            $course='CSS';
            $stmt = 'SELECT id FROM `courses` WHERE title= '.$course.';';
            $result = $conn->query($stmt);
            $stmt = $conn->prepare("INSERT INTO enrollment (user_id, course_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $_SESSION['user_id'], $result);
            $stmt->execute();
            }
            header("Location: ../dashbord.php");
        }
        else
        {
            header("Location: ../dashbord.php");
        }
        exit();
    }
}

header("Location: ../../FronEnd/homepage/signup/login.html?from=".$_GET['from']);
exit();
