<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);

    $sql = "INSERT INTO users (username, password, subject) VALUES ('$username', '$password', '$subject')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
