<?php require '../db.php';
session_start();
$message = "";
$message_type = "";

// Check if there is a message in the session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];    
    $message_type = $_SESSION['message_type'];

    echo "
    <!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Sign Up or Login - eduSphere</title>
    <link rel=\"icon\" href=\"../../FronEnd/pictures/icon/tablogo.png\" type=\"image/png\">
    <link rel=\"stylesheet\" href=\"../../FronEnd/homepage/signup/signup.css\">
</head>
<body>
    <div class=\"container\">
     <div class=\"alert $message_type\">$message</div>
        <h2 id=\"form-title\">Login</h2>
            <form id=\"auth-form\" method=\"post\" action=\"login.php\">
                <div class=\"form-group\">
                    <label for=\"email\">Email</label>
                    <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Enter your email\" required>
                </div>
                <div class=\"form-group\">
                    <label for=\"password\">Password</label>
                    <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Enter your password\" required>
                </div>
              <input type=\"submit\" class=\"btn\" value=\"Login\">
            </form>
             <p class=\"toggle-link\" id=\"toggle-link\">Don't have an account? Sign Up</p>
            </div>
            </body>
<script src=\"../../FronEnd/homepage/signup/signup.js\"></script>
</html>";
    // Remove message after displaying it once
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
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
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set up session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['profile_picture']=$user['profile_pic'];
            $_SESSION['email']=$user['email'];
            $_SESSION['MSGTYPE']="";
            $_SESSION['MSG']="";
            // Redirect to the next page
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
        } else {
            $_SESSION['message'] = "Login failed. Please check your email and password and try again.";
            $_SESSION['message_type'] = "error";
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    } else {
        $_SESSION['message'] = "Login failed. Please check your email and password and try again.";
        $_SESSION['message_type'] = "error";
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}

?>
