//<!-- temporary script -->
const params = new URLSearchParams(window.location.search);
const course = params.get('from');
const registered=params.get('registered');
const formTitle = document.getElementById("form-title");
const authForm = document.getElementById("auth-form");
const toggleLink = document.getElementById("toggle-link");
const container=document.querySelector('.container');

if (params.has('alertMessage') && params.has('alertType')) {
    const alert=params.get('alertMessage');
    const alertType=params.get('alertType');
    document.getElementsByClassName('alert')[0].style.display = "block";
    document.getElementsByClassName('alert')[0].textContent=alert;
    document.getElementsByClassName('alert')[0].classList.add(alertType);
}

document.addEventListener("DOMContentLoaded", function () {
    /*if(document.getElementById('form-title').textContent === "Login" && !params.has('alertMessage') && !params.has('alertType')){
        window.onload = function () {
            window.location.href = "../../../BackEnd/auth/check_auth.php?from=" + course;
        };        
    }*/
    let alertBox = document.querySelector(".alert");
    if (alertBox.style.display==="block") {
        alertBox.classList.add("show");
        setTimeout(() => {
            alertBox.classList.remove("show");
        }, 3000); // Hide after 3 seconds
    }
});
authForm.addEventListener("submit", function (e) {
    authForm.action=authForm.action+'?from='+course;
})

toggleLink.addEventListener("click", (e) => {
    if (e.target.classList.contains("toggle-link") && toggleLink.textContent === "Already have an account? Login") {
        window.location.href = "../../../BackEnd/auth/check_auth.php?from=" + course;
    }
    else{
        window.location.href = "./signup.html?from=" + course;
    }
});
