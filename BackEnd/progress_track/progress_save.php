<?php 
session_start();
require '../db.php';

if (isset($_GET['saveto'])) {
    $user_id = $_SESSION['user_id'];
    if ($_GET['saveto'] == 'lesson') {
        $lesson_id = $_GET['id'];
        $course_id= $_GET['course_id'];
        // Check if entry already exists
        $check = $conn->prepare("SELECT id FROM user_lesson_views WHERE user_id = ? AND lesson_id = ?;");
        $check->bind_param("ii", $user_id, $lesson_id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows == 0) {
            // Insert only if it doesn't exist
            $stmt = $conn->prepare("INSERT INTO user_lesson_views(user_id, lesson_id,course_id) VALUES (?, ?, ?);");
            $stmt->bind_param("iii", $user_id, $lesson_id,$course_id);
            $stmt->execute();
        }
        $check->close();
    }

    if ($_GET['saveto'] == 'question') {
        $stmt=$conn->prepare("SELECT id FROM questions WHERE correct_option =?;");
        $stmt->bind_param("s", $_GET['dif']);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_assoc();
        $question_id=$row['id'];
        echo 'the quetion id is '.$question_id.' for '.$_GET['dif'];
        $stmt->close();
        // Check if entry already exists
        $check = $conn->prepare("SELECT id FROM user_question_attempts WHERE user_id = ? AND question_id = ?;");
        $check->bind_param("ii", $user_id, $question_id);  // assuming $lesson_id is actually question_id here
        $check->execute();
        $check->store_result();
        if ($check->num_rows == 0) {
            // Insert only if it doesn't exist
            $stmt = $conn->prepare("INSERT INTO user_question_attempts(user_id, question_id) VALUES (?, ?);");
            $stmt->bind_param("ii", $user_id, $question_id);
            $stmt->execute();
        }
        $check->close();
    }
    if($_GET['saveto']=='course')
    {
        $course_id = $_GET['id'];
        // Check if entry already exists
        $check = $conn->prepare("SELECT id FROM user_course_completion WHERE user_id = ? AND course_id = ?;");
        $check->bind_param("ii", $user_id, $course_id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows == 0) {
            // Insert only if it doesn't exist
            $stmt = $conn->prepare("INSERT INTO user_course_completion(user_id, course_id) VALUES (?, ?);");
            $stmt->bind_param("ii", $user_id, $course_id);
            $stmt->execute();
        }
        $check->close();
    }
}
?>
