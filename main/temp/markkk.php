<?php
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle attendance marking
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $selected_date = $_POST['attendance_date'];
        $selected_periods = $_POST['periods'];

        // Retrieve attendance for each student
        foreach ($_POST['student_ids'] as $student_id) {
            $status = isset($_POST['attendance_' . $student_id]) ? 'Present' : 'Absent';

            // Insert/update attendance record
            $sql = "REPLACE INTO Attendance (student_id, subject_id, date, status) VALUES ($student_id, {$_POST['subject_id']}, '$selected_date', '$status')";
            $conn->query($sql);
        }

        echo "Attendance marked successfully.";
    }
}

// Assuming logged-in teacher's ID is known
$logged_in_teacher_id = 1; // Change this according to your authentication system
// Retrieve subjects taught by the logged-in teacher
$sql_subjects_taught = "SELECT subject_id, subject_name FROM Subject WHERE teacher_id = $logged_in_teacher_id";

// Retrieve subjects taught by the logged-in teacher
$sql_subjects_taught = "SELECT subject_id, subject_name FROM Subject WHERE teacher_id = $logged_in_teacher_id";
$result_subjects_taught = $conn->query($sql_subjects_taught);

// Retrieve students enrolled in the subjects taught by the logged-in teacher
$students = array();
if ($result_subjects_taught->num_rows > 0) {
    while ($row_subject = $result_subjects_taught->fetch_assoc()) {
        $subject_id = $row_subject['subject_id'];

        $sql_students = "SELECT student_id, rollno, name, branch 
                         FROM Student
                         WHERE open_elective_subject = '{$row_subject['subject_name']}'";
        $result_students = $conn->query($sql_students);

        while ($row_student = $result_students->fetch_assoc()) {
            $students[$subject_id][] = $row_student;
        }
    }
}

// Close the database connection
$conn->close();
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
    <label for="subject">Select Subject:</label>
    <select name="subject_id" id="subject">
        <?php
        while ($row_subject = $result_subjects_taught->fetch_assoc()) {
            echo "<option value='{$row_subject['subject_id']}'>{$row_subject['subject_name']}</option>";
        }
        ?>
    </select>

    <label for="attendance_date">Select Date:</label>
    <input type="date" name="attendance_date" id="attendance_date">

    <label for="periods">Number of Periods:</label>
    <input type="number" name="periods" id="periods" min="1" value="1">

    <?php foreach ($students as $subject_id => $subject_students): ?>
        <h2><?php echo $result_subjects_taught[$subject_id]['subject_name']; ?></h2>
        <table border="1">
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Attendance</th>
            </tr>
            <?php foreach ($subject_students as $student): ?>
                <tr>
                    <td><?php echo $student['rollno']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['branch']; ?></td>
                    <td><input type="checkbox" name="attendance_<?php echo $student['student_id']; ?>" value="present"></td>
                    <!-- You may add hidden input fields to send student IDs -->
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>

    <button type="submit" name="submit">Submit Attendance</button>
</form>

</body>
</html>
