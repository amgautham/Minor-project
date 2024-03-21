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
    <title>Mark Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff; /* White background */
            margin: 0;
            padding: 0;
            color: #333; /* Dark text color */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff; /* White background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #d000ff; /* Purple header color */
            margin-top: 0;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333; /* Dark text color */
        }

        input[type="number"],
        input[type="date"],
        button {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        button {
            background-color: #d000ff; /* Purple button color */
            color: white; /* White text color */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #9500b3; /* Darker purple on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #d000ff; /* Purple header color */
            color: #fff; /* White text color */
        }

        .attendance-checkbox {
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mark Attendance</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="periods" style="display: inline-block; width: 150px;">Number of Periods:</label>
    <input type="number" name="periods" id="periods" value="<?php echo isset($_POST['periods']) ? $_POST['periods'] : 1; ?>" min="1" style="width: 100px;"><br><br>
    <label for="attendance_date" style="display: inline-block; width: 150px;">Attendance Date:</label>
    <input type="date" name="attendance_date" id="attendance_date" value="<?php echo isset($_POST['attendance_date']) ? $_POST['attendance_date'] : date('Y-m-d'); ?>" style="width: 150px;">
    <button type="submit" style="padding: 8px 16px;">Filter</button>
</form>


<?php
include('db.php');
//session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['subject'])) {
    header("Location: /login.html");
    exit;
}

$username = $_SESSION['username'];
$subject = $_SESSION['subject'];

// Fetch table name for the selected subject from the subjects table
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
        //echo "Table name for $subject: $table_name";
        // Proceed with the rest of the code using $table_name
    } else {
        echo "Table name not found for $subject";
    }
}

function updateTotalPeriods($conn, $periods, $subject, $attendance_date) {
    $sql_update_total_periods = "INSERT INTO total_periods_tracker (subject, total_periods, date) VALUES ('$subject', '$periods', '$attendance_date')";
    if ($conn->query($sql_update_total_periods) !== TRUE) {
        echo "Error updating total periods: " . $conn->error;
    }
} 

$periods = isset($_POST['periods']) ? $_POST['periods'] : 1;
$attendance_date = isset($_POST['attendance_date']) ? $_POST['attendance_date'] : date('Y-m-d');

// Check if attendance has already been marked for this date
$sql_check_attendance = "SELECT * FROM $table_name WHERE attendance_date = '$attendance_date' LIMIT 1";
$result_check_attendance = $conn->query($sql_check_attendance);

if ($result_check_attendance && $result_check_attendance->num_rows > 0) {
    echo "Attendance has already been marked for $attendance_date.";
    // You can handle this case as per your requirement, for example, redirecting the user or showing a message.
} else {
    // Fetch students for the selected subject
    $sql = "SELECT * FROM students WHERE open_elective = '$subject'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Students of $subject:</h2>";
        echo "<form method='post' action=''>"; // action to current page
        echo "<input type='hidden' name='subject' value='$subject'>";
        echo "<input type='hidden' name='attendance_date' value='$attendance_date'>";
        echo "<input type='hidden' name='periods' value='$periods'>";
        echo "<table>";
        echo "<tr><th>Roll No</th><th>Name</th><th>Branch</th>";
        // Adding checkboxes for each period
        for ($i = 1; $i <= $periods; $i++) {
            echo "<th>Period $i <input type='checkbox' class='check-period' data-period='$i'></th>";
        }
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['rollno'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['branch'] . "</td>";
            // Adding checkboxes for each period attendance
            for ($i = 1; $i <= $periods; $i++) {
                echo "<td><input type='checkbox' name='attendance[" . $row['id'] . "][]' value='$i' class='attendance-checkbox period-$i'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<button type='submit' name='submit_attendance'>Submit Attendance</button>"; // Added name attribute
        echo "</form>";
    } else {
        echo "No students found for $subject";
    }

    // Insert attendance data into the database
    if (isset($_POST['submit_attendance'])) {
        // Check if attendance data is present in $_POST and is an array
        if (isset($_POST['attendance']) && is_array($_POST['attendance'])) {
            foreach ($_POST['attendance'] as $student_id => $attended_periods) {
                $periods_attended = count($attended_periods);
                $sql = "SELECT rollno, name FROM students WHERE id = '$student_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $rollno = $row['rollno'];
                    $name = $row['name'];
                    $sql_insert = "INSERT INTO $table_name (rollno, name, periods_attended, attendance_date) VALUES ('$rollno', '$name', '$periods_attended', '$attendance_date')";
                    if ($conn->query($sql_insert) !== TRUE) {
                        echo "Error: " . $sql_insert . "<br>" . $conn->error;
                    }
                } else {
                    echo "Student details not found for ID: $student_id";
                }
            }
            echo "Attendance data inserted successfully.";
            // Update total periods
            updateTotalPeriods($conn, $periods, $subject, $attendance_date);
        } else {
            // Handle case where no attendance data is present
            echo "No attendance data found.";
        }
    }

   

    if ($_SESSION['user_type'] == 'admin') {
        echo '<div class="container"><button class="menu-button" onclick="window.location.href = \'../admin/menu.php\';">Back to Menu</button></div>';
    } else {
        echo '<div class="container"><button class="menu-button" onclick="window.location.href = \'ae_main.php\';">Back to Menu</button></div>';
    }
}
?>


</div>

<script>
    // Toggle checkboxes for a specific period
    document.querySelectorAll('.check-period').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let period = this.dataset.period;
            let checkboxes = document.querySelectorAll('.attendance-checkbox.period-' + period);
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    });
</script>

</body>
</html>
