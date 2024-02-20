<?php
include('db.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['attendance_date']) && isset($_POST['periods']) && isset($_POST['attendance'])) {
        $attendance_date = $_POST['attendance_date'];
        $periods = $_POST['periods'];
        
        // Loop through the attendance data submitted via the form
        foreach ($_POST['attendance'] as $student_id => $periods_attended) {
            // Calculate the total periods attended by the student
            $total_periods_attended = count($periods_attended);
            
            // Fetch student information from the students table
            $sql_student = "SELECT * FROM students WHERE id = $student_id";
            $result_student = $conn->query($sql_student);
            
            if ($result_student->num_rows > 0) {
                $row_student = $result_student->fetch_assoc();
                $rollno = $row_student['rollno'];
                $name = $row_student['name'];
                $branch = $row_student['branch'];
                $open_elective = $row_student['open_elective'];
                
                // Insert attendance data into the attendance table if the checkbox is checked
                if (!empty($periods_attended)) {
                    $sql_insert_attendance = "INSERT INTO attendance (rollno, name, branch, open_elective, periods_attended, total_periods, attendance_date) VALUES ('$rollno', '$name', '$branch', '$open_elective', $total_periods_attended, $periods, '$attendance_date')";
                    if ($conn->query($sql_insert_attendance) === TRUE) {
                        echo "Attendance recorded successfully for $name<br>";
                    } else {
                        echo "Error: " . $sql_insert_attendance . "<br>" . $conn->error;
                    }
                }
            }
        }
    } else {
        echo "Attendance date, periods, or attendance data missing!";
    }
} else {
    echo "Invalid request!";
}

// Close database connection
$conn->close();
?>
