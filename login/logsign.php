<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Sign In Logic
        $username = $_POST['usernamelog'];
        $password = $_POST['passwordlog'];

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $sub = $row['subject'];

                $_SESSION['username'] = $username;
                $_SESSION['subject'] = $sub;
                header("Location: /Minor-project/main/pig.php");
               // header("Location: /Minor-project/main/menu.php");
                exit;
            } else {
                echo "<div class='error-message'>Wrong password. Please try again.</div>";
            }
        } else {
            echo "User not found!";
        }

        $stmt->close(); // Close the statement
        $conn->close(); // Close the database connection

    } elseif (isset($_POST['signup'])) {
        // Sign Up Logic
        $username = $_POST['username'];
        $password = $_POST['password'];
        $subject = $_POST['subject'];

        // Check if the subject is already taken
        $subject_check_sql = "SELECT * FROM users WHERE subject = ?";
        $subject_check_stmt = $conn->prepare($subject_check_sql);
        $subject_check_stmt->bind_param("s", $subject);
        $subject_check_stmt->execute();

        $subject_check_result = $subject_check_stmt->get_result();

        if ($subject_check_result->num_rows > 0) {
            echo "Subject is already taken!";
            exit; // Stop execution if the subject is taken
        }

        // Check if the username is already taken
        $username_check_sql = "SELECT * FROM users WHERE username = ?";
        $username_check_stmt = $conn->prepare($username_check_sql);
        $username_check_stmt->bind_param("s", $username);
        $username_check_stmt->execute();

        $username_check_result = $username_check_stmt->get_result();

        if ($username_check_result->num_rows > 0) {
            echo "Username already exists!";
            exit; // Stop execution if the username is taken
        }

        // Use prepared statements to insert user data securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (username, password, subject) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $username, $hashed_password, $subject);

        if ($insert_stmt->execute()) {
            header("Location: /Minor-project/main/menu.php");
            exit;
        } else {
            echo "Error registering user!";
        }

        $insert_stmt->close(); // Close the insert statement
        $username_check_stmt->close(); // Close the username check statement
        $subject_check_stmt->close(); // Close the subject check statement
        $conn->close(); // Close the database connection
    }
}
?>

<!DOCTYPE html>
<!-- saved from url=(0044)file:///C:/Users/gouth/Downloads/signin.html -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendWise Elect</title>
    <!-- Your CSS styles go here -->
    <style>
         body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: 'Raleway', sans-serif;
    margin: 0;
}

