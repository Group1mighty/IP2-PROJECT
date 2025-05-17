<?php
require '../db.php';
session_start();
$userId = $_SESSION['user_id'];
$courseId = $_GET['id'];
$score = $_POST['score'];
$passed = $score >= 10 ? 1 : 0;
$completedAt = date('Y-m-d');

// 1. Check if the user already has a result for this course
$sql = "SELECT id FROM test_result WHERE user_id = ? AND course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $courseId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User already took the test — update
    $sql = "UPDATE test_result SET score = ?, passed = ?, completed_at = ? WHERE user_id = ? AND course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisii", $score, $passed, $completedAt, $userId, $courseId);
} else {
    // User hasn't taken the test — insert
    $sql = "INSERT INTO test_result (user_id, course_id, score, passed, completed_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiis", $userId, $courseId, $score, $passed, $completedAt);
}

$stmt->execute();
$stmt->close();
