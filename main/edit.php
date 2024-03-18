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
    <title>Edit Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
include('db.php');
//session_start();

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
       
        // Proceed with the rest of the code using $table_name
    } else {
       
    }
}


if (isset($_POST['date'])) {
    $edit_date = $_POST['date'];
    // Fetch attendance records for the selected date
    $sql = "SELECT * FROM $table_name WHERE attendance_date = '$edit_date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
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
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<p>No attendance records found for $edit_date</p>";
        echo "</div>";
    }
}

// Handle form submission for editing attendance
if (isset($_POST['submit_edit_attendance'])) {
    $edit_date = $_POST['edit_date'];
    $periods_attended = $_POST['periods_attended'];
    foreach ($periods_attended as $student_id => $attended_periods) {
        $sql_update = "UPDATE $table_name SET periods_attended = '$attended_periods' WHERE id = '$student_id'";
        if ($conn->query($sql_update) !== TRUE) {
            echo "<div class='container'>";
            echo "<p>Error updating attendance: " . $conn->error . "</p>";
            echo "</div>";
        }
    }
    echo "<div class='container'>";
    echo "<p>Attendance data updated successfully.</p>";
    echo "</div>";
    if ($_SESSION['user_type'] == 'admin') {
        header("Location: /Minor-project/temp/menu.php");
    } else {
        header("Location: /Minor-project/main/ed.php");
    }
    
    
    exit;
}
?>

</body>
</html>
