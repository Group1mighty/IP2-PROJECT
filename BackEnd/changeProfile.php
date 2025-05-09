<?php 
session_start();
require '../db.php';
$safeEmail="";
$safeName="";
$uploadFile="";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_FILES['profile_image']) || (isset($_POST['name']) && isset($_POST['email'])))
    {
    $userID=$_SESSION['user_id'];
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['MSG']="The email you entered is incorrect!!";
        $_SESSION['MSGTYPE']="bad";
        header ("Location: ../edit-profile.php");
        exit;
    }
    $safeEmail=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $safeName=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("UPDATE users SET profile_pic= ? WHERE user_id=? ;");
        $pp="";
        $stmt->bind_param("si",$pp,$userID);
        if(!$stmt->execute())
        {
            $_SESSION['MSG']="Error try again later!";
            $_SESSION['MSGTYPE']="bad";
            header ("Location: ../edit-profile.php");
            exit;
        }
        $_SESSION['profile_picture']="";
    }
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK)
    {
        $upload="../upload/";
        $uploadFile = $upload . basename($_FILES['profile_image']['name']);
        $file = $_FILES['profile_image'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 4 * 1024 * 1024;
        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['MSG']= "Invalid file type.";
            $_SESSION['MSGTYPE']="bad";
            header ("Location: ../edit-profile.php");
            exit;
            }
            
        if ($file['size'] > $maxSize) {
                $_SESSION['MSG']= "File size exceeds the limit. You can Upload upto 4MB Image";
                $_SESSION['MSGTYPE']="bad";
                header ("Location: ../edit-profile.php");
                exit;
            }
        
        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
            $_SESSION['MSG']= "Error while uploading the picture, please try Again later";
            $_SESSION['MSGTYPE']="bad";
            header ("Location: ../edit-profile.php");
            exit;
        }
        $stmt = $conn->prepare("UPDATE users SET user_name = ?, email = ?, profile_pic=? WHERE user_id=? ;");
        $stmt->bind_param("sssi",$safeName, $safeEmail, $uploadFile, $userID); 
    }
    else
    {
        // No file uploaded, just update name and email
        $stmt = $conn->prepare("UPDATE users SET user_name = ?, email = ? WHERE user_id=? ;");
        $stmt->bind_param("ssi", $safeName, $safeEmail, $userID);
    }
    if($stmt->execute())
    {
        $_SESSION['MSG']="You're Profile has Been Changed Successfully";
        $_SESSION['MSGTYPE']="good";
        $_SESSION['username'] = $safeName;
        $_SESSION['profile_picture']=$uploadFile;
        $_SESSION['email']=$safeEmail;
        header ("Location: ../edit-profile.php");
        exit;
    }
    else{
        $_SESSION['MSG']="Error While tring to Update you're Profile";
        $_SESSION['MSGTYPE']="bad";
        header ("Location: ../edit-profile.php");
        exit;
    }
}
    else
    {
        $_SESSION['MSG']="Complete the needed feilds!!";
        $_SESSION['MSGTYPE']="bad";
        header ("Location: ../edit-profile.php");
        exit;
    }
}
else 
    {
        $_SESSION['MSG']= "we have encountered a problem, try again later";
        $_SESSION['MSGTYPE']="bad";
        header ("Location: ../edit-profile.php");
        exit;
    }
?>