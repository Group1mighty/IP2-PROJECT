// Define the answer key
const answers = {
    q1: "Contains metadata and links to external resources",
    q2: "<a>",
    q3: "Provides an alternative description of the image",
    q4: "<ol><li>Item 1</li></ol>",
    q5: "A part of the document representing a specific area or topic",
    q6: "<button>",
    q7: "The bottom section of the page",
    q8: "<h1>",
    q9: "href",
    q10: "<p>",
    q11: "<script src=\"file.js\"></script>",
    q12: "Used to group content for styling or scripting",
    q13: "<img>",
    q14: "src",
    q15: "<br>",
    q16: "A container for user input elements",
    q17: "<ul>",
    q18: "<!-- This is a comment -->",
    q19: "<tr>",
    q20: "<input>"
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
        document.getElementById("message").textContent = "Congratulations! You passed the test. You can view your results below.";
        document.getElementById("message").style.color = "green";
        const link = document.createElement("a");
        link.textContent = "View Certificate";
        link.style.color = "#007bff";
        link.style.display = "block";
        link.style.marginTop = "10px";
        link.href = "../certificate/certificate.html";
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
