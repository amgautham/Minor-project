<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <style>
        /* Basic styling for the form */
        body {
            font-family: Arial, sans-serif;
        }

        form {
            margin: 20px auto;
            text-align: center;
        }

        form input[type="date"] {
            margin: 5px;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        /* Styling for the table */
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Circular progress bar */
        .progress-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            overflow: hidden;
            position: relative;
        }

        .progress-circle-fill {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #007bff;
            clip-path: polygon(50% 50%, 50% 0%, 0% 0%);
            transform-origin: bottom center;
            transform: rotate(0deg);
        }

        .percentage-text {
            text-align: center;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<form method="post">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">

    <input type="submit" value="Submit">
</form>

<?php
// Include the database connection file
include('db.php');

// Start session
session_start();

// Get subject from session
$subject = $_SESSION['subject'];

// Retrieve table name for the subject
$sql_table = "SELECT table_name FROM subjects WHERE subject = '$subject'";
$result_table = $conn->query($sql_table);

// Check if table name is found
if ($result_table->num_rows > 0) {
    $row_table = $result_table->fetch_assoc();
    $table_name = $row_table['table_name'];
    //echo "<h2>Table name for $subject: $table_name</h2>";

    // Proceed with the rest of the code using $table_name
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Format dates for SQL query
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

                    $i=0;
            while ($row = $result->fetch_assoc()) {
                $rollno = $row['rollno'];
                $name = $row['name'];
                $total_attended = $row['total_attended'];
                if($i==0)
                echo"<h1>Total periods : $total_attended</h1>";
                $i++;
                // Fetch total periods attended sum
                $tquery = "SELECT SUM(total_periods) AS total_periods_sum FROM total_periods_tracker WHERE date BETWEEN '$formatted_start_date' AND '$formatted_end_date'";
                $total_periods_result = $conn->query($tquery);
                $total_periods_row = $total_periods_result->fetch_assoc();
                $total_periods_sum = $total_periods_row['total_periods_sum'];

                // Calculate attendance percentage
                $attendance_percentage = ($total_attended / $total_periods_sum) * 100;

                // Calculate rotation angle for the fill
                $rotation_angle = $attendance_percentage * 3.6;

                echo "<tr>
                        <td>$rollno</td>
                        <td>$name</td>
                        <td>$total_attended</td>
                        <td>
                            <div class='progress-circle'>
                                <div class='progress-circle-fill' style='transform: rotate($rotation_angle deg)'></div>
                            </div>
                            <div class='percentage-text'>$attendance_percentage%</div>
                        </td>
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

</body>
</html>
