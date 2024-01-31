<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Attendance Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Monthly Attendance Report</h1>

<form method="post" action="">
    <label for="month">Month:</label>
    <select name="month" id="month">
        <?php
        for ($m = 1; $m <= 12; $m++) {
            $monthName = date("F", mktime(0, 0, 0, $m, 1));
            echo "<option value='$m'>$monthName</option>";
        }
        ?>
    </select>
    <br><br>
    <label for="year">Year:</label>
    <input type="text" id="year" name="year" required>
    <br><br>
    <button type="submit">Generate Report</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Include your database connection file
    include('db.php');

    // Query to retrieve monthly attendance data
    $sql = "SELECT 
                rollno, 
                COUNT(*) AS total_days, 
                SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_days,
                ROUND((SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) AS attendance_percentage
            FROM 
                attendance
            WHERE 
                YEAR(attendance_date) = $year AND MONTH(attendance_date) = $month
            GROUP BY 
                rollno";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Attendance Report for " . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . "</h2>";
        echo "<table>";
        echo "<tr><th>Roll No</th><th>Total Days</th><th>Present Days</th><th>Attendance Percentage</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["rollno"] . "</td>";
            echo "<td>" . $row["total_days"] . "</td>";
            echo "<td>" . $row["present_days"] . "</td>";
            echo "<td>" . $row["attendance_percentage"] . "%</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No attendance data found for the selected month and year.</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

</body>
</html>
