document.addEventListener("DOMContentLoaded", function () {
    const correctAnswers = {
    q1: "<nav>",
    q2: "Groups related content",
};
document.getElementById("submit").addEventListener("click", function () {
    const selectedAnswer = document.querySelector('input[name="q1"]:checked');
    const resultDiv = document.createElement("div");
    const questionDiv = document.querySelector(".question:nth-of-type(1) .choice");
    const existingResult = questionDiv.querySelector(".result");
    if (existingResult) {
    existingResult.remove();
    }
    if (selectedAnswer) {
    const userAnswer = selectedAnswer.value;
    if (userAnswer === correctAnswers.q1) {
        resultDiv.textContent = "Correct! <nav> is the answer";
        resultDiv.style.color = "green";
    } else {
        resultDiv.textContent = "Incorrect! The correct answer is: '<nav>'.";
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

    document.getElementById("submit-q2").addEventListener("click", function () {
    const selectedAnswer = document.querySelector('input[name="q2"]:checked');
    const resultDiv = document.createElement("div");
    const questionDiv = document.querySelector(".question:nth-of-type(2) .choice");

    const existingResult = questionDiv.querySelector(".result");
    if (existingResult) {
    existingResult.remove();
    }

    if (selectedAnswer) {
    const userAnswer = selectedAnswer.value;
    if (userAnswer === correctAnswers.q2) {
        resultDiv.textContent = "Correct! The <section> element Groups related content";
        resultDiv.style.color = "green";
    } else {
        resultDiv.textContent = "Incorrect! The correct answer is: 'Groups related content'.";
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
});
