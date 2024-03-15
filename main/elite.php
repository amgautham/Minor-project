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
    <form id="date-range-form" method="POST" action="elite.php">
        <label for="start-date">Start Date</label>
        <input type="date" id="start-date" name="start-date" >
        <label for="end-date">End Date</label>
        <input type="date" id="end-date" name="end-date" >
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
              include 'db.php';

              $current_subject = $_SESSION['subject'];
              
              
                $startDate = $_POST["start-date"];
                $endDate = $_POST["end-date"];
            
                // Now you can use $startDate and $endDate in your PHP code
            
              // Query to get the table name
              $user_table_query = "SELECT table_name FROM subjects WHERE subject = '$current_subject'";
              $user_table_result = $conn->query($user_table_query);
              
              // Check if table name query was successful
              if ($user_table_result) {
                  $row = $user_table_result->fetch_assoc();
                  $user_table = $row['table_name'];
              
                  // Query to get total attendance
                  $total_attendance_query = "SELECT total_periods FROM total_periods_tracker WHERE subject = '$current_subject'";
                  $total_attendance_result = $conn->query($total_attendance_query);
              
                  // Check if total attendance query was successful
                  if ($total_attendance_result) {
                      // Fetch total attendance
                      $total_attendance_row = $total_attendance_result->fetch_assoc();
                      $total_attendance = $total_attendance_row['total_periods'];
              
                      // Query to get attendance records from the dynamic table
                      $attendance_query = "SELECT * FROM $user_table WHERE attendance_date BETWEEN '$startDate' AND '$endDate";
                      $attendance_result = $conn->query($attendance_query);
              
                      // Check if attendance query was successful
                      if ($attendance_result) 
                      {
                          if ($attendance_result->num_rows > 0) 
                          {
                              while ($row = $attendance_result->fetch_assoc()) 
                              {
                                $rollNumber = $row["rollno"];
                                $name = $row["name"];
                                $datee = $row["attendance_date"];
                                $periodsAttended = $row["periods_attended"];
                                if (!empty($total_periods)) 
                                {
                                  $attendancePercentage = round(($periodsAttended / $total_periods) * 100);
                                } 
                                else 
                                {
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
                          }
                          else
                          {
                              echo "No records found in the table.";
                          }
                      }
                      else
                      {
                          echo "Error fetching attendance records: " . $conn->error;
                      }
                  }
                  else
                  {
                      echo "Error fetching total attendance: " . $conn->error;
                  }
              }
              else 
              {
                  echo "Error fetching table name: " . $conn->error;
              }
            
              $conn->close();
              ?>

        </tbody>
    </table>
</div>

<script>
  // JavaScript code for handling the date range filter functionality
  document.getElementById('date-range-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    
  });
</script>

</body>
</html>
