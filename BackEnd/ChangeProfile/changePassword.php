<?php
require '../db.php';
session_start();
$oldPassword="";
$newPassword="";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['current_password']) && isset($_POST['new_password']))
    {
    $userID=$_SESSION['user_id'];
    $oldPassword=$_POST['current_password'];
    $newPassword=password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?;");
        $stmt->bind_param("i",$userID);
        if(!$stmt->execute())
        {
            $_SESSION['MSG']="Error try again later!";
            $_SESSION['MSGTYPE']="bad";
            header ("Location: ../edit-profile.php");
            exit;
        }
        $result = $stmt->get_result();
        if($result->num_rows>0)
            {
                while ($row = $result->fetch_assoc()) 
                {
                    if (password_verify($oldPassword, $row['password'])) 
                    {
                        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id=? ;");
                        $stmt->bind_param("si", $newPassword, $userID);
                        if($stmt->execute())
                        {
                            $_SESSION['MSG']="You're Password has Been Changed Successfully";
                            $_SESSION['MSGTYPE']="good";
                            header ("Location: ../edit-profile.php");
                            exit;
                        }
                        else{
                            $_SESSION['MSG']="Error While tring to Update you're Password";
                            $_SESSION['MSGTYPE']="bad";
                            header ("Location: ../edit-profile.php");
                            exit;
                        }
                    }
                    else{
                            $_SESSION['MSG']="The Password you entered is Incorrect";
                            $_SESSION['MSGTYPE']="bad";
                            header ("Location: ../edit-profile.php");
                            exit;
                    }
                }
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
    
?>