// Define the answer key
const answers = {
    q1: "A version control system",
    q2: "To track changes in files and collaborate effectively",
    q3: "A cloud-based platform for hosting Git repositories",
    q4: "Git is a version control system; GitHub is a hosting service for Git repositories",
    q5: "A folder that contains project files and their version history",
    q6: "A separate line of development within a repository",
    q7: "git log",
    q8: "Sends local changes to a remote repository",
    q9: "To create your own copy of the repository, allowing you to make changes without affecting the original project",
    q10: "Combines two branches into one",
    q11: "To ignore specific files and directories in the repository",
    q12: "Copies a repository to your local machine",
    q13: "Fetches updates from the remote repository without merging",
    q14: "A request to pull changes from one branch to another",
    q15: "git branch -d",
    q16: "Reapplies commits on top of another base tip",
    q17: "git init",
    q18: "The differences between two commits",
    q19: "Temporarily saves changes without committing them",
    q20: "git pull merges changes, git fetch only downloads them"
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
        document.getElementById("message").textContent = "Congratulations! You passed the test. you can view your results in below link. please ScreenShot and store your certificate ";
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
