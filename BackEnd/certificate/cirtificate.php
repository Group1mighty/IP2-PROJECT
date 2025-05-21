<?php
session_start();
require '../db.php';
$userId = $_SESSION['user_id'];
$courseId = $_GET['id'] ?? null;
if (!$courseId) {
    die("Course ID missing.");
}
$sql = "SELECT tr.score, tr.passed, tr.completed_at, c.title, u.user_name 
        FROM test_result tr
        JOIN courses c ON tr.course_id = c.id
        JOIN users u ON tr.user_id = u.user_id
        WHERE tr.user_id = ? AND tr.course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $courseId);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data || !$data['passed']) {
    die("You have not passed this course or no record found.");
}

$studentName = htmlspecialchars($data['user_name']);
$courseTitle = htmlspecialchars($data['title']);
$completedDate = date("F j, Y", strtotime($data['completed_at']));
function getCurrentUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
                 || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host     = $_SERVER['HTTP_HOST'];
    $uri      = $_SERVER['REQUEST_URI'];

    return $protocol . $host . $uri;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eduSphere Certificate</title>
    <link rel="stylesheet" href="./certificate.css">
    <link rel="icon" href="../../FronEnd/pictures/icon/result.png">
</head>
<body>
<div class="certificate">
    <img src="../../FronEnd/pictures/icon/result.png" alt="eduSphere Logo" >
    <h1>Certificate of Achievement</h1>
    <p>This certificate is awarded to:</p>
    <h2><?= $studentName ?></h2>
    <p>For successfully completing the course:</p>
    <h2><?= $courseTitle ?></h2>
    <p>Issued by: <strong>eduSphere E-Learning Platform</strong></p>
    <p>Date: <strong><?= $completedDate ?></strong></p>
    <div class="signatures">
    <div class="signature">
        <div class="signature-line"></div>
        <p>Group One</p>
        <p class="title">Founder, eduSphere</p>
    </div>
    </div>
</div>
<div class="certificate-actions" style="margin-top: 30px; text-align: center;">
    <button onclick="window.print()" class="btn-print">Print Certificate</button>
    <button id="download-pdf" onclick="downloadPDF()" class="btn-download">Download as PDF</button>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</body>
<script>
    function downloadPDF() {
    window.location.href = "download_pdf.php?id=<?= $courseId ?>";
}
</script>
<script src="./certificate.js"></script>
</html>


