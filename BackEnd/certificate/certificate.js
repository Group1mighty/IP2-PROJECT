const params=new URLSearchParams(window.location.search);
const id=parseInt(params.get("id"));
document.addEventListener('DOMContentLoaded',function(){
    fetch('../progress_track/progress_save.php?saveto=course&id='+id)
    .then(response => response.text())
    .then(data => {
        console.log('course progress have been updated!!');
    })
    .catch(error => console.error("Error fetching comments:", error));
});