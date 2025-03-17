// Define the answer key
const answers = {
    q1: "A style sheet language used for describing the look of a document",
    q2: "A name used to identify and target HTML elements",
    q3: "To specify colors in a web-friendly format",
    q4: "font-size",
    q5: "To apply different styles based on screen size and resolution",
    q6: "vw",
    q7: "Using the font-size property",
    q8: "letter-spacing",
    q9: "Designing websites that work well on all devices and screen sizes",
    q10: "Media queries",
    q11: "Controls the stacking order of elements",
    q12: "visibility",
    q13: "Allows elements to float next to each other",
    q14: "display: grid",
    q15: "static",
    q16: "text-shadow",
    q17: "justify-content",
    q18: "Controls how content is handled when it overflows the container",
    q19: "transition",
    q20: "flexbox"
};

// Timer variables
let countdown;
let timeRemaining = 600; // 10 minutes (in seconds)

// Function to start the timer
function startTimer() {
    const timerDisplay = document.getElementById('timer');

    // Update the timer every second
    countdown = setInterval(function () {
        // Calculate minutes and seconds
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        // Display the time in mm:ss format
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        // Decrease time by one second
        timeRemaining--;
        // If the timer runs out, stop it and submit the quiz
        if (timeRemaining < 0) {
            clearInterval(countdown);
            alert('Time is up!');
            submitQuiz(); // Automatically submit the quiz when time is up
        }
    }, 1000);
}
// Call startTimer() when the page is loaded or the quiz starts
startTimer();
// Function to handle quiz submission
function submitQuiz() {
    let score = 0;
    const totalQuestions = Object.keys(answers).length;
    // Loop through the answers and compare with user's inputs
    for (const [question, correctAnswer] of Object.entries(answers)) {
        const userAnswer = document.querySelector(`input[name="${question}"]:checked`);
        if (userAnswer && userAnswer.value === correctAnswer) {
            score++;
        }
    }
    displayResult(score);
}

// Function to display the result
function displayResult(score) {
    // Set the score in the result container
    document.getElementById("score").textContent = score + " out of " + Object.keys(answers).length;
    // Hide the quiz container and show the result container
    document.getElementById("result-container").classList.remove("hidden");
    if (score >= 10) {
        document.getElementById("message").textContent = "Congratulations! You passed the test. you can view your results in below link ";
        document.getElementById("message").style.color = "green";
        const link = document.createElement("a");
        link.textContent = "View Certificate";
        link.style.color = "#007bff";
        link.style.display = "block";
        link.style.marginTop = "10px";
        link.href = "../certificate/cirtificate.html";
        link.target = "_blank";
        link.style.textDecoration = "none";
        document.getElementById("message").appendChild(link);
    } else {
        document.getElementById("message").textContent = "Unfortunately, you failed the test. Click the button below to Try again.";
        document.getElementById("message").style.color = "red";
        const link = document.createElement("a");
        link.textContent = "Try Again";
        link.style.color = "#007bff";
        link.style.display = "block";
        link.style.marginTop = "10px";
        link.href = "#";
        link.target = "_blank";
        link.style.textDecoration = "none";
        document.getElementById("message").appendChild(link);
    }
}

// Handle quiz submission via form (in case the user submits before time is up)
document.getElementById("quiz-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from refreshing the page
    submitQuiz();
});
