<?php require 'db.php';
// Fetch four random comments
$sql = "SELECT username, comment_text,photo_url FROM comments ORDER BY RAND() LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="testimonial">
                <div class="personel">
                    <img src="' . htmlspecialchars($row['photo_url']) . '" class="person">
                    <p class="name">' . htmlspecialchars($row['username']) . '</p>
                </div>
                <div class="review">
                    <h4>Review</h4>
                    <p>"' . htmlspecialchars($row['comment_text']) . '"</p>
                </div>
            </div>';
    }
} else {
    echo "<p>No comments available.</p>";
}
$conn->close();
?>
