<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: /Minor-project/login/logsign.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        /* Form styles */
        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="date"] {
            margin: 5px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
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
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%);
            transform-origin: center;
            transform: rotate(0deg);
            transition: transform 0.5s ease-in-out; /* Add smooth transition */
        }

        .percentage-text {
            text-align: center;
            margin-top: 5px;
            font-size: 14px;
            color: #666;
        }

        /* Additional styles */
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        form label {
            margin-right: 10px;
            font-weight: bold;
        }

        form input[type="submit"] {
            margin-left: 10px;
        }
        .menu-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .menu-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Attendance Report</h1>

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
//session_start();

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
                $attendance_percentage = 0;
$rotation_angle = 0;

if ($total_periods_sum != 0) {
    $attendance_percentage = ($total_attended / $total_periods_sum) * 100;
    $rotation_angle = $attendance_percentage * 3.6;
}

echo "<tr>
        <td>$rollno</td>
        <td>$name</td>
        <td>$total_attended</td>
        <td>
           
            <div class='percentage-text'>" . number_format($attendance_percentage, 2) . "%</div>
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

if ($_SESSION['user_type'] == 'admin') {
    echo '<button class="menu-button" onclick="window.location.href = \'../temp/menu.php\';">Back to Menu</button>';
} else {
    echo '<button class="menu-button" onclick="window.location.href = \'ae_main.php\';">Back to Menu</button>';
}


?>

</body>
</html>
