document.addEventListener("DOMContentLoaded", function() {
        fetch("../../BackEnd/fetchcomments.php")
            .then(response => response.text())
            .then(data => {
                document.querySelector(".testimonials-container").innerHTML = data;
            })
            .catch(error => console.error("Error fetching comments:", error));
});
/*
fetch() API:
fetch("../../BackEnd/fetchcomments.php")
fetch() is a modern JavaScript method used to make HTTP requests. In this case, it makes a GET request to the server to retrieve data from a file called fetchcomments.php located in the BackEnd folder.

The fetch() method is asynchronous, meaning it doesn't block the rest of the JavaScript code from running while it waits for the server to respond. This is what allows us to continue with other tasks while waiting for the data to come back.

Handling the Response:
.then(response => response.text())
The .then() method is used to handle the promise returned by fetch().

The response parameter represents the response object returned by the server.

response.text() is a method that converts the response body (the content from fetchcomments.php) into a plain text format. In your case, the PHP script likely outputs HTML 
content (like the testimonials), which will be fetched as plain text.

text() returns a promise that resolves with the body of the response as a string.

Updating the DOM:
.then(data => {
    document.querySelector(".testimonials-container").innerHTML = data;
})
After the response.text() is resolved, the resulting data is passed to the next .then() block.

document.querySelector(".testimonials-container") selects the first HTML element with the class testimonials-container. This is where the fetched data (the HTML for the comments)
 will be inserted.

innerHTML = data is used to replace the inner HTML of the selected element (the .testimonials-container) with the fetched data. This dynamically updates the content of the
page with the comments retrieved from the server.

Error Handling:
.catch(error => console.error("Error fetching comments:", error));
The .catch() block is used to handle any errors that may occur during the fetch operation. For example, if the server cannot be reached, or the PHP script returns an error, 
this block will log the error to the console.

The error parameter will contain the error details, and we use console.error() to display the error message in the browser’s console for debugging purposes.
NOTE:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
When you use fetch() in JavaScript, you're requesting the content that is output by the server-side PHP script.

In your case, the PHP script is using echo to generate HTML for each comment, including the comment text, username, and photo URL. This HTML is sent back to the browser as the response.

echo '<div class="testimonial">
        <div class="personel">
            <img src="' . htmlspecialchars($row['photo_url']) . '" class="person">
            <p class="name">' . htmlspecialchars($row['username']) . '</p>
        </div>
        <div class="review">
            <h4>Review</h4>
            <p>"' . htmlspecialchars($row['comment_text']) . '"</p>
        </div>
    </div>';
JavaScript fetch() Request (Client-side): The JavaScript fetch() method sends a request to the PHP script (fetchcomments.php). 
Once the request is made, the PHP script processes the data and sends back the content (which is typically HTML in your case) as a response.

The response.text() method in JavaScript retrieves the raw text response (which is the HTML output from PHP).

The data is then inserted into the DOM using JavaScript, updating the page dynamically.
*/ 
// Show the "Back to Top" button after scrolling 300px
window.addEventListener("scroll", function() {
    const backToTopButton = document.getElementById("back-to-top");
    if (window.scrollY > 6400) {
        backToTopButton.style.display = "block";
    } else {
        backToTopButton.style.display = "none";
    }
});

// Smooth scroll back to top
document.getElementById("back-to-top").addEventListener("click", function(e) {
    e.preventDefault(); // Prevent default anchor behavior
    window.scrollTo({ top: 0, behavior: "smooth" });
});

document.getElementById("courses-link").addEventListener("click", function() {
    var dropdown = document.getElementById("courses-dropdown");
    // Toggle the display of the dropdown menu
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
});


