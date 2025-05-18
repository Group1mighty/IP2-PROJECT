let params = new URLSearchParams(window.location.search);
let id = parseInt(params.get("id")); 
let next=document.querySelector(".Next");
next.addEventListener("click",function(event){
    event.preventDefault();
    window.location.href="../Lesson Four/lessonfour.html?id="+(id+1);
});
document.addEventListener("DOMContentLoaded", function () {
    fetch("../../../../BackEnd/lessons/get_lesson_video.php"+"?id="+id)
    .then(response => response.text())
    .then(data => {
        document.querySelector(".video-element-container").innerHTML = data;
    })
    .catch(error => console.error("Error fetching comments:", error));
    fetch("../../../../BackEnd/questions/get_questions.php"+"?id="+id)
    .then(response => response.text())
    .then(data => {
        document.querySelector(".quize-container").innerHTML = data;
        let answer1 = document.querySelector(".correct_option1");
        let answer2 = document.querySelector(".correct_option2");
        document.getElementById("submit1").addEventListener("click", function () {
            let selectedAnswer = document.querySelector('input[name="q1"]:checked');
            const resultDiv = document.createElement("div");
            const questionDiv = document.querySelector(".question:nth-of-type(1) .choice");
            const existingResult = questionDiv.querySelector(".result");
            if (existingResult) {
            existingResult.remove();
            }
            if (selectedAnswer) {
            const userAnswer = selectedAnswer.value;
                if (userAnswer === answer1.value) {
                    resultDiv.textContent = "Correct! "+userAnswer+" is the answer";
                    resultDiv.style.color = "green";
                } else {
                    resultDiv.textContent = "Incorrect! The correct answer is: '"+answer1.value+"'.";
                    resultDiv.style.color = "red";
                }
            } else {
                resultDiv.textContent = "Please select an answer for Question 1.";
                resultDiv.style.color = "orange";
                }
        
            // Style the result div and append it
            resultDiv.classList.add("result");
            resultDiv.style.marginTop = "10px";
            questionDiv.appendChild(resultDiv);
            });
        
            document.getElementById("submit2").addEventListener("click", function () {
            let selectedAnswer = document.querySelector('input[name="q2"]:checked');
            const resultDiv = document.createElement("div");
            const questionDiv = document.querySelector(".question:nth-of-type(2) .choice");
        
            const existingResult = questionDiv.querySelector(".result");
            if (existingResult) {
            existingResult.remove();
            }
        
            if (selectedAnswer) {
            const userAnswer = selectedAnswer.value;
            console.log(answer2.value);
            console.log(userAnswer);
            if (userAnswer === answer2.value) {
                resultDiv.textContent = "Correct! "+userAnswer+" is the answer.";
                resultDiv.style.color = "green";
            } else {
                resultDiv.textContent = "Incorrect! The correct answer is: "+answer2.value+".";
                resultDiv.style.color = "red";
            }
            } else {
            resultDiv.textContent = "Please select an answer for Question 2.";
            resultDiv.style.color = "orange";
            }
        
            // Style the result div and append it
            resultDiv.classList.add("result");
            resultDiv.style.marginTop = "10px";
            questionDiv.appendChild(resultDiv);
            });
    })
    .catch(error => console.error("Error fetching comments:", error));
let previous=document.querySelector(".Previous");
previous.addEventListener("click",function(event){
    event.preventDefault();
    window.location.href="../Lesson Two/lessonTwo.html?id="+(id-1);
});
});
