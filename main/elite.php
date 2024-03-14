<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Tracker</title>
<style>
/* Global styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

/* Attendance circle styles */


/* Attendance percentage styles */


/* Date range filter styles */
#date-range-form {
  margin-bottom: 20px;
}

#date-range-form label {
  margin-right: 10px;
}

#date-range-form input[type="date"] {
  padding: 6px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

#date-range-form button {
  padding: 8px 12px;
  background-color: #7F00FF;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#date-range-form button:hover {
  background-color: #5F00D1;
}

/* Progress ring styles */
.battery-container {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #f0f0f0;
    position: relative;
    margin: 20px auto;
    overflow: hidden;
  }

  .battery-level {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #0074D9;
    height: 0;
    transition: height 0.5s ease-in-out;
  }

  .percentage-text {
    text-align: center;
    margin-top: 10px;
    font-size: 18px;
    color: #333;
  }
</style>
</head>
<body>
<div class="container">
    <h1>Attendance Tracker</h1>
  

    <!-- Date range filter -->
    <form id="date-range-form">
        <label for="start-date">Start Date</label>
        <input type="date" id="start-date" name="start-date" required>
        <label for="end-date">End Date</label>
        <input type="date" id="end-date" name="end-date" required>
        <button type="submit">Apply Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Roll Number</th>
                <th>Name</th>
                <th>Date</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
        <?php
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['username'])) {
            // Redirect to the login page
            header("Location: /Minor-project/login/logsign.php");
            exit();
        }

        // Include your database connection file
        include 'db.php';

        // Get the subject from session
        $csub = $_SESSION['subject'];

        // Fetch total periods from the total_periods_tracker table
        $totalSql = "SELECT total_periods FROM total_periods_tracker WHERE subject = ?";
        $stmt = $conn->prepare($totalSql);
        $stmt->bind_param("s", $csub);
        $stmt->execute();
        $resultttt = $stmt->get_result();

        // Check if there are any rows returned
        if ($resultttt->num_rows > 0) {
            // Fetch the row
            $row = $resultttt->fetch_assoc();
            // Get the total_periods
            $total_periods = $row['total_periods'];
        } else {
            // No rows found, handle the case accordingly
            echo "No record found for the specified subject.";
            exit;
        }

        // Close the statement
        $stmt->close();

        // Get start and end dates from the form
        $fdate = isset($_POST["start-date"]) ? $_POST["start-date"] : '';
        $edate = isset($_POST["end-date"]) ? $_POST["end-date"] : '';

        // Prepare the SQL statement to fetch attendance records
        $ctname_query = "SELECT table_name FROM subjects WHERE subject = ?";
        $stmt = $conn->prepare($ctname_query);
        $stmt->bind_param("s", $csub);
        $stmt->execute();
        $resultt = $stmt->get_result();

        // Check if there are any rows returned
        if ($resultt->num_rows > 0) {
            // Fetch the row
            $row = $resultt->fetch_assoc();
            // Get the table_name
            $ctname = $row['table_name'];
        } else {
            echo "No table found for the specified subject.";
            exit; // Exit script if no table found
        }

        // Close the statement
        $stmt->close();

        // Prepare the SQL statement to fetch attendance records from the specified table
        $sql = "SELECT * FROM $ctname";

        // Modify SQL query based on provided dates
        if (!empty($fdate) && !empty($edate)) {
            // Both start and end dates are provided
            $sql .= " WHERE a.attendance_date BETWEEN ? AND ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $fdate, $edate);
        } elseif (!empty($fdate)) {
            // Only start date is provided
            $sql .= " WHERE a.attendance_date >= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $fdate);
        } elseif (!empty($edate)) {
            // Only end date is provided
            $sql .= " WHERE a.attendance_date <= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $edate);
        } else {
            // No dates provided, fetch all records
            $stmt = $conn->prepare($sql);
        }

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Process and display attendance records
            while ($row = $result->fetch_assoc()) {
                // Process and display each row of attendance data
                $rollNumber = $row["rollno"];
                $name = $row["name"];
                $datee = $row["attendance_date"];
                $periodsAttended = $row["periods_attended"];

                // Calculate attendance percentage if total periods available
                if (!empty($total_periods)) {
                    $attendancePercentage = round(($periodsAttended / $total_periods) * 100);
                } else {
                    $attendancePercentage = "N/A";
                }
        ?>
                <tr>
                <td><?php echo $rollNumber; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $datee; ?></td>
            <td>
            <div class="battery-container">
    <div class="battery-level" style="height: <?php echo $attendancePercentage; ?>%;"></div>
  </div>
  <p class="percentage-text"><?php echo $attendancePercentage; ?>%</p>
              </td>

              </tr>
        <?php
            }
        } else {
            // No records found
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
  // JavaScript code for handling the date range filter functionality
  document.getElementById('date-range-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    //var startDate = document.getElementById('start-date').value;
    //var endDate = document.getElementById('end-date').value;

    // Perform filtering based on the selected date range
    // This is where you would implement your filtering logic
   // console.log('Start Date:', startDate);
    //console.log('End Date:', endDate);
  });
</script>

</body>
</html>
