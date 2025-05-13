document.addEventListener("DOMContentLoaded", function() {
    fetch("../../../BackEnd/lessons/get_lessons.php?course_id=1")
        .then(response => response.text())
        .then(data => {
            document.querySelector(".lesson-list").innerHTML = data;
        })
        .catch(error => console.error("Error fetching comments:", error));
});
console.log('git and gitHub');