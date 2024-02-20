<?php
// Your database connection code
include('db.php');
session_start();

// Check if user is logged in and subject is set
if (!isset($_SESSION['username']) || !isset($_SESSION['subject'])) {
    header("Location: /login.html");
    exit;
}

// Fetch attendance records based on subject and date
$subject = $_SESSION['subject'];
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$sql = "SELECT * FROM attendance WHERE subject = '$subject' AND attendance_date = '$date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Attendance for $subject on $date:</h2>";
    echo "<form method='post' action=''>";
    echo "<input type='hidden' name='subject' value='$subject'>";
    echo "<input type='hidden' name='attendance_date' value='$date'>";
    echo "<table>";
    echo "<tr><th>Roll No</th><th>Name</th><th>Branch</th><th>Periods Attended</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['rollno'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td><input type='number' name='attendance[" . $row['id'] . "]' value='" . $row['periods_attended'] . "' min='0'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<button type='submit' name='submit_edit'>Submit Changes</button>";
    echo "</form>";
} else {
    echo "No attendance records found for $subject on $date";
}

// Handle form submission to update attendance records
if (isset($_POST['submit_edit'])) {
    foreach ($_POST['attendance'] as $student_id => $periods_attended) {
        $sql_update = "UPDATE attendance SET periods_attended = '$periods_attended' WHERE id = '$student_id'";
        if ($conn->query($sql_update) !== TRUE) {
            echo "Error updating attendance: " . $conn->error;
        }
    }
    echo "Attendance records updated successfully.";
}
?>
