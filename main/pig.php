<?php
include('db.php');
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
  header("Location: /Minor-project/login/logsign.php");
  exit();
}

$username = $_SESSION['username'];

$profile_sql = "SELECT * FROM users WHERE username = ?";
$profile_stmt = $conn->prepare($profile_sql);
$profile_stmt->bind_param("s", $username);
$profile_stmt->execute();

$profile_result = $profile_stmt->get_result();

if ($profile_result->num_rows > 0) {
  $profile_row = $profile_result->fetch_assoc();
  $user_subject = $profile_row['subject'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AttendWise Elect</title>
  
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      padding: 15px;
      color: white;
      text-align: center;
      font-size: 24px;
    }

    .navbar {
      background-color: #555;
      overflow: hidden;
    }

    .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    .container {
      width: 80%;
      margin: 20px auto;
      text-align: center;
    }

    .title {
      font-size: 36px;
      font-weight: bold;
      color: #333;
    }

    .hashtag {
      font-size: 24px;
      color: #999;
      margin-bottom: 20px;
    }

    .button {
      display: inline-block;
      width: 250px;  /* Increased width */
      height: 250px; /* Increased height */
      margin: 20px;
      border-radius: 20px;
      background-color: #eee;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
    }

    .button:hover {
      background-color: #ddd;
      transform: scale(1.1);
    }

    .icon {
      width: 120px; /* Adjusted icon size */
      height: 120px; /* Adjusted icon size */
      margin-top: 20px;
    }

    .label {
      font-size: 18px;
      font-weight: bold;
      color: #333;
      margin-top: 10px;
    }

    .icon:hover {
      filter: brightness(120%);
    }

    section {
      display: none;
    }

    .visible {
      display: block;
    }

    .profile-section {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        text-align: left; /* Align the content to the left */
    }

    .profile img {
        border-radius: 50%;
        max-width: 100px;
        margin-right: 20px;
    }

    .tags {
        margin-top: 10px;
    }

    .tag {
        background-color: red;
        color: white;
        padding: 5px 10px;
        margin-right: 10px;
        font-size: 12px;
        border-radius: 5px;
    }

    .allocate-button {
        padding: 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        display: block; /* Make the button a block-level element */
        width: 100%; /* Full width of its container */
        text-align: center;
    }

    .allocate-button:hover {
        background-color: #45a049;
    }

    .bio {
        padding: 20px;
    }
    
  </style>
  <script>
    // Prevent caching and force a fresh page load when navigating back
    window.onpageshow = function (event) {
      if (event.persisted) {
        window.location.reload();
      }
    };

    // Function to logout and redirect to login page
    function logout() {
      // Clear the session on the server side
      <?php session_destroy(); ?>

      // Redirect to the login page
      window.location.href = "logsign.php";
    }
  </script>
</head>
<body>

  <header>
    AttendWise Elect
  </header>

  <div class="navbar">
    <a href="#home" onclick="showSection('home')">Home</a>
    <a href="#profile" onclick="showSection('profile')">Profile</a>
    <a href="#settings" onclick="showSection('settings')">Settings</a>
  </div>

  <div class="container">
    <!-- Home Section -->
    <section id="home" class="visible">
      <div class="title">Welcome to AttendWise Elect</div>
      <div class="hashtag">#innovation</div>

      <div class="button" onclick="showAlert('am1.php')">
        <img src="mark.png" alt="Mark" class="icon">
        <div class="label">Mark</div>
      </div>

      <div class="button" onclick="showAlert('report.php')">
        <img src="report.png" alt="Report" class="icon">
        <div class="label">Report</div>
      </div>
    </section>


<!-- Profile Section -->
<section id="profile" class="profile-section">
  <header>
    <div class="profile">
      <!-- Update the image source accordingly -->
      <img src="pr.png" alt="<?php echo $username; ?>">
      <h1><?php echo $username; ?></h1>
      <p><?php echo $user_subject; ?></p>
      <div class="tags">
        <!-- You can dynamically generate tags based on user data -->
        <span class="tag">Looking for new opportunities</span>
        <span class="tag">Interested in business trips</span>
      </div>
      <button class="allocate-button" onclick="showAlert('allocate.php')">Allocate students with open elective subjects</button>
    </div>
  </header>

  <!-- Logout button -->
  <button class="allocate-button" onclick="logout()">Logout</button>

  <section class="bio">
    <h2>Bio</h2>
    <p>Jill is a Regional Director who travels 4–6 times each month for work. She has been engaging in various niche travels, and she understands that security and safety are essential. She is frustrated by the fact that no matter how frequently Jill takes similar trips, she spends hours on end doing booking via SMEs’ protocols that should (obviously) be as digitized as she is.</p>
  </section>
</section>

  <script>
    function showAlert(url) {
      window.location.href = url;
    }
    function logout() {
    // Redirect to the login page
    window.location.href = "logsign.php";
  }

    function showSection(sectionId) {
      const sections = document.querySelectorAll('section');
      sections.forEach(section => {
        section.classList.remove('visible');
      });

      const selectedSection = document.getElementById(sectionId);
      selectedSection.classList.add('visible');
    }
  </script>

</body>
</html>
<?php
} else {
  // Handle the case where the user data is not found
  echo "<p>User data not found!</p>";
}
?>