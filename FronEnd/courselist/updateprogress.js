const param = new URLSearchParams(window.location.search);
const id2 = parseInt(param.get("id"));

setTimeout(function () {
  let course_id=1;
  const url = window.location.href;
  if (url.includes("git%20and%20gitHub")) {
    course_id=1;
  }
  else if(url.includes("courselist/html"))
  {
    course_id=2;
  }
  else{
    course_id=3;
  }
  fetch("../../../../BackEnd/progress_track/progress_save.php?saveto=lesson&id=" + id2+"&course_id="+course_id)
    .then(response => response.text())
    .then(data => {
      console.log(data); // debug output
    })
    .catch(error => console.error("Error saving progress:", error));
}, 10000); // 3 minutes

setTimeout(() => {
    let answer1 = document.querySelector(".correct_option1");
        let answer2 = document.querySelector(".correct_option2");
    document.getElementById("submit1").addEventListener("click", function () {
        fetch("../../../../BackEnd/progress_track/progress_save.php?saveto=question&dif=" + answer1.value)
          .then(response => response.text())
          .then(data => {
            console.log(data);
          });
      });
      document.getElementById("submit2").addEventListener("click", function () {
        fetch("../../../../BackEnd/progress_track/progress_save.php?saveto=question&dif=" + answer2.value)
          .then(response => response.text())
          .then(data => {
            console.log(data);
          });
      });
    }, 3000); // wait 3 seconds to make sure content is loaded