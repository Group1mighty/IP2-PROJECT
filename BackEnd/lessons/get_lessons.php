<?php
require '../db.php';
session_start();
$_SESSION['LESSON_course_id']=$_GET['course_id'];
$completed=$_GET['completed'];
/*if($completed=='true')
{
    echo'<li>
                <div class="separate">Certificate of Completion</div>
                <p>Download your certificate to showcase your achievements</p>
                <p class="gotolesson"><a href="../certifificate/cirtificate.php" target="_top">go to Certificate</a></p>
            </li>';
    exit;
}*/
$stmt=$conn->prepare("SELECT id ,title, content, link  FROM lessons WHERE course_id = ?;");
$stmt->bind_param("i", $_GET['course_id']);
$stmt->execute();
$result = $stmt->get_result();

$stmt2=$conn->prepare("SELECT lesson_id FROM user_lesson_views WHERE user_id= ? AND course_id= ?;");
$stmt2->bind_param("ii",$_SESSION['user_id'],$_GET['course_id']);
$stmt2->execute();
$result2=$stmt2->get_result();
$visitedlessons=array();
while($lesson2=$result2->fetch_assoc())
{
    $visitedlessons[]=$lesson2['lesson_id'];
}
if($result->num_rows>0)
{
    while($lesson=$result->fetch_assoc())
    {
        if($completed=='true' && $lesson['title']=='Final Test')
        {
        echo '<li>
            <div class="separate">'.$lesson['title'].'</div>
            <p>You have completed the final test. you can view you\'re Certificate Below.</p>
            <div class="badge-wrapper">
                <p class="badge">Completed</p>
            </div>
            </li>';
            continue;
            }
        if(in_array($lesson['id'], $visitedlessons))
        {
                echo '<li>
                    <div class="separate">'.$lesson['title'].'</div>
                    <p>'.$lesson['content'].'</p>
                    <div class="badge-wrapper">
                        <p class="badge">Completed</p>
                    </div>
                    <p class="gotolesson"><a href="'.$lesson['link'].'?id='.$lesson['id'].'&completed='.$completed.'" target="_top">go to lesson</a></p>
                </li>';
        }
        else 
        {
        echo'<li>
                <div class="separate">'.$lesson['title'].'</div>
                <p>'.$lesson['content'].'</p>
                <p class="gotolesson"><a href="'.$lesson['link'].'?id='.$lesson['id'].'&completed='.$completed.'" target="_top">go to lesson</a></p>
            </li>';
        }
    }
    echo'<li>
                <div class="separate">Certificate of Completion</div>
                <p>Download your certificate to showcase your achievements</p>
                <p class="gotolesson"><a href="../../../BackEnd/certificate/cirtificate.php?id='.$_SESSION['LESSON_course_id'].'" class="certificate" target="_top">go to Certificate</a></p>
            </li>';
}
else{
    echo'<li>
            <div class="separate">No lessons found...</div>
        </li>';
}

?>