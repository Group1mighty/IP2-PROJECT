<?php
session_start(); 
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim and sanitize inputs
    $username = trim(strip_tags($_POST['username']));
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    // ✅ Check for empty fields
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['message'] = "All fields are required.";
        $_SESSION['message_type'] = "error";
        header("Location: " . '../../FronEnd/homepage/signup/signup.html?from=' . urlencode($_GET['from']) . '&alertType=error&alertMessage=All fields are required.');
        exit();
    }

    // ✅ Username validation: max length and valid characters
    if (strlen($username) > 50 || !preg_match('/^[a-zA-Z0-9_ ]+$/', $username)) {
        $_SESSION['message'] = "Invalid username. Only letters, numbers, and underscores are allowed (max 50 characters).";
        $_SESSION['message_type'] = "error";
        header("Location: " . '../../FronEnd/homepage/signup/signup.html?from=' . urlencode($_GET['from']) . '&alertType=error&alertMessage=Invalid username. Only letters, numbers, and underscores are allowed (max 50 characters).');
        exit();
    }

    // ✅ Password validation: minimum 8 characters, at least 1 letter and 1 number
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $_SESSION['message'] = "Password must be at least 8 characters long and include both letters and numbers.";
        $_SESSION['message_type'] = "error";
        header("Location: " . '../../FronEnd/homepage/signup/signup.html?from=' . urlencode($_GET['from']) . '&alertType=error&alertMessage=Password must be at least 8 characters long and include both letters and numbers.');
        exit();
    }
    // Sanitize e-mail
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate e-mail format
    if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
        $_SESSION['message_type'] = "error";
        header("Location: " . '../../FronEnd/homepage/signup/signup.html?from='. urlencode($_GET['from']).'&alertType=error&alertMessage=Invalid email format.');
        exit(); // ✅ STOP here!
    } else {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $sanitizedEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['message'] = "User already exists. Please log in.";
            $_SESSION['message_type'] = "error";
            header("Location: " . '../../FronEnd/homepage/signup/signup.html?from='. urlencode($_GET['from']).'&alertType=error&alertMessage=User already exists. Please log in.');
            exit(); // ✅ STOP here!
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (user_name, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $sanitizedEmail);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Registration successful! You can now log in.";
                $_SESSION['message_type'] = "success"; 

                
            } else {
                $_SESSION['message'] = "Something went wrong. Please try again.";
                $_SESSION['message_type'] = "error";
                header("Location: " . '../../FronEnd/homepage/signup/signup.html?from='. urlencode($_GET['from']).'&alertType=error&alertMessage=User already exists. Please log in.');
                exit();
            }
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $sanitizedEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['profile_picture']=$user['profile_pic'];
            $_SESSION['email']=$user['email'];
            $_SESSION['MSGTYPE']="";
            $_SESSION['MSG']="";
            if ($_GET['from']=== "course1") {
                $courseID=1;
                $stmt = $conn->prepare("SELECT user_id FROM enrollment WHERE course_id = ? AND user_id = ?");
                $stmt->bind_param("ii", $courseID, $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows==0)
                {
                    $course = 'GIT AND GIT HUB';
                    $stmt = $conn->prepare("SELECT id FROM courses WHERE title = ?");
                    $stmt->bind_param("s", $course);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $courseRow = $result->fetch_assoc();
                    $courseID = $courseRow['id'];
                    $stmt = $conn->prepare("INSERT INTO enrollment (user_id, course_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $_SESSION['user_id'], $courseID);
                    $stmt->execute();
                }
                header("Location: ../dashbord.php?register=success");
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
                    $stmt = $conn->prepare("SELECT id FROM courses WHERE title = ?");
                    $stmt->bind_param("s", $course);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $courseRow = $result->fetch_assoc();
                    $courseID = $courseRow['id'];
                    $stmt = $conn->prepare("INSERT INTO enrollment (user_id, course_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $_SESSION['user_id'], $courseID);
                    $stmt->execute();
                }
                header("Location: ../dashbord.php?register=success");
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
                    $stmt = $conn->prepare("SELECT id FROM courses WHERE title = ?");
                    $stmt->bind_param("s", $course);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $courseRow = $result->fetch_assoc();
                    $courseID = $courseRow['id'];
                    $stmt = $conn->prepare("INSERT INTO enrollment (user_id, course_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $_SESSION['user_id'], $courseID);
                    $stmt->execute();
                }
                header("Location: ../dashbord.php?register=success");
            }
            else
            {
                header("Location: ../dashbord.php?register=success");
            }
            exit();
        }
        else {
                $_SESSION['message'] = "Something went wrong. Please try again.";
                $_SESSION['message_type'] = "error";
                header("Location: " . '../../FronEnd/homepage/signup/signup.html?from='. urlencode($_GET['from']).'&alertType=error&alertMessage=Something went wrong. Please try again.');
                exit();
        }
    }
    $conn->close();
      header("Location: ../dashbord.php?register=success");
        exit();
}
?>
