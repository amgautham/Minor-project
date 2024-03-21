<?php
// Include database connection file
include('db.php');

// Collect form data
$branch = $_POST['branch'];
$subject = $_POST['subject'];
$name = $_POST['name'];
$rollno = $_POST['rollno'];

// Insert data into the database
$sql = "INSERT INTO students (branch, open_elective,name, rollno) VALUES ('$branch', '$subject', '$name', '$rollno')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
