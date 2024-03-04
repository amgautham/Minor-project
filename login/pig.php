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

      <div class="button" onclick="showAlert()">
        <img src="mark.png" alt="Mark" class="icon">
        <div class="label">Mark</div>
      </div>

      <div class="button" onclick="showAlert()">
        <img src="report.png" alt="Report" class="icon">
        <div class="label">Report</div>
      </div>
    </section>

    <!-- Profile Section -->
    <section id="profile">
      <!-- Add content for the profile section here -->
      <div class="title">User Profile</div>
      <p>Profile content goes here...</p>
    </section>

    <!-- Settings Section -->
    <section id="settings">
      <!-- Add content for the settings section here -->
      <div class="title">Settings</div>
      <p>Settings content goes here...</p>
    </section>
  </div>

  <script>
    function showAlert() {
      alert("Button Clicked! You can add more functionality here.");
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