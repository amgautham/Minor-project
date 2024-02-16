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
    transition: all 0.5s ease; /* Add transition for smooth effect */
    text-align: center; /* Center the text */
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
</style>

    

     </head>
     <body>
        <div class="navbar">
            <div class="buttoncontainer" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <h2>Open Elective Attendance Management System</h2>
        </div>
        
     <div style="padding-top:50px;" class="container">
     
        <div class="tile-container">
            <div class="tile" onclick="navigateTo('allocate.php')">
                <h2>Allocate students with open elective subjects</h2>
            </div>
            <div class="tile" onclick="navigateTo('am1.php')">
                <h2>Mark Attendance</h2>
            </div>
            <div class="tile" onclick="navigateTo('./edit/index.html')">
                <h2>Edit Attendance</h2>
            </div>
            <div class="tile" onclick="navigateTo('report.php')">
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