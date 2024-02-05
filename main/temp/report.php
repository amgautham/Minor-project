<?php
include('db.php');

// Assume $logged_in_teacher_id is set based on the logged-in teacher
// You need to implement the mechanism to get the logged-in teacher's ID

// Retrieve subjects taught by the logged-in teacher
$sql_teacher_subject = "SELECT subject_id FROM teacher_subject WHERE teacher_id = $logged_in_teacher_id";
$result_teacher_subject = $conn->query($sql_teacher_subject);

$subject_ids = [];
while ($row_teacher_subject = $result_teacher_subject->fetch_assoc()) {
    $subject_ids[] = $row_teacher_subject['subject_id'];
}

// Retrieve students enrolled in the subjects taught by the logged-in teacher
$sql_students = "SELECT * FROM student_electives WHERE subject_id IN (" . implode(',', $subject_ids) . ")";
$result_students = $conn->query($sql_students);
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
        while ($row_students = $result_students->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row_students['rollno']}</td>";
            echo "<td>{$row_students['name']}</td>";
            echo "<td>{$row_students['branch']}</td>";
            echo "<td>";
            echo "<select name='attendance[{$row_students['rollno']}]'>";
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
