<?php
require '../db.php';
session_start();
$_SESSION['LESSON_course_id'] = $_GET['course_id'];
$stmt = $conn->prepare("SELECT id ,title, content, link  FROM lessons WHERE course_id = ?;");
$stmt->bind_param("i", $_GET['course_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($lesson = $result->fetch_assoc()) {
        echo '<li>
                <div class="separate">' . $lesson['title'] . '</div>
                <p>' . $lesson['content'] . '</p>
                <p class="gotolesson"><a href="' . $lesson['link'] . '?id=' . $lesson['id'] . '" target="_top">go to lesson</a></p>
            </li>';
    }
} else {
    echo '<li>
            <div class="separate">No lessons found...</div>
        </li>';
}
