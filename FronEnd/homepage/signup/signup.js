//<!-- temporary script -->
const params = new URLSearchParams(window.location.search);
const course = params.get('from');

const enter=document.querySelector('.btn');
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
})
/*addEventListener("click",function (e){

})"*/ 
const formTitle = document.getElementById("form-title");
    const authForm = document.getElementById("auth-form");
    const toggleLink = document.getElementById("toggle-link");
    toggleLink.addEventListener("click", () => {
        if (formTitle.textContent === "Sign Up") {
            formTitle.textContent = "Login";
            authForm.innerHTML = `
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <a class="btn" href="">Log In</a>
            `;
            toggleLink.textContent = "Don't have an account? Sign Up";
        } else {
            formTitle.textContent = "Sign Up";
            authForm.innerHTML = `
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
            <a class="btn" href="">Sign Up</a>
            `;
            toggleLink.textContent = "Already have an account? Login";
        }
    });
