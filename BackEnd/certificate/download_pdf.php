<?php
session_start();
require '../db.php';

// Get the user and course ID securely
$userId = $_SESSION['user_id'] ?? null;
$courseId = $_GET['id'] ?? null;

if (!$userId || !$courseId) {
    die("Missing user or course ID.");
}

// Query database
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

$imagePath = '../../FronEnd/pictures/icon/result.png';
$imageData = base64_encode(file_get_contents($imagePath));
$src = 'data:image/png;base64,' . $imageData;

$html='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eduSphere Certificate</title>
    <style>
    @import url(\'https://fonts.googleapis.com/css?family=Poppins:200i,400&display=swap\');
    @import url(\'https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap\');
    * {
    box-sizing: border-box;
    }

    body {
        font-family: \'Poppins\', sans-serif;
        background: #f7f9fc;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction:column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .certificate {
        width: 1000px; /* matches aspect ratio of A4 landscape */
        max-width: 100%;
        margin: 0 auto;
        padding: 40px;
        border: 10px solid #0056b3;
        background:linear-gradient(45deg,rgba(0,123,255,45%),white);
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        page-break-inside: avoid;
        overflow: hidden;
    }
    .certificate img {
        width: 200px;
        margin-bottom: 20px;
    }
    .certificate h1 {
        
        font-size: 2.5em;
        margin-bottom: 10px;
        color: #007bff;
    }
    .certificate h2 {
        font-size: 1.8em;
        margin: 20px 0;
    }
    .certificate p {
        font-size: 1.2em;
        margin: 10px 0;
        color: #333;
    }
    .signatures {
        display: flex;
        justify-content: right;
        margin-top: 40px;
    }
    .signature {
        text-align: center;
        font-family: \'Great Vibes\', cursive;
        font-size: 24px;
    }
    .title{
        font-family: \'Poppins\', sans-serif;
        font-size:15px !important;
    }
    .signature-line {
        border-top: 2px solid #333;
        width: 200px;
        margin: 0 auto 10px;
    }
    </style>
</head>
<body>
<div class="certificate">
    <img src="'.$src.'" alt="eduSphere Logo" >
    <h1>Certificate of Achievement</h1>
    <p>This certificate is awarded to:</p>
    <h2>'.$studentName.'</h2>
    <p>For successfully completing the course:</p>
    <h2>'.$courseTitle.'</h2>
    <p>Issued by: <strong>eduSphere E-Learning Platform</strong></p>
    <p>Date: <strong>'.$completedDate.'</strong></p>
    <div class="signatures">
    <div class="signature">
        <div class="signature-line"></div>
        <p>Group One</p>
        <p class="title">Founder, eduSphere</p>
    </div>
    </div>
</div>
</body>
</html>
';
$api_key='sk_5e05f0cf922581c93a8862ab496ec4390524bf06';
$data = json_encode([
    'source' => $html,
    'use_print' => false
]);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pdfshift.io/v3/convert/pdf",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array(
        "source" => "$html",
        "use_print" => false
    )),
    CURLOPT_HTTPHEADER => array('X-API-Key:'.$api_key, 'Content-Type:application/json')
));

$response = curl_exec($curl);
$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($http_status === 200) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="certificate.pdf"');
    echo $response;
    exit;
} else {
    echo "Failed to generate PDF. HTTP Status: $http_status";
}
?>