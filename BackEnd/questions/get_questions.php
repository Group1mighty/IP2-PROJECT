<?php 
require '../db.php';
session_start();
$stmt=$conn->prepare("SELECT question ,option_a, option_b, option_c, option_d, correct_option  FROM questions WHERE lesson_id = ?;");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0)
{
    $i=1;
    while($question=$result->fetch_assoc())
    {
        echo'<article class="question">
                <div class="choice">
                    <h2>Question '.$i.'</h2>
                <p>'.$question['question'].'</p>
                <label>
    <input
        type="radio"
        name="q'.$i.'"
        value="'.$question['option_a'].'"
        class="inputq'.$i.'"
    />
    <span>'.$question['option_a'].'</span>
    </label>
    <label>
        <input
            type="radio"
            name="q'.$i.'"
            value="'.$question['option_b'].'"
            class="inputq'.$i.'"
        />
        <span>'.$question['option_b'].'</span>
    </label>
    <label>
        <input
            type="radio"
            name="q'.$i.'"
            value="'.$question['option_c'].'"
            class="inputq'.$i.'"
        />
        <span>'.$question['option_c'].'</span>
    </label>
    <label>
        <input
            type="radio"
            name="q'.$i.'"
            value="'.$question['option_d'].'"
            class="inputq'.$i.'"
        />
        <span>'.$question['option_d'].'</span>
    </label>
                <button id="submit'.$i.'" class="q1">Submit</button>
                <input type="text" class="correct_option'.$i.'" name="correct_option" value="'.$question['correct_option'].'" style="display: none;"/>
            </div>
        </article>';
        $i++;
    }
}
else{
    echo'<li>
            <div class="separate">No questions found...</div>
        </li>';
}
?>