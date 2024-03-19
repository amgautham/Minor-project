<?php
include('db.php');
session_start();
$a1 = $a2 = $a3 = $a4 = $a5 = $a6 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) 
    {
        // Sign In Logic
        $username = $_POST['usernamelog'];
        $password = $_POST['passwordlog'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute a SQL query to retrieve the hashed password and user type for the provided username
        $stmt = $conn->prepare("SELECT password, user_type,subject FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            // Check for query execution failure
            echo "Error fetching user data: " . $conn->error;
        } else {
            // Check if a row was found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stored_password_hash = $row['password'];
                $sub = $row['subject'];
                $admin = $row['user_type'];
                // Verify if the hashed password provided by the user matches the hashed password retrieved from the database
                if (password_verify($password, $stored_password_hash)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['subject'] = $sub;
                    $_SESSION['user_type'] = $admin;
                    // Redirect based on user type
                    if ($row['user_type'] === 'admin') {
                        header("Location: /Minor-project/temp/menu.php");
                    } else {
                        header("Location: /Minor-project/main/ae_main.php");
                    }
                    exit;
                } else {
                    $a1 =  "Wrong username or password!";
                }
            } else {
                $a1 =  "User not found!";
            }
        }

        $stmt->close(); // Close the statement
    }
    elseif (isset($_POST['signup'])) 
    {
        $username = $_POST['username'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];

    // Check if the username is already taken
    $username_check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $username_check_stmt->bind_param("s", $username);
    $username_check_stmt->execute();
    $username_check_result = $username_check_stmt->get_result();

    if (!$username_check_result) {
        // Check for query execution failure
        echo "Error checking username availability: " . $conn->error;
    } else {
        if ($username_check_result->num_rows > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                const rightSection = document.querySelector('.right-section');
                const secondRightSection = document.querySelector('.second-right-section');
                const leftSection = document.querySelector('.left-section');
                const secondLeftSection = document.querySelector('.second-left-section');

                rightSection.style.display = 'none';
                secondRightSection.style.display = 'flex';
                leftSection.style.display = 'none';
                secondLeftSection.style.display = 'flex';
            });
          </script>";
            $a4 = "Username already exists!";
        } else {
            // Check if the subject is already taken
            $subject_check_stmt = $conn->prepare("SELECT * FROM users WHERE subject = ?");
            $subject_check_stmt->bind_param("s", $subject);
            $subject_check_stmt->execute();
            $subject_check_result = $subject_check_stmt->get_result();

            if (!$subject_check_result) {
                // Check for query execution failure
                echo "Error checking subject availability: " . $conn->error;
            } else {
                if ($subject_check_result->num_rows > 0) {
                    echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                const rightSection = document.querySelector('.right-section');
                const secondRightSection = document.querySelector('.second-right-section');
                const leftSection = document.querySelector('.left-section');
                const secondLeftSection = document.querySelector('.second-left-section');

                rightSection.style.display = 'none';
                secondRightSection.style.display = 'flex';
                leftSection.style.display = 'none';
                secondLeftSection.style.display = 'flex';
            });
          </script>";
                    $a6 = "Subject already taken!";
                } else {
                    // Use prepared statements to insert user data securely
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $user_type = 'user'; // Default user type value
                    $insert_stmt = $conn->prepare("INSERT INTO users (username, password, subject, user_type) VALUES (?, ?, ?, ?)");
                    $insert_stmt->bind_param("ssss", $username, $hashed_password, $subject, $user_type);

                    if (!$insert_stmt) {
                        // Check for query preparation failure
                        echo "Error preparing user insertion: " . $conn->error;
                    } else {
                        if ($insert_stmt->execute()) {
                            //echo "Sucess";
                            $_SESSION['username'] = $username;
                            $_SESSION['subject'] = $subject;
                            $_SESSION['user_type'] = $user_type;
                            header("Location: /Minor-project/main/ae_main.php");
                            exit; // Redirect to ae_main.php after successful registration
                        } else {
                            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                const rightSection = document.querySelector('.right-section');
                const secondRightSection = document.querySelector('.second-right-section');
                const leftSection = document.querySelector('.left-section');
                const secondLeftSection = document.querySelector('.second-left-section');

                rightSection.style.display = 'none';
                secondRightSection.style.display = 'flex';
                leftSection.style.display = 'none';
                secondLeftSection.style.display = 'flex';
            });
          </script>";
                            $a5 = "Error registering user!";
                        }
                    }
                    $insert_stmt->close();
                }
            }
            $subject_check_stmt->close();
        }
    }
    $username_check_stmt->close();
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
                <label for="namelog" style="color: white;">Name</label>
                <input type="text" id="namelog" name="usernamelog" required=""> <?php
                echo "<p>$a2</p>" ;
                ?>
                
            </div>
            <div class="form-group">
                <label for="passwordlog" style="color: white;">Password</label>
                <input type="password" id="passwordlog" name="passwordlog" required="">
                <?php
                echo "<p>$a1</p>" ;
                ?>
            </div>
            <div class="button-container">
                <button type="submit" name="login">Login</button>
            </div>

        </form>
        <p>Don't have an account? <a href="#" id="signupLink" style="color: white;"><u>SignUp Now</u></a></p>
    </div>
    <div class="second-right-section" style="display: none;">
        <h2>Register</h2>
        <form action="logsign.php" method="post" id="signUpForm">
            <div class="form-group">
                <label for="name">Create Username</label>
                <input type="text" id="name" name="username" required="">
                <?php
                echo "<p>$a4</p>";
                ?>
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
                <?php
                echo "<p>$a6</p>";
                ?>
            </div>
            <div class="button-container">
                <button type="submit" name="signup">SignUp</button>
                
            </div>
        </form>
        <?php
                echo "<p>$a5</p>";
                ?>
        
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