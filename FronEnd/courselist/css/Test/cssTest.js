document.addEventListener("DOMContentLoaded", function () {
    fetch("../../../../BackEnd/test/get_test_questions.php?id=" + 3)
        .then(response => response.text())
        .then(data => {
            document.querySelector("#quiz-form").innerHTML = data;

            // Now these are defined *after* content is loaded
            const answers = document.getElementsByClassName("correct_option");
            const totalQuestions = answers.length;

            // Event listener must use the correct variables
            document.getElementById("quiz-form").addEventListener("submit", function (event) {
                event.preventDefault();
                submitQuiz(answers, totalQuestions);
            });

            startTimer(() => submitQuiz(answers, totalQuestions)); // pass to timer too
        })
        .catch(error => console.error("Error fetching questions:", error));
});

// Modify startTimer to accept a callback
function startTimer(onTimeout) {
    const timerDisplay = document.getElementById('timer');
    let countdown;
    let timeRemaining = 600;

    countdown = setInterval(() => {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        timeRemaining--;

        if (timeRemaining < 0) {
            clearInterval(countdown);
            alert('Time is up!');
            onTimeout(); // use passed-in submit function
        }
    }, 1000);
}

// Pass in correct values
function submitQuiz(answers, totalQuestions) {
    let score = 0;

    for (let i = 0; i < totalQuestions; i++) {
        let userAnswer = document.querySelector(`input[name="q${i}"]:checked`);
        if (userAnswer && userAnswer.value[0] === answers[i].value[0]) {
            score++;
        }
    }

    displayResult(score, totalQuestions);

    // ✅ Send score as POST request
    fetch("../../../../BackEnd/test/save_result.php?id=" + 3, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `score=${score}`
    })
    .then(response => response.text())
    .then(console.log)
    .catch(error => console.error("Error saving result:", error));
}


function displayResult(score, totalQuestions) {
    document.getElementById("score").textContent = `${score} out of ${totalQuestions}`;
    document.getElementById("result-container").classList.remove("hidden");

    const message = document.getElementById("message");
    message.innerHTML = ""; // Clear previous content

    if (score >= 10) {
        message.textContent = "Congratulations! You passed the test. Please screenshot and store your certificate.";
        message.style.color = "green";

        const link = document.createElement("a");
        link.textContent = "View Certificate";
        link.href = "../../../../BackEnd/certificate/cirtificate.php?id=3";
        link.target = "_blank";
        link.style.cssText = "color: #007bff; display: block; margin-top: 10px; text-decoration: none;";
        message.appendChild(link);
    } else {
        message.textContent = "Unfortunately, you failed the test. Click below to try again.";
        message.style.color = "red";
        const link = document.createElement("a");
        link.textContent = "Try Again";
        link.href = "";
        link.addEventListener("click", (e) => {
            e.preventDefault();
            location.reload();
            });
        link.style.cssText = "color: #007bff; display: block; margin-top: 10px; text-decoration: none;";
        message.appendChild(link);
        
        /*const button = document.createElement("button");
        button.textContent = "Try Again";
        button.style.cssText = "color: #007bff; display: block; margin-top: 10px; text-decoration: none; background: none; border: none; cursor: pointer;";
        button
        message.appendChild(button);*/
        
    }
}
