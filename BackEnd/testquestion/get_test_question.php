<?php 
require '../db.php';
session_start();
$stmt=$conn->prepare("SELECT question ,option_a, option_b, option_c, option_d, correct_option  FROM test_question WHERE course_id  = ?;");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0)
{
    $i=1;
    $j=0;
    while($question=$result->fetch_assoc())
    {
        echo'
        <section>
            <h2>Question '.$i.'</h2>
            <p>'.$question['question'].'</p>
            <fieldset>
                <label><input type="radio" name="q'.$j.'" value="'.$question['option_a'].'"> '.$question['option_a'].'</label>
                <label><input type="radio" name="q'.$j.'" value="'.$question['option_b'].'"> '.$question['option_b'].'</label>
                <label><input type="radio" name="q'.$j.'" value="'.$question['option_c'].'"> '.$question['option_c'].'</label>
                <label><input type="radio" name="q'.$j.'" value="'.$question['option_d'].'"> '.$question['option_d'].'</label>
            </fieldset>
            <input type="text" class="correct_option" name="correct_option" value="'.$question['correct_option'].'" style="display: none;"/>
        </section>';
        $i++;
        $j++;
    }
    echo '  <footer>
                <button id="submit" type="submit">Submit Quiz</button>
            </footer>
        <div id="result-container" class="hidden">
            <div id="result">
            <h1>Your Score: <span id="score"></span></h1>
            <p id="message"></p>
            </div>
        </div>';
}
else{
    echo'<li>
            <div class="separate">No questions found...</div>
        </li>';
}
?>