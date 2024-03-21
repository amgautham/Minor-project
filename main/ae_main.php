<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: /Minor-project/login/logsign.php");
    exit();
}

// Continue with the secure page content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendWise Elect</title>
    <link rel="stylesheet">
    <script src="https://kit.fontawesome.com/e285f2fd98.js" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: white;
            color: black;
        }

        #header {
            width: 100%;
            height: 20vh;
            background-image: url();
            background-size: cover;
            background-position: center-right;
        }

        .container {
            padding: 5px 5%;
        }

        .subtitle {
            margin-top: 40px;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        nav ul li {
            display: inline-block;
            list-style: none;
            margin: 10px 20px;
            font-weight: 500;
        }

        nav ul li a {
            color: rgb(0, 0, 0);
            text-decoration: none;
            font-size: 18px;
            position: relative;
        }

        nav ul li a::after {
            content: '';
            width: 0;
            height: 5px;
            background: #d000ff;
            position: absolute;
            left: 0;
            bottom: -6px;
            transition: 0.5s;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        #portfolio {
            padding: 50px 0;
        }

        .work-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 40px;
            margin-top: 50px;
        }

        .work {
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .work img {
            width: 100%;
            border-radius: 10px;
            display: block;
            transition: transform 0.5s;
        }

        .layer {
            color: white;
            width: 100%;
            height: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.6), #d000ff);
            border-radius: 10px;
            position: absolute;
            left: 0;
            bottom: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            font-size: 14px;
            transition: height 0.5s;
        }

        .layer h3 {
            font-weight: 500;
            margin-bottom: 20px;
        }

        .layer a {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            color: #d000ff;
            text-decoration: none;
            font-size: 18px;
            line-height: 60px;
            background: #000000;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
        }

        .work:hover img {
            transform: scale(1.2);
        }

        .work:hover .layer {
            height: 100%;
        }

        .btn {
            display: block;
            margin: 50px auto;
            width: fit-content;
            border: 1px solid #d000ff;
            padding: 14px 50px;
            border-radius: 6px;
            text-decoration: none;
            color: #000000;
        }

        .btn:hover {
            background: #d000ff;
        }

        /* Profile Tile */
        #profile-tile {
            padding: 50px 0;
            background-color: #f9f9f9;
            text-align: center;
        }

        .profile-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .profile-card {
            width: 200px;
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .profile-card p {
            font-size: 14px;
        }

        /* Additional styles for dropdown */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    .copyright {
    width: 100%;
    text-align: center;
    padding: 20px 0;
    background: #d000ff;
    color: white; /* Change text color to white */
    font-weight: 300;
    position: fixed; /* Fix the position */
    bottom: 0; /* Align it to the bottom */
    left: 0; /* Align it to the left */
    z-index: 999; /* Ensure it's on top of other content */
    box-sizing: border-box; /* Include padding in width calculation */
}
.copyright p{
    color: #f9f9f9;
}
.copyright i{
    color: white;
}
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendWise Elect</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a separate CSS file -->
</head>
<body>

<div id="header">
    <div class="container">
        <nav>
            <img src="download.png" class="logo" alt="Logo" height="60px">
            <ul id="sidemenu">
                <li><a href="../login/logout.php" class="btn">Logout</a></li>
            </ul>
        </nav>
        <div class="header-text" style="margin-top: 10px;">
    <?php
    $currentTime = date("H");
    $greeting = "";

    if ($currentTime < 12) {
        $greeting = "Good Morning";
    } elseif ($currentTime < 17) {
        $greeting = "Good Afternoon";
    } else {
        $greeting = "Good Evening";
    }
    ?>
    <h1><?php echo $greeting . " " . $_SESSION['username']; ?></h1>
    <!--<h1><span>Welcome to AttendWise Elect</span></h1>-->
</div>





    </div>
    
</div>



</body>
</html>


<div id="portfolio">
    <div class="container">
        <div class="work-list">
            <div class="work">
                <img src="mark.jpeg">
                <div class="layer" onclick="navigateTo('mark_attendance.php')">
                    <h2>Mark Attendance</h2>
                    <p>Record the presence or absence of individuals at a specified open elective subject with a simple action.</p>
                    
                </div>
            </div>

            <div class="work">
                <img src="report.jpeg">
                <div class="layer" onclick="navigateTo('report.php')">
                    <h2>View Attendance Report</h2>
                    <p>Obtain attendance data presented as a percentage for quick insights into overall attendance rates.</p>
                    
                </div>
            </div>
            <div class="work">
                <img src="editm.jpg">
                <div class="layer" onclick="navigateTo('ed.php')">
                    <h2>Edit Attendance Report</h2>
                    <p>Allows you to view and modify attendance records for a specific date.</p>
                    
                </div>
            </div>
        </div>
        
        
    </div>
</div>


<script>
    function navigateTo(url)
        {
            window.location.href = url;
        }
    // JavaScript code for toggling dropdown visibility
    document.addEventListener("DOMContentLoaded", function() {
        var dropdowns = document.getElementsByClassName("dropdown");
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].addEventListener("click", function() {
                var dropdownContent = this.getElementsByClassName("dropdown-content")[0];
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    });
</script>

</body>
<div class="copyright">
<p>Copyright © MTI CT DEPARTMENT <i class="fa-solid fa-heart"></i></p>
</div>


</html>
