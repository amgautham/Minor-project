<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['attendance'])) {
        $attendanceData = $_POST['attendance'];

        // Loop through each attendance data
        foreach ($attendanceData as $rollno => $attendance) {
            // Assume attendance is marked as 'Present' or 'Absent'
            $sql = "INSERT INTO attendance (rollno, attendance_date, status) VALUES ('$rollno', NOW(), '$attendance')";
            $conn->query($sql);
        }
        echo "Attendance marked successfully.";
    }
}

$sql = "SELECT * FROM student_electives";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <!-- Add your CSS styles here -->
</head>
<body>

<h1>Mark Attendance</h1>

<form id="attendanceForm" method="post">
    <table border="1">
        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Branch</th>
            <th>Mark Attendance</th>
        </tr>
        <?php
        // Display table data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['rollno']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['branch']}</td>";
            echo "<td>";
            echo "<select name='attendance[{$row['rollno']}]'>";
            echo "<option value='Present'>Present</option>";
            echo "<option value='Absent'>Absent</option>";
            echo "</select>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button type="submit">Submit Attendance</button>
</form>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
