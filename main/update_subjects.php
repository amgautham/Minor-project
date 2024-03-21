<?php
session_start();
// Database connection
include('db.php');
$error = false;
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
            $error = true;
            echo "Error updating subject for roll number: " . $rollno . "<br>";
        }
    }
}

$conn->close();

if (!$error) {
    // Display JavaScript alert for success
    $_SESSION['success_message'] = "Subjects updated successfully";
}

// Redirect back to the page displaying the form
header("Location: allocate.php");
exit();
?>