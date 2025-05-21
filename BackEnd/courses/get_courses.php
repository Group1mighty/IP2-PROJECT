<?php require '../db.php';


$stmt = $conn->prepare("SELECT * FROM courses");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($user = $result->fetch_assoc())
    {
        echo'<article class="course-card">
                <h3 class="course-title">'.$user['title'].'</h3>
                <img src="'.$user['picture'].'" alt="'.$user['title'].'" />
                <div class="course-content">
                    <p class="course-description">
                        '.$user['discription'].'
                    </p>
                    <a href="../homepage/signup/signup.html" class="btn '.$user['title'].'">Enroll</a>
                </div>
            </article>';
    }
}
?>