const param=new URLSearchParams(window.location.search);
const completed=param.get("completed");
document.addEventListener("DOMContentLoaded", function() {
    fetch("../../../BackEnd/lessons/get_lessons.php?course_id=3&completed="+completed)
        .then(response => response.text())
        .then(data => {
            document.querySelector(".lesson-list").innerHTML = data;
            let certificate=document.querySelector(".certificate");
            certificate.addEventListener("click", function(event) {
                if (completed != 'true') {
                    event.preventDefault();
                    if (!document.querySelector(".test-warning")) {
                        let warningDiv = document.createElement("div");
                        warningDiv.className = "test-warning";
                        warningDiv.textContent = "You have to take the test to get your certificate";
                        warningDiv.style.color = "red";
                        warningDiv.style.fontWeight = "bold";
                        warningDiv.style.marginTop = "10px";
                        let elements = document.getElementsByClassName("gotolesson");
                        let lastElement = elements[elements.length - 1];
                        lastElement.appendChild(warningDiv);
                    }
                }
            });
            document.getElementById("lesson").addEventListener("click",function(){
                location.reload();
            });
        })
        .catch(error => console.error("Error fetching comments:", error));
});