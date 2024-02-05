<?php
// Database connection
include('db.php');

// Loop through POST data to update subjects for each student
foreach ($_POST as $key => $value) {
    // Check if the form field name contains 'subject_'
    if (strpos($key, 'subject_') !== false) {
        // Extract the student's roll number from the form field name
        $rollno = substr($key, strlen('subject_'));

        // Sanitize the subject value to prevent SQL injection
        $subject = $conn->real_escape_string($value);

        // Update the subject for the current student
        $sql_update = "UPDATE students SET open_elective = '$subject' WHERE rollno = '$rollno'";
        $result_update = $conn->query($sql_update);

        if (!$result_update) {
            echo "Error updating subject for roll number: " . $rollno . "<br>";
        }
    }
}

$conn->close();

// Redirect back to the page displaying the form
header("Location: menu.html");
exit();
?>