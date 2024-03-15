<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="date" name="start_date">
        <input type="date" name="end_date">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
include('db.php');
session_start();

$subject = $_SESSION['subject'];
$sql_table = "SELECT table_name FROM subjects WHERE subject = '$subject'";
$result_table = $conn->query($sql_table);

if ($result_table->num_rows > 0) {
    $row_table = $result_table->fetch_assoc();
    $table_name = $row_table['table_name'];
    echo "Table name for $subject: $table_name <br>";

    // Proceed with the rest of the code using $table_name
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        echo "Start Date: $start_date, End Date: $end_date <br>";

        // Make sure to properly format the dates for SQL query
        $formatted_start_date = date('Y-m-d', strtotime($start_date));
        $formatted_end_date = date('Y-m-d', strtotime($end_date));

        // Query to retrieve student attendance report
        $query = "SELECT rollno, name, SUM(periods_attended) AS total_attended
                  FROM $table_name
                  WHERE attendance_date BETWEEN '$formatted_start_date' AND '$formatted_end_date'
                  GROUP BY rollno, name";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Total Periods Attended</th>
                        <th>Attendance Percentage</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                $rollno = $row['rollno'];
                $name = $row['name'];
                $total_attended = $row['total_attended'];

                // Fetch total periods attended sum
                $tquery = "SELECT SUM(total_periods) AS total_periods_sum FROM total_periods_tracker WHERE date BETWEEN '$formatted_start_date' AND '$formatted_end_date'";
                $total_periods_result = $conn->query($tquery);
                $total_periods_row = $total_periods_result->fetch_assoc();
                $total_periods_sum = $total_periods_row['total_periods_sum'];

                // Calculate attendance percentage
                $attendance_percentage = ($total_attended / $total_periods_sum) * 100;

                echo "<tr>
                        <td>$rollno</td>
                        <td>$name</td>
                        <td>$total_attended</td>
                        <td>$attendance_percentage%</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found.";
        }
    }
} else {
    echo "Table name not found for $subject";
}
?>
