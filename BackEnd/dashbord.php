<?php 
require 'db.php'; 
session_start();

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
  $token = $_COOKIE['remember_token'];
  $stmt = $conn->prepare("SELECT user_id FROM remember_tokens WHERE token = ? AND expires_at > NOW()");
  $stmt->bind_param("s", $token);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // Fetch full user data
      $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
      $stmt->bind_param("i", $row['user_id']);
      $stmt->execute();
      $userResult = $stmt->get_result();
      $user = $userResult->fetch_assoc();

      // Set session
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['username'] = $user['user_name'];
      $_SESSION['profile_picture']=$user['profile_pic'];
      $_SESSION['email']=$user['email'];
  }
}

// First Query: user_course_completion
$stmt = $conn->prepare("SELECT COUNT(*) AS count  FROM user_course_completion WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$_SESSION['courses_completed'] = $row['count'];
$stmt->close(); // close before reusing

// Second Query: user_lesson_views
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM user_lesson_views WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$_SESSION['lesson_viewed'] = $row['count'];
$stmt->close();

// Third Query: user_question_attempts
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM user_question_attempts WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$_SESSION['questions_completed'] = $row['count'];
$stmt->close();
?>

  <?php
  if (!isset($_SESSION['user_id'])) {
      header("Location: ../FronEnd/homepage/homeP.html");
      exit();
  }
  // Prevent back button after logout
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Student Dashboard</title>
      <link rel="icon" href="../FronEnd/pictures/icon/tablogo.png" type="image/png">
      <link rel="stylesheet" href="style.css" />

      <style>
          @import url('https://fonts.googleapis.com/css?family=Poppins:200i,400&display=swap');
        /* VARIABLES & RESET */
        :root {
          --primary-color: #0A88FF;
          --secondary-color: #f0f4f8;
          --text-color: #333;
          --bg-color: #fafbfc;
          --card-bg: #fff;
          --border-radius: 8px;
          --box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
        button{
          font-family: 'Poppins', sans-serif !important;
          font-size:1rem;
        }
        button:hover{
          background-color:rgb(6, 78, 146) !important;
          color: #fff !important;
        }

        body {
          font-family: 'Poppins', sans-serif;
          background: var(--bg-color);
          color: var(--text-color);
          line-height: 1.5;
        }

        /* HEADER */
        .header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          background: var(--card-bg);
          padding: 1rem 2rem;
          box-shadow: var(--box-shadow);
          position: sticky;
          top: 0;
          z-index: 100;
          font-size: 1.2em;
        }

        .logo {
          font-size: 1.2em;
          font-weight: bold;
          color: var(--primary-color);
        }

        .page-title {
          font-size: 1.2em;
          color: var(--primary-color);
          text-decoration:none;
          font-weight: bold;
        }

        .user-menu {
          display: flex;
          align-items: center;
        }

        .user-name {
          margin-right: 0.5rem;
          font-weight: 500;
        }

        .avatar-container {
          position: relative;
          display: inline-block;
        }
        .avatar {
          width: 40px;
          height: 40px;
          background: var(--primary-color);
          color: #fff;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-weight: bold;
          cursor:pointer;
        }
        .avatar img {
          width: 100%;
          height: 100%;
          border-radius: 50%;
          object-fit: cover;
        }
        .dropdown-menu {
          display: none;
          position: absolute;
          top: 140%;
          right: 0;
          background-color: white;
          border: 1px solid #ddd;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
          border-radius: 8px;
          min-width: 150px;
          z-index: 999;
        }

        .dropdown-menu a {
          display: block;
          padding: 10px;
          color: #333;
          text-decoration: none;
        }

        .dropdown-menu input{
          display: block;
          padding: 10px;
          color: #333;
          background-color: white;
          text-decoration: none;
          border:none;
          cursor:pointer;
          width:100%;
          font-size: 1.1em;
          text-align:left;
        }

        .dropdown-menu a:hover, input {
          background-color: #f2f2f2;
        }

        .dropdown-menu input:hover {
          background-color: #f2f2f2;
        }
        /* MAIN LAYOUT */
        .main-content {
          max-width: 1200px;
          margin: 2rem auto;
          padding: 0 1rem;
          height:90vh;
          display:flex;
          flex-direction:column;
          justify-content:space-evenly;
        }

        /* TOP PANELS */
        .top-panels {
          display: grid;
          grid-template-columns: 1fr 2fr;
          gap: 2rem;
          margin-bottom: 2rem;
        }

        .panel {
          background: var(--card-bg);
          border-radius: var(--border-radius);
          padding: 1.5rem;
          box-shadow: var(--box-shadow);
        }

        /* STATS PANEL */
        .stats-panel h2 {
          margin-bottom: 1rem;
          color: var(--primary-color);
          text-transform: uppercase;
        }

        .stats-list {
          list-style: none;
        }

        .stats-list li {
          margin-bottom: 0.75rem;
          font-size: 1rem;
        }

        /* PROGRESS PANEL */
        .progress-panel h2 {
          margin-bottom: 0.5rem;
          font-size: 1.25rem;
        }
        

        .progress-panel p {
          margin-bottom: 0.75rem;
          color: #666;
          font-size: 0.9rem;
        }
        .progress-panel .notice{
          color: #555; 
          font-style: italic; 
          text-align: center; 
          margin-top: 20px;
          font-family: 'Poppins', sans-serif;
          font-size: 1.2rem;
        }

        .progress-bar {
          width: 90%;
          height: 16px;
          background: var(--secondary-color);
          border-radius: var(--border-radius);
          overflow: hidden;
        }
        /*------------------------------------------ here is where you change the progress----------------------------------*/
        .progress-fill {
          height: 100%;
          background: var(--primary-color);
          width: 0%;
          transition: width 2s ease-in-out;
        }

        /* small bars inside per-course list */
        .progress-bar.small {
          height: 10px;
        }
        /*------------------------------------------------------------------------------------------------------------------ */
        .course-progress-list .course-progress {
          display: flex;
          flex-direction:column;
          align-items: center;
          margin-bottom: 0.75rem;
          align-items:flex-start;
          background: linear-gradient(90deg, #122545, #63ADF2);
          padding:17px;
          border-radius:1rem;
        } 
        .course-prog{
          display:flex;
          justify-content:space-between;
          width:100%;
          align-items:center;
        }

        .course-name {
          flex: 1;
          font-size: 0.95rem;
          color:white;
          margin:10px 10px 10px 0px;
        }

        .course-percent {
          margin-left: 0.5rem;
          color: white;
          font-size: 0.9rem;
        }
        .continue{
          color:white;
          text-align:right;
          text-decoration:underline;
          margin-top:3%;
        }

        /* AVAILABLE COURSES */
        .courses-section h2 {
          text-align: center;
          color: var(--primary-color);
          text-transform: uppercase;
          letter-spacing: 1px;
          margin-bottom: 1rem;
        }
        .course-description {
          overflow: hidden;
          display: -webkit-box;
          -webkit-line-clamp: 2; /* show 2 lines only */
          -webkit-box-orient: vertical;
        }

        .course-description.expanded {
          -webkit-line-clamp: unset;
          overflow: visible;
        }
        .courses-grid {
          display: flex;
          flex-direction:row;
          justify-content:space-evenly;
          gap:25px;
          gap: 1.5rem; /* or whatever you use */
          align-items: flex-start;
          min-width:450px;
        }
        .courses-grid p{
          margin:10px;
        }
        .course-card {
          background: var(--card-bg);
          border-radius: var(--border-radius);
          box-shadow: var(--box-shadow);
          overflow: hidden;
          display: flex;
          flex-direction: column;
          max-width:450px;
        }

        .course-thumbnail {
          background: var(--secondary-color);
          min-height: 120px;
          display:flex;
          justify-content:center;
          align-content:center;
        }
        .course-thumbnail img{
          object-fit:contain;
          width:100px;
          height:100px;
        }

        .course-title {
          margin: 1rem;
          font-size: 1rem;
          flex: none;
        }

        .btn-enroll {
          margin: 0 1rem 1rem;
          padding: 0.5rem;
          background: var(--primary-color);
          color: #fff;
          border: none;
          border-radius: var(--border-radius);
          cursor: pointer;
          transition: background 0.3s ease;
        }
        .courses-section{
          width:100%;
        }

        .btn-enroll:hover {
          background: #008bbd;
        }

        .link-showmore {
          display: inline-block;
          margin:10px 15px 15px 15px;
          font-size: 1rem;
          font-weight: 500;
          color: #007BFF;
          text-decoration: underline;
          background: none;
          border: none;
          cursor: pointer;
          text-align:right;
        }

        .link-showmore:hover {
          color: #0056b3;
          text-decoration: none;
        }
        .notice{
          color: #555; 
          font-style: italic; 
          text-align: center; 
          margin-top: 20px;
          font-family: 'Poppins', sans-serif;
          font-size: 1.2rem;
        }

          /* FOOTER */

        footer{
            background-color: #142747;
            color:white;
            font-family: 'Poppins', sans-serif;
            padding:5px;
        }
        footer .Clogo {
            width: 130px; /* Adjust based on your image size */
            height: 123px;
            /*aspect-ratio:4/3;*/
            object-fit: contain;
        }
        .socials{
            padding-left:30px;
        }
        .socials img{
            width:42px;
            height:42px;
            padding-right: 5px;
        }
        footer p{
            font-size:1.3em;
            padding-left:30px;
            margin-bottom:10px;
            margin-top:10px;
        }
        footer .mailpic{
            vertical-align: middle;
            margin-right: 5px;
        }
        footer .mail{
            color:white;
            text-decoration: underline;
        }
        .alert {
            position: fixed;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 5px;
            transition: top 0.5s ease-in-out;
        }
        .show {
            top: 20px; /* Slide down effect */
            background-color: green;
            color: white;
        }
        #feedback {
            padding: 2rem;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
            margin-top: 2rem;
            width:60%;
            margin:0 auto;
          }

        #feedback h2 {
            margin-bottom: 1rem;
          }

        #feedback textarea {
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
          }

        #feedback button {
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
          }
        /* RESPONSIVE */
        @media (max-width: 768px) {
          .top-panels {
            grid-template-columns: 1fr;
          }
        }
    </style>
    </head>
    <script>
      function toggleDropdown() {
        const menu = document.getElementById("dropdown-menu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
      }
      // Optional: Hide dropdown when clicking outside
      document.addEventListener('click', function(event) {
        const avatarContainer = document.querySelector('.avatar-container');
        const dropdown = document.getElementById("dropdown-menu");
        if (!avatarContainer.contains(event.target)) {
          dropdown.style.display = 'none';
        }
      });
    </script>
    <body>
      <!-- HEADER -->
      <header class="header">
      <div style="display: none;" class="alert"></div>
        <div class="logo">eduSphere</div>
        <a class="page-title" href="dashbord.php">Dashboard</a>
        <div class="user-menu">
        <span class="user-name" id="user-name"><?php echo $_SESSION['username']?></span>
        <div class="avatar-container" onclick="toggleDropdown()">
          <div class="avatar" id="user-initials">
            <?php
              if ($_SESSION['profile_picture'] != NULL) {
                  echo '<img src="' . substr($_SESSION['profile_picture'], 1) . '" alt="profile picture">';
              } else {
                  $nameParts = explode(' ', trim($_SESSION['username']));
                  $initials = '';
                  foreach ($nameParts as $part) {
                      if (isset($part[0])) {
                          $initials .= strtoupper($part[0]);
                      }
                  }
                  echo htmlspecialchars($initials);
              }
            ?>
          </div>
          <!-- Dropdown Menu -->
          <div class="dropdown-menu" id="dropdown-menu">
            <a href="edit-profile.php">Edit Profile</a>
            <form action="auth/logout.php" method="post">
                <input type="submit" value="logout"/>
            </form>
          </div>
        </div>
      </div>
      </header>

      <!-- MAIN CONTENT -->
      <main class="main-content">
        <!-- Top panels: Stats & Progress -->
        <section class="top-panels">
          <!-- STATS PANEL -->
          <div class="panel stats-panel">
            <h2>STAT</h2>
            <ul class="stats-list">
              <li>Courses Completed: <span id="program-completed"><?php echo $_SESSION['courses_completed']?></span></li>
              <li>Questions Completed: <span id="quizzes-completed"><?php echo $_SESSION['questions_completed'] ?></span></li>
              <li>Lessons Viewed: <span id="lessons-viewed"><?php echo $_SESSION['lesson_viewed']?></span></li>
            </ul>
          </div>

          <!-- PROGRESS PANEL -->
          <div class="panel progress-panel">
            <h2>Welcome, <span id="welcome-name"><?php echo $_SESSION['username']?></span>!</h2>
            <p>Progress (%) (Enrolled Courses)</p>
            <?php 
            // First query to get all course_ids
            $_enrolledCourse=[];
            $stmt = $conn->prepare("SELECT course_id FROM enrollment WHERE user_id = ?");
            $stmt->bind_param("i", $_SESSION['user_id']);
            echo '<script>console.log("'.$_SESSION['user_id'].'");</script>';
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0)
            {
                // Loop through the result set
                while ($row = $result->fetch_assoc()) {
                    $course_id = $row['course_id'];

                    // Second query to get course title for each course_id
                    $stmt2 = $conn->prepare("SELECT title FROM courses WHERE id = ?");
                    $stmt2->bind_param("i", $course_id);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    $stmt3 = $conn->prepare("SELECT COUNT(*) AS count  FROM user_course_completion WHERE course_id = ? AND user_id = ?");
                    $stmt3->bind_param("ii", $course_id, $_SESSION['user_id']);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();
                    $row3=$result3->fetch_assoc(); 
                    if ($row3['count'] > 0)
                    {
                      $percent=100;
                    }
                    else{
                      $stmt4 = $conn->prepare("SELECT COUNT(*) AS count  FROM user_lesson_views WHERE course_id = ? AND user_id = ?");
                      $stmt4->bind_param("ii", $course_id, $_SESSION['user_id']);
                      $stmt4->execute();
                      $result4 = $stmt4->get_result();
                      $row4=$result4->fetch_assoc(); 
                      $percentInt=14.2857142857*$row4['count'];
                      $percentInt = floor($percentInt); // round down to the nearest integer
                      $percent = $percentInt;
                    }
                    $result3->close();
                    ///////////////////////////////////////////////////////////////////////////////////////////////
                    // Fetch the title from the second query
                    if ($row2 = $result2->fetch_assoc()) {
                      $location='';
                      switch($row2['title'])
                      {
                        case "GIT AND GIT HUB":
                          if($percent==100)
                          {
                            $location='../FronEnd/courselist/git and gitHub/git and gitHubLessonList.html?completed=true';
                          }
                          else 
                            $location='../FronEnd/courselist/git and gitHub/git and gitHubLessonList.html';
                          break;
                        case "HTML":
                          if($percent==100)
                          {
                            $location='../FronEnd/courselist/html/htmllLessonlist.html?completed=true';
                          }
                          else
                            $location='../FronEnd/courselist/html/htmllLessonlist.html';
                          break;
                        case "CSS":
                          if($percent==100)
                          {
                            $location='../FronEnd/courselist/css/cssLessonList.html?completed=true';
                          }
                          else
                            $location='../FronEnd/courselist/css/cssLessonList.html';
                          break;
                      }
                        echo '<div class="course-progress-list">
                                <div class="course-progress">
                                  <span class="course-name">'.$row2['title'].'</span>
                                  <div class="course-prog">
                                    <div class="progress-bar small">
                                      <div class="progress-fill"></div>
                                    </div>
                                    <span class="course-percent">'.$percent.'%</span>
                                  </div>
                                  <a href="'.$location.'" class="continue">Continue</a>
                                </div>
                              </div>';
                    }
                    $_enrolledCourse[]=$row2['title'];
                }
              }
              else{
                echo '<p class="notice"> You haven\'t enrolled in any courses yet. Start learning something new today! 🌱</p>';
              }
                ?>
          </div>
        </section>

        <!-- AVAILABLE COURSES -->
  <section class="courses-section">
          <h2>Available Courses</h2>
          <div class="courses-grid" id="courses-grid">
          <?php
          $length=count($_enrolledCourse);
          //echo "<Script>console.log('the number of course you enrolled:'+'".$length."')</Script>";
          //echo "<Script>console.log('the course you have enrolled is:'+'".$_enrolledCourse[0]."')</Script>";
          if (count($_enrolledCourse)==0) {
              $stmt = 'SELECT title, discription, picture FROM courses;';
              $result = $conn->query($stmt);
              if ($result && $result->num_rows > 0) {
                  while ($user = $result->fetch_assoc()) {
                      $id = 'desc-' . strtolower(str_replace(' ', '-', $user['title'])); 
                      echo '<div class="course-card placeholder">
                      <div class="course-thumbnail"><img src="../FronEnd/'.preg_replace('/^\.\.\//', '', $user['picture']).'" alt="'.$user['title'].' picture"></div>
                      <p class="course-description line-clamp" id="'.$id.'">' . $user['discription'] . '</p>
                      <a href="javascript:void(0);" onclick="toggleDescription(\'' . $id . '\', this)" class="link-showmore">Show More</a>
                      <button class="btn-enroll" onclick="enroll(\'' . addslashes($user['title']) . '\')")>Enroll</button>
                  </div>';              
                  }
              }
          } 
          else {
              // Build a safe list of enrolled course titles
                $placeholders = rtrim(str_repeat('?,', count($_enrolledCourse)), ',');
                $stmt = $conn->prepare("SELECT title, discription, picture FROM courses WHERE title NOT IN ($placeholders)");
                $stmt->bind_param(str_repeat('s', count($_enrolledCourse)), ...$_enrolledCourse);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($user = $result->fetch_assoc()) {
                    $id = 'desc-' . strtolower(str_replace(' ', '-', $user['title'])); 
                    echo '<div class="course-card placeholder">
                        <div class="course-thumbnail"><img src="../FronEnd/'.preg_replace('/^\.\.\//', '', $user['picture']).'" alt="'.$user['title'].' picture"></div>
                        <p class="course-description line-clamp" id="'.$id.'">' . $user['discription'] . '</p>
                        <a href="javascript:void(0);" onclick="toggleDescription(\'' . $id . '\', this)" class="link-showmore">Show More</a>
                        <button class="btn-enroll" onclick="enroll(\'' . addslashes($user['title']) . '\')")>Enroll</button>
                    </div>';    
                }
          if(count($_enrolledCourse)==3){
            echo '<p class="notice">You have enrolled in all available courses. New courses will be added soon — stay tuned!📡</p>';
          }
                /*
                🔍 What this line does:
                  php
                  Copy code
                  $placeholders = rtrim(str_repeat('?,', count($_enrolledCourse)), ',');
                  It builds the ?, ?, ? part of the SQL query depending on how many enrolled courses there are.

                  Example:

                  If:
                  $_enrolledCourse = ["GIT AND GIT HUB", "CSS", "HTML"];

                  Then:
                  str_repeat('?,', 3) // gives '?,?,?,'
                  rtrim(..., ',') // removes the last comma

                  So now: $placeholders = '?,?,?'

                  So the final SQL becomes:
                  SELECT ... FROM courses WHERE title NOT IN (?, ?, ?)

                  These ?s will be filled in later using bind_param().

                  🎯 Next Line:

                  $stmt->bind_param(str_repeat('s', count($_enrolledCourse)), ...$_enrolledCourse);

                  What's happening here?

                  bind_param() is used to bind values to the ? placeholders securely.

                  🔹 Part 1: str_repeat('s', count($_enrolledCourse))
                  's' stands for "string"
                  If there are 3 enrolled courses → 'sss'
                  This tells MySQLi: “We’re passing 3 strings”

                  🔹 Part 2: ...$_enrolledCourse
                  The ... is the spread operator
                  It "unpacks" the array into individual arguments
                */
              }
          ?>
          </div>
        </section>
        <!-- Comment Section -->
      </main>
      <section id="feedback">
          <h2>We’d love your feedback!</h2>
          <form action="./addcomments.php" method="POST">
            <textarea name="comment" rows="4" required placeholder="Tell us what you think..."></textarea>
            <button type="submit">Submit Feedback</button>
          </form>
        </section>

      <!-- FOOTER -->
      <footer id="footer">
          <img src="../FronEnd/pictures/icon/result.png" class="Clogo">
          <div class="socials">
              <a href="#" target="_blank"><img src="../FronEnd/pictures/icon/fb.png"></a>
              <a href="#" target="_blank"></a><img src="../FronEnd/pictures/icon/insta.png"></a>
              <a href="#" target="_blank"></a><img src="../FronEnd/pictures/icon/tt.png"></a>
              <a href="#" target="_blank"></a><img src="../FronEnd/pictures/icon/ytube.png"></a>
          </div>
          <p>&copy; 2024 Created By Group 1 All Rights Reserved. </p>
          <p><img src="../FronEnd/pictures/icon/location.png">AASTU, BLOCK 16.</p>
          <p><a href="mailto:group1@gmail.com" class="mail"><img src="../FronEnd/pictures/icon/mail.png" class="mailpic">group1@gmail.com</a></p>
      </footer>
    </body>
    <script>
      const params = new URLSearchParams(window.location.search);
      if (params.has('register')) {
          document.getElementsByClassName('alert')[0].style.display = "block";
          document.getElementsByClassName('alert')[0].textContent="You have been registered successfully!!";
          document.getElementsByClassName('alert')[0].classList.add('s');
      }
      if(params.has('alertMessage') && params.has('alertType')) {
          document.getElementsByClassName('alert')[0].style.display = "block";
          document.getElementsByClassName('alert')[0].textContent=params.get('alertMessage');
          document.getElementsByClassName('alert')[0].classList.add(params.get('alertType'));
      }
      document.addEventListener("DOMContentLoaded", function () {
        let alertBox = document.querySelector(".alert");
        if (alertBox.style.display==="block") {
            alertBox.classList.add("show");
            setTimeout(() => {
                alertBox.classList.remove("show");
            }, 3000); // Hide after 3 seconds
        }
      });
      function toggleDescription(id, btn) {
    const desc = document.getElementById(id);
    desc.classList.toggle('expanded');
    btn.textContent = desc.classList.contains('expanded') ? 'Show Less' : 'Show More';
  }
  function enroll(title) {
  window.location.href = "enroll.php?course_title=" + encodeURIComponent(title);
}
window.addEventListener('DOMContentLoaded', () => {
  const courseProg = document.getElementsByClassName('course-prog');
  for (let i = 0; i < courseProg.length; i++) {
    const percentText = courseProg[i].querySelector('.course-percent').textContent;
    const percent = parseInt(percentText); // Remove the % sign
    const fill = courseProg[i].querySelector('.progress-fill');
    
    // Add small delay to allow transition to trigger
    setTimeout(() => {
      fill.style.width = percent + '%';
    }, 100); // 100ms is usually enough
  }
});

    </script>
  </html>