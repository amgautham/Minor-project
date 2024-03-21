<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: /Minor-project/login/logsign.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="favicon.jfif">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <title>Your Website</title>

    <style>
        

        .navbar {
            background-color: #06134b;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            transition: all 0.5s ease;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Ensure navbar stays on top */
        }

.buttoncontainer {
    display: inline-block;
    cursor: pointer;
    float: right; /* Align the button container to the right */
}

.bar1, .bar2, .bar3 {
    width: 35px;
    height: 5px;
    background-color: #e8e8e8; /* Light Grey */
    margin: 8px 10px;
    transition: 0.4s;
}

.change .bar1 {
    transform: translate(0, 13px) rotate(-45deg);
}

.change .bar2 {
    opacity: 0;
}

.change .bar3 {
    transform: translate(0, -13px) rotate(45deg);
}
.logout-link {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            background-color: #00008B; /* Red color for logout */
            transition: background-color 0.3s;
        }

        .logout-link:hover {
            background-color: #00FFFF; /* Darker red on hover */
        }
</style>

    

     </head>
     <body>
        <div class="navbar">
           
            <h2>Welcome Admin</h2>

        
                    
                    
            <a href="../login/logout.php" class="logout-link">Logout</a>
                    
                
                
                
        </div>
        
     <div style="padding-top:50px;" class="container">
     
        <div class="tile-container">
            <div class="tile" onclick="navigateTo('../main/allocate.php')">
                <h2>Allocate students with open elective subjects</h2>
            </div>
            <div class="tile" onclick="navigateTo('../main/mark_attendance.php')">
                <h2>Mark Attendance</h2>
            </div>
            <div class="tile" onclick="navigateTo('../main/ed.php')">
                <h2>Edit Attendance</h2>
            </div>
            <div class="tile" onclick="navigateTo('../main/report.php')">
                <h2>View Attendance Report</h2>
            </div>
        </div>
    </div>

    

    <script>
        function navigateTo(url)
        {
            window.location.href = url;
        }
        function myFunction(x) 
        {
        x.classList.toggle("change");
        }
    </script>
</body>
</html>