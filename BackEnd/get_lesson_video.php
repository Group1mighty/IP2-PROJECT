<?php 
$id=$_GET['id'];
require '../db.php';
$stmt=$conn->prepare("SELECT video_URL FROM lesson_video WHERE lesson_id = ?;");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0)
{
    while($link=$result->fetch_assoc())
    {
        echo '<iframe
            src="'.$link['video_URL'].'"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>';
    }
}
else{
    echo'<li>
            <div class="separate">No Video found...</div>
        </li>';
}
?>