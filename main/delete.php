<?php
include('db.php');
session_start();

$subject = $_SESSION['subject'];
$sql_table = "SELECT table_name FROM subjects WHERE subject = '$subject'";
$result_table = $conn->query($sql_table);

    if ($result_table->num_rows > 0) {
        $row_table = $result_table->fetch_assoc();
        $table_name = $row_table['table_name'];
        echo "Table name for $subject: $table_name";
        // Proceed with the rest of the code using $table_name
    } else {
        echo "Table name not found for $subject";
    }
if (isset($_POST['date'])) {
    $delete_date = $_POST['date'];
    // Delete attendance records for the selected date
    $sql_delete = "DELETE FROM $table_name WHERE attendance_date = '$delete_date'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Attendance records for date $delete_date deleted successfully.";
    } else {
        echo "Error deleting attendance records: " . $conn->error;
    }
}
?>
