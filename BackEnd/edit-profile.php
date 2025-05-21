<?php require 'db.php'; 
    session_start();
    $nameParts = explode(' ', trim($_SESSION['username']));
    $initials = '';
    foreach ($nameParts as $part) {
        if (isset($part[0])) {
            $initials .= strtoupper($part[0]);
        }
    }
    $_SESSION['INI']=$initials;
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
    <title>Edit Profile</title>
    <link rel="icon" href="../FronEnd/pictures/icon/tablogo.png" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:200i,400&display=swap');
        :root {
            --primary-color: #0A88FF;;
            --secondary-color: #f0f4f8;
            --text-color: #333;
            --bg-color: #fafbfc;
            --card-bg: #fff;
            --border-radius: 8px;
            --box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            line-height: 1.5;
            padding: 0;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width:100vw;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
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
        h2{
            margin:10px;
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

        .dropdown-menu input {
            display: block !important;
            padding: 10px !important;
            color: #333 !important;
            background-color: white !important;
            text-decoration: none !important;
            border: none !important;
            cursor: pointer !important;
            width: 100% !important;
            font-size: 1em !important;
            text-align: left !important;
            margin-top:0 !important;
        }


        .dropdown-menu a:hover, .dropdown-menu input:hover {
            background-color: #f2f2f2 !important;
        }

        
        /*---------------------------------------------- */

        /*.avatar2-container{
            border:2px black solid;
        }*/
        .profile form{
            width:100%;
        }
        .profile .nnE{
            width:100%;
        }
        .avatar2-container .avatar{
            width:120px;
            height:120px;
            font-size:3.5em;
        }
        .avapic{
            text-align:center;
            display: block;
            margin: auto;
        }
        .pp-container{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:space-evenly;
        }
        .btn{
            display:flex;
            gap:10px;
        }
        .btn-U{ 
            background-color: var(--primary-color);
            color: white; 
            padding: 0.75rem 1.5rem; 
            border-radius: var(--border-radius); 
            border: none; 
            cursor: pointer; 
            font-family: 'Poppins', sans-serif!important;
            font-size:1rem;
            width:60%;
        }
        .btn-U:hover{
            background-color: #006edc;
        }
        .btn-D
        {
            background-color: red!important;
            color: white; 
            padding: 0.75rem 1.5rem; 
            border-radius: var(--border-radius); 
            border: none; 
            cursor: pointer; 
            font-family: 'Poppins', sans-serif!important;
            font-size:1rem;
            width:60%;
        }
        .btn-D:hover{
            background-color:rgb(190, 3, 3)!important;
        }
        .settings-container {
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            flex-direction:column;
            justify-content: center;
            flex: 1;
            align-items:center;
            width:100%;
        }

        .settings-container .profile, .settings-container .password {
            background-color: var(--card-bg);
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            padding: 2rem;
            width: 100%;
            max-width: 600px;
            /*max-width:60%;
            min-width:200px;*/
        }

        fieldset {
            border: 2px solid var(--primary-color);
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            background-color: var(--secondary-color);
        }

        legend {
            font-weight: bold;
            color: var(--primary-color);
            padding: 10px 10px;
        }

        input[type="text"],
        input[type="email"],input[type="password"] {
            width: 90%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: var(--border-radius);
            font-size: 1rem;
            margin-top: 0;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1.4rem;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #006edc;
        }
        .save{
            background-color:#c7c7c7 !important;
            cursor:not-allowed !important;
        }
        .update{
            background-color:#c7c7c7 !important;
            cursor:not-allowed !important;
        }
        .nnE label{
            display:block;
            width:100% !important;
        }
        .ne{
            width:100%;
        }
        .alert {
            position: fixed;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 5px;
            transition: top 0.5s ease-in-out;
            z-index: 1000;
        }
        
        .good {
            background-color: green;
            color: white;
        }
        
        .bad {
            background-color: red;
            color: white;
        }
        
        .show {
            top: 20px; /* Slide down effect */
        }
        /*------------ FOOTER------------- */
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
     /*--------------------------------------------------- */
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
    document.addEventListener('click', function(event) {
        const avatarContainer = document.querySelector('.avatar-container');
        const dropdown = document.getElementById("dropdown-menu");
        if (!avatarContainer.contains(event.target)) {
        dropdown.style.display = 'none';
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
    let message="<?php echo $_SESSION['MSG'];?>";
    let alertBox = document.querySelector(".alert");
    if(message!="")
    {
    if (alertBox) {
        alertBox.classList.add("show");
        setTimeout(() => {
            alertBox.classList.remove("show");
        }, 4000); // Hide after 4 seconds
    }
    }
    });
</script>
<body>
    <header class="header">
        <div class="logo">eduSphere</div>
        <a class="page-title" href="dashbord.php">Dashboard</a>
        <div class="user-menu">
        <span class="user-name" id="user-name"><?php echo $_SESSION['username']?></span>
        <div class="avatar-container" onclick="toggleDropdown()">
        <div class="avatar" id="user-initials">
            <?php
            if ($_SESSION['profile_picture'] != NULL) {
                echo '<img src="' . substr($_SESSION['profile_picture'], 1) . '" alt="">';
            } else {
                echo htmlspecialchars($_SESSION['INI']);
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
    <?php
    if (isset($_SESSION['MSG']) && isset($_SESSION['MSGTYPE'])) {
        echo '<div class="alert ' . $_SESSION['MSGTYPE'] . '">' . $_SESSION['MSG'] . '</div>';
        unset($_SESSION['MSG']);
        unset($_SESSION['MSGTYPE']);
    }
    ?> 
    <section class="settings-container">
        <div class="profile">
            <h2>Profile</h2>
            <form action="./ChangeProfile/changeProfile.php" method="post" enctype="multipart/form-data">
                <fieldset class="pp-container"> <!-- CHANGED: feildset to fieldset -->
                    <legend>Profile Picture</legend>
                    <div class="avatar2-container">
                        <div class="avatar avabig" id="user-initials">
                            <?php
                            if ($_SESSION['profile_picture'] != NULL) {
                                echo   '<img src="' . substr($_SESSION['profile_picture'], 1) . '" alt="" class="avapic" > 
                                        <span style="display:none;" class="INI">'.$_SESSION['INI'].'</span>';
                            } else {
                                echo   '<img src="' . substr($_SESSION['profile_picture'], 1). '" alt="" class="avapic" style="display:none;"> 
                                        <span class="INI">'.$_SESSION['INI'].'</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <input type="file" name="profile_image" id="fileInput" style="display: none;" accept="image/*">
                    <!-- ✅ ADDED: Update and Delete buttons below avatar -->
                    <div style="margin-top: 1rem;" class="btn">
                        <button class="btn-U"  type="button" onclick="update()">Update</button>
                        <button class="btn-D" type="button" onclick="del()">Delete</button>
                    </div>
                    <input type="checkbox" name="delete" style="display:none;" class="checkbox"/>
                </fieldset>
                <div class="nnE">
                    <div>
                        <legend>Name</legend>
                        <?php
                        echo '<label for="name"><input class ="ne" name="name" type="text" placeholder="Enter you\'re name here" id="name" value="'.$_SESSION['username'].'"/></label>';
                        ?>
                        <!--<label for="name"><input type="text" placeholder="Enter you're name here" id="name"/></label>-->
                    </div>
                    <div>
                        <legend>Email</legend>
                        <?php
                        echo '<label for="email"><input class ="ne" name="email" type="email" placeholder="Enter you\'re email here"id="email" value="'.$_SESSION['email'].'"/></label>';
                        ?>
                    </div>
                    <input type="submit" value="Save" class="save" disabled/>
                </div>
            </form>
        </div>
        <!-- ✅ FIXED: Password section completed -->
        <div class="password">
            <h2>Password</h2>
            <form action="./ChangeProfile/changePassword.php" method="post">
                <div>
                    <legend>Current Password</legend>
                    <label for="current_password">
                        <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required />
                    </label>
                </div>
                <div>
                    <legend>New Password</legend>
                    <label for="new_password">
                        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required />
                    </label>
                </div>
                <input type="submit" value="Update Password" class="update"/>
            </form>
        </div>
    </section>
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

    let change = false;
    let change2 = false;
    let savebutton = document.querySelector('.save');
    let pp="<?php echo $_SESSION['profile_picture']?>";
function update() {
    const input = document.getElementById('fileInput');
    const avatar = document.querySelector('.avabig');
    let INI = document.querySelector('.INI');
    const preview = document.querySelector('.avapic');
    input.click();
    input.addEventListener("change", function () {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if(e.target.result!="")
                {
                INI.style.display = "none";
                preview.src = e.target.result;
                preview.style.display = "block";
                change = true;
                updateSaveButtonState();
                } // Update button state here
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }, { once: true });
}

function del() {
    const input = document.getElementById('fileInput');
    const preview = document.querySelector('.avapic');
    let INI = document.querySelector('.INI');
    if (preview.style.display != "none") {
        preview.style.display = "none";
        INI.style.display = "block";
        input.value = ''; // Reset file input value
        change = true;
        updateSaveButtonState(); // Update button state here
    }
    if(pp!="")
    {
        document.querySelector(".checkbox").checked = true;
    }
}

document.getElementById("name").addEventListener("input", function () {
    change=true;
    updateSaveButtonState(); 
});
document.getElementById("email").addEventListener("input", function () {
    change=true;
    updateSaveButtonState(); 
});
function updateSaveButtonState() {
    if (change) {
        savebutton.disabled = false;
        savebutton.classList.remove("save"); 
    }
    if(change2){
        savebutton2.disabled=false;
        savebutton2.classList.remove("update");
    }
}
let savebutton2=document.querySelector('.update');
document.getElementById("current_password").addEventListener("input", function () {
    change2=true;
    updateSaveButtonState(); 
});
document.getElementById("new_password").addEventListener("input", function () {
    change2=true;
    updateSaveButtonState(); 
});
function toggleDropdown() {
        const menu = document.getElementById("dropdown-menu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }
document.addEventListener('click', function(event) {
        const avatarContainer = document.querySelector('.avatar-container');
        const dropdown = document.getElementById("dropdown-menu");
        if (!avatarContainer.contains(event.target)) {
        dropdown.style.display = 'none';
        }
    });
</script>
</html>