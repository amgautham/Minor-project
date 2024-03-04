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

    .button-mark,.button-report {
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

    .button-mark,.button-report:hover {
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

      <div class="button-mark" onclick="navigate('am1.php')">
        <img src="mark.png" alt="Mark" class="icon">
        <div class="label">Mark</div>
      </div>

      <div class="button-report" onclick="navigate('report.php')">
        <img src="report.png" alt="Report" class="icon">
        <div class="label">Report</div>
      </div>
    </section>
  </div>

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
        <button class="allocate-button" onclick="navigate('allocate.php')">Allocate students with open elective subjects</button>
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
    // Function to navigate and update the browser history
    function navigate(url) {
      // Use location.href to navigate without triggering a full page reload
      window.location.href = url;
    }

    // Function to logout and redirect to login page
    function logout() {
      // Use location.href to navigate without triggering a full page reload
      window.location.href = '/Minor-project/login/logsign.php';
    }

    document.addEventListener('DOMContentLoaded', function () {
      // Check if the user is logged in, prevent navigating back to the menu page
      if (!<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>) {
        window.location.href = '/Minor-project/login/logsign.php';
      }

      // Assign the navigate function to your button clicks
      const markButton = document.querySelector('.button-mark');
      const reportButton = document.querySelector('.button-report');

      markButton.addEventListener('click', function (event) {
        event.preventDefault();
        navigate('am1.php');
      });

      reportButton.addEventListener('click', function (event) {
        event.preventDefault();
        navigate('report.php');
      });

      // Listen for popstate event (back/forward button)
      window.onpopstate = function (event) {
        if (event.state) {
          // Force a full page reload after a short delay
          setTimeout(function () {
            window.location.reload();
          }, 100);
        }
      };

      // Handle navigation to sections
      function showSection(sectionId) {
        const sections = document.querySelectorAll('section');
        sections.forEach(section => {
          section.classList.remove('visible');
        });

        const selectedSection = document.getElementById(sectionId);
        selectedSection.classList.add('visible');
      }

      // Attach the showSection function to your navigation links
      const homeLink = document.querySelector('a[href="#home"]');
      const profileLink = document.querySelector('a[href="#profile"]');
      const settingsLink = document.querySelector('a[href="#settings"]');

      homeLink.addEventListener('click', function (event) {
        event.preventDefault();
        showSection('home');
      });

      profileLink.addEventListener('click', function (event) {
        event.preventDefault();
        showSection('profile');
      });

      settingsLink.addEventListener('click', function (event) {
        event.preventDefault();
        showSection('settings');
      });
    });
  </script>

</body>
</html>

<?php
} else {
  // Handle the case where the user data is not found
  echo "<p>User data not found!</p>";
}
?>