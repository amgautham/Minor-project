<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: /Minor-project/login/logsign.php");
    exit();
}

// Continue with the secure page content
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Tracker</title>
<style>
  /* Define some colors */
:root {
  --bg-color: #f5f5f5; /* Light background color */
  --text-color: #333; /* Dark text color */
  --accent-color: #7F00FF; /* Violet accent color */
  --button-bg-color: #7F00FF; /* Violet button background color */
  --button-text-color: #fff; /* Button text color */
  --button-hover-bg-color: #39FF14; /* Button background color on hover */
}

/* Add some global styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  background-color: var(--bg-color); /* Use light background color */
  font-family: Arial, sans-serif;
  line-height: 1.6;
  color: var(--text-color);
  margin: 0;
  padding: 0;
}

/* Container for the entire page */
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

/* Set the title style */
h1 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 36px;
  color: #333;
}

/* Set the form style */
form {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Set the form label style */
form label {
  display: block;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: bold;
}

/* Set the form input style */
form input[type="date"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

/* Set the form button style */
form button {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: var(--button-bg-color);
  color: var(--button-text-color);
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* Button hover effect */
form button:hover {
  background-color: var(--button-hover-bg-color);
}

/* Set the table style */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

/* Set the table header style */
th {
  background-color: var(--accent-color);
  color: #fff;
  padding: 12px;
  text-align: left;
}

/* Set the table data style */
td {
  border: 1px solid #ccc;
  padding: 12px;
}

/* Letter-by-letter animation */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.animated-heading {
  display: inline-block;
}

.animated-heading span {
  display: inline-block;
  opacity: 0;
  animation: fadeIn 0.5s forwards;
}

.animated-heading-attendance span:nth-child(1) { animation-delay: 0.1s; }
.animated-heading-attendance span:nth-child(2) { animation-delay: 0.2s; }
.animated-heading-attendance span:nth-child(3) { animation-delay: 0.3s; }
.animated-heading-attendance span:nth-child(4) { animation-delay: 0.4s; }
.animated-heading-attendance span:nth-child(5) { animation-delay: 0.5s; }
.animated-heading-attendance span:nth-child(6) { animation-delay: 0.6s; }
.animated-heading-attendance span:nth-child(7) { animation-delay: 0.7s; }
.animated-heading-attendance span:nth-child(8) { animation-delay: 0.8s; }
.animated-heading-attendance span:nth-child(9) { animation-delay: 0.9s; }
.animated-heading-attendance span:nth-child(10) { animation-delay: 1s; }
/* Add more spans as needed for longer words */

.animated-heading-report span:nth-child(1) { animation-delay: 1.1s; }
.animated-heading-report span:nth-child(2) { animation-delay: 1.2s; }
.animated-heading-report span:nth-child(3) { animation-delay: 1.3s; }
.animated-heading-report span:nth-child(4) { animation-delay: 1.4s; }
.animated-heading-report span:nth-child(5) { animation-delay: 1.5s; }
.animated-heading-report span:nth-child(6) { animation-delay: 1.6s; }
.animated-heading-report span:nth-child(7) { animation-delay: 1.7s; }
.animated-heading-report span:nth-child(8) { animation-delay: 1.8s; }
.animated-heading-report span:nth-child(9) { animation-delay: 1.9s; }
.animated-heading-report span:nth-child(10) { animation-delay: 2s; }
/* Add more spans as needed for longer words */
</style>
</head>
<body>
<div class="container">
    <h1 class="animated-heading">
      <span class="animated-heading-attendance">A</span><span class="animated-heading-attendance">t</span><span class="animated-heading-attendance">t</span><span class="animated-heading-attendance">e</span><span class="animated-heading-attendance">n</span><span class="animated-heading-attendance">d</span><span class="animated-heading-attendance">a</span><span class="animated-heading-attendance">n</span><span class="animated-heading-attendance">c</span><span class="animated-heading-attendance">e</span>
      <span></span>
      <span class="animated-heading-report">R</span><span class="animated-heading-report">e</span><span class="animated-heading-report">p</span><span class="animated-heading-report">o</span><span class="animated-heading-report">r</span><span class="animated-heading-report">t</span>
    </h1>

    <!-- Date range filter -->
    <form id="date-range-form">
        <label for="start-date">Start Date</label>
        <input type="date" id="start-date" name="start-date" required>
        <label for="end-date">End Date</label>
        <input type="date" id="end-date" name="end-date" required>
        <button type="submit">Apply Filter</button>
    </form>

    <table id="previewTable">
        <thead>
            <tr>
                <th>Roll Number</th>
                <th>Name</th>
                <th>Date</th>
                <th>Attendance Percentage</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Include your database connection file
include 'db.php';
$csub = $_SESSION['subject'];

// Prepare the SQL statement
$ctname_query = "SELECT table_name FROM subjects WHERE subject = ?";
$stmt = $conn->prepare($ctname_query);

// Bind the parameter and execute the statement
$stmt->bind_param("s", $csub);
$stmt->execute();

// Get the result
$resultt = $stmt->get_result();

// Check if there are any rows returned
if ($resultt->num_rows > 0) {
    // Fetch the row
    $row = $resultt->fetch_assoc();
    // Get the table_name
    $ctname = $row['table_name'];
    
    
    //echo $ctname; // or do whatever you want with $ctname
} else {
   
    echo "No table found for the specified subject.";
}

// Close the statement
$stmt->close();

$sql = "SELECT * FROM $ctname";
$result = mysqli_query($conn, $sql);




// Fetch total periods from the total_periods_tracker table
$totalSql = "SELECT total_periods FROM total_periods_tracker WHERE subject = ?";
$stmt = $conn->prepare($totalSql);

// Bind the parameter and execute the statement
$stmt->bind_param("s", $csub);
$stmt->execute();

// Get the result
$resultttt = $stmt->get_result();

// Check if there are any rows returned
if ($resultttt->num_rows > 0) {
    // Fetch the row
    $row = $resultttt->fetch_assoc();
    // Get the total_periods
    $total_periods = $row['total_periods'];
    
    // Now $total_periods contains the total_periods for the specified subject
    //echo $total_periods; // or do whatever you want with $total_periods
} else {
    // No rows found, handle the case accordingly
    echo "No record found for the specified subject.";
}

// Close the statement
$stmt->close();




// Get start and end dates from the form
$fdate = isset($_POST["start-date"]) ? $_POST["start-date"] : '';
$edate = isset($_POST["end-date"]) ? $_POST["end-date"] : '';

// Get the subject from session
$csub = $_SESSION['subject'];

// Prepare the SQL statement to fetch the table name for the subject
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
    $sql .= " WHERE attendance_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fdate, $edate);
} elseif (!empty($fdate)) {
    // Only start date is provided
    $sql .= " WHERE attendance_date >= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fdate);
} elseif (!empty($edate)) {
    // Only end date is provided
    $sql .= " WHERE attendance_date <= ?";
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
            $attendancePercentage = ($periodsAttended / $total_periods) * 100;
        } else {
            $attendancePercentage = "N/A";
        }

        // Display the result in a table row
        echo "<tr><td>$rollNumber</td><td>$name</td><td>$datee</td><td>$attendancePercentage%</td></tr>";
    }
} else {
    // No records found
    echo "<tr><td colspan='4'>No records found</td></tr>";
}

// Close the statement
$stmt->close();
// Close database connection
mysqli_close($conn);
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
