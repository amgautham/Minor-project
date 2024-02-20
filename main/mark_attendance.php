<?php
include('db.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['attendance_date'], $_POST['periods'], $_POST['attendance'], $_POST['subject'])) {
        $attendance_date = $_POST['attendance_date'];
        $periods = $_POST['periods'];
        $subject = $_POST['subject'];
        
        // Fetch students for the selected subject
        $sql = "SELECT * FROM students WHERE open_elective = '$subject'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='periods' value='$periods' />";
            echo "<input type='hidden' name='attendance_date' value='$attendance_date' />";
            echo "<input type='hidden' name='subject' value='$subject' />";
            echo "<table>";
            echo "<tr><th>Roll No</th><th>Name</th><th>Branch</th>";
            for ($i = 1; $i <= $periods; $i++) {
                echo "<th>Period $i <input type='checkbox' class='check-all' data-period='$i'></th>";
            }
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['rollno'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";
                for ($i = 1; $i <= $periods; $i++) {
                    echo "<td><input type='checkbox' name='attendance[" . $row['id'] . "][]' value='$i' class='attendance-checkbox period-$i'></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<button type='submit'>Submit Attendance</button>";
            echo "</form>";
        } else {
            echo "No students found for the selected subject.";
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
