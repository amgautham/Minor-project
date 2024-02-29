<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    
    $create_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if Create Password and Confirm Password match
    if ($create_password !== $confirm_password) {
        echo "Create Password and Confirm Password do not match.";
    } else {
        $password = password_hash($create_password, PASSWORD_DEFAULT);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);

        // Check if username already exists
        $check_username_sql = "SELECT * FROM users WHERE username = '$username'";
        $result_username = $conn->query($check_username_sql);

        if ($result_username->num_rows > 0) {
            echo "Username is already taken.";
        } else {
            // Check if subject already exists
            $check_subject_sql = "SELECT * FROM users WHERE subject = '$subject'";
            $result_subject = $conn->query($check_subject_sql);

            if ($result_subject->num_rows > 0) {
                echo "Subject is already taken.";
            } else {
                // If both username and subject are unique, proceed with insertion
                $sql = "INSERT INTO users (username, password, subject) VALUES ('$username', '$password', '$subject')";

                if ($conn->query($sql) === TRUE) {
				header("Location: /Minor-project/main/menu.php");

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}

$conn->close();
?>
