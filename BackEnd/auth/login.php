<?php require '../db.php';
session_start();
$message = "";
$message_type = "";

// Check if there is a message in the session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch the user from the database based on e-mail
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['profile_picture']=$user['profile_pic'];
            $_SESSION['email']=$user['email'];
            $_SESSION['MSGTYPE']="";
            $_SESSION['MSG']="";
            if (!empty($_POST['remember'])) {
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 days
                $stmt = $conn->prepare("INSERT INTO remember_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $user['user_id'], $token, $expiry);
                $stmt->execute();
                setcookie("remember_token", $token, time() + (86400 * 30), "/", "", false, true);
            }            
            if ($_GET['from']=== "course1") {
                $courseID=1;
                $stmt = $conn->prepare("SELECT user_id FROM enrollment WHERE course_id = ? AND user_id = ?");
                $stmt->bind_param("ii", $courseID, $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows==0)
                {
                    $course='GIT AND GIT HUB';
                    $stmt = 'SELECT id FROM `courses` WHERE title= \''.$course.'\';';
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
                $stmt = 'SELECT id FROM `courses` WHERE title= \''.$course.'\';';
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
                $stmt = 'SELECT id FROM `courses` WHERE title= \''.$course.'\';';
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
        } else {
            $_SESSION['message'] = "Something went wrong. Please try again.";
            $_SESSION['message_type'] = "error";
            header("Location: " . '../../FronEnd/homepage/signup/login.html?from='. urlencode($_GET['from']).'&alertType=error&alertMessage=Login failed. Please check your email and password and try again.');
            exit();
        }
    } else {
        $_SESSION['message'] = "Login failed. Please check your email and password and try again.";
        $_SESSION['message_type'] = "error";
        header("Location: " . '../../FronEnd/homepage/signup/login.html?from='. urlencode($_GET['from']).'&alertType=error&alertMessage=Login failed. Please check your email and password and try again.');
            exit();
    }
}

?>
