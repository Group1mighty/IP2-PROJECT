document.addEventListener("DOMContentLoaded", function() {
    fetch("../../BackEnd/courses/get_courses.php")
        .then(response => response.text())
        .then(data => {
            document.querySelector(".container").innerHTML = data;
            const enroll = document.querySelectorAll('.btn');
            const params = new URLSearchParams(window.location.search);
            const course = params.get('from');
            let count=0;
            console.log(course);
            if(enroll)
                    console.log("we got it");
            enroll.forEach((button) => {
            button.addEventListener('click', function (event) {
            if(!course)
            {
                console.log('there is no from parameter!!');
                return;
            }
            event.preventDefault(); // Prevent default link behavior
            if (course === "home" && count===0) {
                // Disable the current button's href
                button.href = ""; 
                // Get the parent `.course-content` of the clicked button
                const courseContent = button.closest('.course-content');
                // Create and add the warning message only to the parent
                const newdi = document.createElement("div");
                const p_in_newdi = document.createElement("p");
                const signup=document.createElement("a");
                signup.textContent="Sign Up/Login";
                signup.target="_blank";
                p_in_newdi.textContent = "You have not signed up or logged in yet. Please sign up or login.";
                newdi.appendChild(p_in_newdi);
                newdi.appendChild(signup);
                // Append the message to the course content
                courseContent.appendChild(newdi);
                count++;
                if(button.classList.contains("gitandgithub"))
                {
                    signup.href="../homepage/signup/signup.html?from=course1";
                }
                else if(button.classList.contains("html"))
                {
                    signup.href="../homepage/signup/signup.html?from=course2";
                }
                else
                {
                    signup.href="../homepage/signup/signup.html?from=course3";
                }
            }
            else
            {
                button.href="./";
            }
        });
    });
        })
        .catch(error => console.error("Error fetching courses:", error));
});
