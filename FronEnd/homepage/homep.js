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


