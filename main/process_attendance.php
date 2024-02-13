<?php
include('db.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $attendance_date = $_POST['attendance_date'];
    $periods = $_POST['periods'];
    $attendanceData = $_POST['attendance'];

    foreach ($attendanceData as $studentId => $attendance) {
        // Update total periods for the student
        $sql = "UPDATE students SET total_periods = total_periods + $periods WHERE id = $studentId";
        $conn->query($sql);

        // Update periods attended for the student
        $attendedPeriods = count($attendance);
        $sql = "UPDATE students SET periods_attended = periods_attended + $attendedPeriods WHERE id = $studentId";
        $conn->query($sql);

        // Insert attendance record for each checkbox checked
        foreach ($attendance as $period) {
            $present = 1; // Assuming checkbox checked indicates present
            $sql = "INSERT INTO attendance (student_id, attendance_date, present) VALUES ($studentId, '$attendance_date', $present)";
            $conn->query($sql);
        }
    }

    echo "Attendance marked successfully!";
} else {
    echo "Invalid request method!";
}

$conn->close(); // Close the database connection
?>
