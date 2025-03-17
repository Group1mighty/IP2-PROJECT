document.addEventListener("DOMContentLoaded", function () {
    const correctAnswers = {
    q1: "background-color: blue;",
    q2: "A shade of red",
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
        resultDiv.textContent = "Correct! background-color: blue; is the answer";
        resultDiv.style.color = "green";
    } else {
        resultDiv.textContent = "Incorrect! The correct answer is: 'background-color: blue;'.";
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
        resultDiv.textContent = "Correct! A shade of red is the answer";
        resultDiv.style.color = "green";
    } else {
        resultDiv.textContent = "Incorrect! The correct answer is: 'A shade of red'.";
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
