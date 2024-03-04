<?php
include('db.php');
session_start();

$subject = $_SESSION['subject'];

$sql_table = "SELECT table_name FROM subjects WHERE subject = '$subject'";
$result_table = $conn->query($sql_table);

if (!$result_table) {
    // Check for query execution failure
    echo "Error fetching table name: " . $conn->error;
} else {
    // Check if any rows were returned
    if ($result_table->num_rows > 0) {
        $row_table = $result_table->fetch_assoc();
        $table_name = $row_table['table_name'];
        echo "Table name for $subject: $table_name";
        // Proceed with the rest of the code using $table_name
    } else {
        echo "Table name not found for $subject";
    }
}


if (isset($_POST['date'])) {
    $edit_date = $_POST['date'];
    // Fetch attendance records for the selected date
    $sql = "SELECT * FROM $table_name WHERE attendance_date = '$edit_date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Edit Attendance for Date: $edit_date</h2>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='edit_date' value='$edit_date'>";
        echo "<table>";
        echo "<tr><th>Roll No</th><th>Name</th><th>Periods Attended</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['rollno'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td><input type='number' name='periods_attended[" . $row['id'] . "]' value='" . $row['periods_attended'] . "' min='0'></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<button type='submit' name='submit_edit_attendance'>Submit Changes</button>";
        echo "</form>";
    } else {
        echo "No attendance records found for $edit_date";
    }
}

// Handle form submission for editing attendance
if (isset($_POST['submit_edit_attendance'])) {
    $edit_date = $_POST['edit_date'];
    $periods_attended = $_POST['periods_attended'];
    foreach ($periods_attended as $student_id => $attended_periods) {
        $sql_update = "UPDATE $table_name SET periods_attended = '$attended_periods' WHERE id = '$student_id'";
        if ($conn->query($sql_update) !== TRUE) {
            echo "Error updating attendance: " . $conn->error;
        }
    }
    echo "Attendance data updated successfully.";
}
?>
