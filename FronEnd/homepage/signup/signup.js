//<!-- temporary script -->
const params = new URLSearchParams(window.location.search);
const course = params.get('from');
const registered=params.get('registered');
const formTitle = document.getElementById("form-title");
const authForm = document.getElementById("auth-form");
const toggleLink = document.getElementById("toggle-link");
const container=document.querySelector('.container');

document.addEventListener("DOMContentLoaded", function () {
    let alertBox = document.querySelector(".alert");
    if (alertBox) {
        alertBox.classList.add("show");
        setTimeout(() => {
            alertBox.classList.remove("show");
        }, 3000); // Hide after 3 seconds
    }
});
authForm.addEventListener("submit", function (e) {
    authForm.action=authForm.action+'?from='+course;
})
/*const enter=document.querySelector('.btn');
enter.addEventListener('click', () => {
    if (!authForm.checkValidity()) 
        {
        authForm.reportValidity();
    }
    if (course === "course1") {
        enter.href="../../courselist/git and gitHub/git and gitHubLessonList.html";
    }
    else if(course=="course2")
    {
        enter.href="../../courselist/html/htmlLessonList.html";
    }
    else if(course=="course3")
    {
        enter.href="../../courselist/css/cssLessonList.html";
    }
    else
    {
        enter.href="../../courselist/courselist.html";
    }
});*/
/*addEventListener("click",function (e){

})"*/ 

    // Listen for clicks on the container (Event Delegation)
container.addEventListener("click", (e) => {
    if (e.target.classList.contains("toggle-link")) {
        const formTitle = document.getElementById("form-title");
        
        if (formTitle.textContent === "Sign Up") {
            container.innerHTML = `
                <h2 id="form-title">Login</h2>
                <form id="auth-form" method="post" action="../../../BackEnd/auth/login.php?from=${encodeURIComponent(course)}">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <input type="submit" class="btn" value="Login">
                </form>
                <p class="toggle-link">Don't have an account? Sign Up</p>
            `;
        } else {
            container.innerHTML = `
                <h2 id="form-title">Sign Up</h2>
                <form id="auth-form" method="post" action="../../../BackEnd/auth/register.php?from=${encodeURIComponent(course)}">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <input type="submit" class="btn" value="Sign Up">
                </form>
                <p class="toggle-link">Already have an account? Login</p>
            `;
        }
    }
});