.left-section,
.second-right-section,
.right-section,
.second-left-section {
    padding: 20px;
    width: 50%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.left-section {
    background-color: #f7f7f7;
}

.second-right-section {
    background-color: #f7f7f7;
}

.right-section {
    background: linear-gradient(to right, #4B0082, #8A2BE2);
    color: white;
}

.second-left-section {
    background: linear-gradient(to right, #00FFFF, #008B8B);
    color: white;
}

h2 {
    margin-bottom: 20px;
    font-family: 'Montserrat', sans-serif;
}

p {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 15px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 15px;
    box-sizing: border-box; /* Ensure padding and border are included in the total width/height */
}

.form-group select {
    appearance: none;
    -webkit-appearance: none;
    background-color: #fff;
    color: #555;
}

.form-group select::after {
    content: '\25BC';
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    pointer-events: none;
}

.form-group select:hover,
.form-group select:focus {
    border-color: #8A2BE2;
}

button {
    padding: 12px 24px;
    background-color: #4B0082;
	justify-content: center;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #8A2BE2;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 20px; /* Adjust the margin as needed */
}

.button-container button {
    margin: 0 10px; /* Adjust the margin between buttons as needed */
}

a {
    color: #4B0082;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #8A2BE2;
}

/* Animation keyframes and styles */
@keyframes typing {
    from {
        width: 0;
        opacity: 0;
    }
    to {
        width: 100%;
        opacity: 1;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.typing-animation1 {
    display: inline-block;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    opacity: 0; /* Set initial opacity to 0 */

    /* Apply typing animation to both lines */
    animation: typing 5s steps(80, end) forwards, fadeIn 1s ease-in-out forwards;

    /* Delay the second line animation */
    animation-delay: 0.3s; /* Half of the typing duration of the first line (5s/2) */
}
.typing-animation2 {
    display: inline-block;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    opacity: 0; /* Set initial opacity to 0 */

    /* Apply typing animation to both lines */
    animation: typing 5s steps(80, end) forwards, fadeIn 1s ease-in-out forwards;

    /* Delay the second line animation */
    animation-delay: 2.0s; /* Half of the typing duration of the first line (5s/2) */
}


</style>
</head>
<body>
    <div class="left-section">
        <h1>Welcome to AttendWise Elect!</h1>
        <div id="line1" class="typing-animation1">Your platform for tracking student attendance in elective subjects at our college.</div>
        <div id="line2" class="typing-animation2">Sign in to manage attendance efficiently and stay organized.</div>
    </div>
    <div class="right-section">
        <h2>Login</h2>
        <form action="logsign.php" method="post">
            <div class="form-group">
                <label for="namelog">Name</label>
                <input type="text" id="namelog" name="usernamelog" required="">
            </div>
            <div class="form-group">
                <label for="passwordlog">Password</label>
                <input type="password" id="passwordlog" name="passwordlog" required="">
            </div>
            <div class="button-container">
                <button type="submit" name="login">Login</button>
            </div>

        </form>
        <p>Already registered? <a href="#" id="signupLink">SignUp</a></p>
    </div>
    <div class="second-right-section" style="display: none;">
        <h2>Register</h2>
        <form action="logsign.php" method="post" id="signUpForm">
            <div class="form-group">
                <label for="name">Create Username</label>
                <input type="text" id="name" name="username" required="">
            </div>
            <div class="form-group">
                <label for="password">Create Password</label>
                <input type="password" id="password" name="password" required="">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required="">
            </div>
            <div class="form-group">
                <label for="Subject">Choose Subject</label>
                <select name="subject" id="sub">
                    <option disabled selected>(Select Subject)</option>
                    <option value="Introduction to IoT">Introduction to IoT</option>
                    <option value="Fundamentals of Web Technology">Fundamentals of Web Technology</option>
					<option value="Multimedia">Multimedia</option>
					<option value="Cloud Computing">Cloud Computing</option>
					<option value="Renewable Energy and Environment">Renewable Energy and Environment</option>
					<option value="Sustainable Development">Sustainable Development</option>
					<option value="Disaster Management (CE)">Disaster Management (CE)</option>
					<option value="Rural Technology">Rural Technology</option>
					<option value="Solar Power Technologies">Solar Power Technologies</option>
					<option value="Energy Conservation & Management">Energy Conservation & Management</option>
					<option value="Electrification of Residential Buildings">Electrification of Residential Buildings</option>
					<option value="Electric Vehicles & Traction">Electric Vehicles & Traction</option>
					<option value="Concepts of IoT">Concepts of IoT</option>
					<option value="Contemporary Electronics">Contemporary Electronics</option>
					<option value="Introduction to Hybrid and Electric Vehicles">Introduction to Hybrid and Electric Vehicles</option> 
					<option value="Introduction to Multimedia">Introduction to Multimedia</option>
					<option value="Computer Aided Design and Manufacturing">Computer Aided Design and Manufacturing</option>
					<option value="Operation Research">Operation Research</option>
					<option value="Renewable Energy Technologies">Renewable Energy Technologies</option>
					<option value="Product Design">Product Design</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="button-container">
                <button type="submit" name="signup">SignUp</button>
            </div>
        </form>
        <p>Already registered? <a href="#" id="loginLink">Login</a></p>
    </div>
    <div class="second-left-section" style="display: none;">
        <h1>SignIn to AttendWise Elect!</h1>
        <div id="line3" class="typing-animation1">Create platform for tracking student attendance in elective subjects at your college.</div>
        <div id="line4" class="typing-animation2">Create in to manage attendance efficiently and stay organized.</div>
    </div>
    <!-- Include your existing HTML content from signin.html here -->

    <script>
        // Your JavaScript code goes here
        document.addEventListener('DOMContentLoaded', function() {
            const signUpLink = document.getElementById('signupLink');
    const loginLink = document.getElementById('loginLink');
    const rightSection = document.querySelector('.right-section');
    const secondRightSection = document.querySelector('.second-right-section');
    const leftSection = document.querySelector('.left-section');
    const secondLeftSection = document.querySelector('.second-left-section');

    signUpLink.addEventListener('click', function(event) {
        event.preventDefault();
        rightSection.style.display = 'none';
        secondRightSection.style.display = 'flex';
        leftSection.style.display = 'none';
        secondLeftSection.style.display = 'flex';
        
    });

    loginLink.addEventListener('click', function(event) {
        event.preventDefault();
        rightSection.style.display = 'flex';
        secondRightSection.style.display = 'none';
        leftSection.style.display = 'flex';
        secondLeftSection.style.display = 'none';
    });

            const signUpForm = document.getElementById('signUpForm');

            signUpForm.addEventListener('submit', function(event) {
                const subjectSelect = document.getElementById('sub');
                const passwordInput = document.getElementById('password');
                const confirmPasswordInput = document.getElementById('confirm_password');

                // Check if a subject is selected
                if (passwordInput.value !== confirmPasswordInput.value) {
                    alert("Password and confirm password do not match.");
                    event.preventDefault(); // Prevent form submission
                }
                if (subjectSelect.value === "(Select Subject)") {
                    alert("Please choose a subject.");
                    event.preventDefault(); // Prevent form submission
                }
                // Check if password and confirm password match
            });
        });
    </script>
</body>
</html>