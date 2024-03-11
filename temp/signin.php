<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['usernamelog']; 
    $password = $_POST['passwordlog']; // Get the password from the form

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

            header("Location: /Minor-project/main/menu.php");
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the database connection
}
?>
