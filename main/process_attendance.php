<?php
include('db.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if attendance data is submitted
    if (isset($_POST['attendance']) && isset($_POST['attendance_date'])) {
        // Get the attendance data from the form
        $attendanceData = $_POST['attendance'];
        $attendanceDate = $_POST['attendance_date'];

        // Loop through the attendance data
        foreach ($attendanceData as $studentId => $present) {
            // Prepare the SQL statement to insert attendance record
            $sql = "INSERT INTO Attendance (student_id, attendance_date, present) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $studentId, $attendanceDate, $present);

            // Execute the SQL statement
            if ($stmt->execute()) {
                echo "Attendance marked successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "No attendance data received!";
    }
} else {
    echo "Invalid request method!";
}

$conn->close(); // Close the database connection
?>
