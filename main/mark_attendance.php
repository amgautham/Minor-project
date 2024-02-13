<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mark Attendance</h1>

    <form id="filterForm" method="post">
        <select id="subject" name="subject">
            <?php
            include('db.php');

            // Fetch unique values from the subjects table
            $sql = "SELECT DISTINCT subject FROM subjects";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['subject'] . "'>" . $row['subject'] . "</option>";
                }
            } else {
                echo "<option value=''>No subjects available</option>";
            }
            ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php
    // Fetch and display students dynamically
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        $sql = "SELECT * FROM students WHERE open_elective = '$subject'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table id='attendanceTable'>";
            echo "<tr><th>Select All</th><th>Roll No</th><th>Name</th><th>Branch</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='attendance[]' value='" . $row['rollno'] . "'></td>";
                echo "<td>" . $row['rollno'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No students found for the selected subject.";
        }
    }
    ?>

    <button type="button" id="submitAttendance">Submit Attendance</button>
</div>

<script>
    // Function to handle "Select All" checkbox
    document.getElementById('select-all').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select-all').checked;
        });
    });

    // Submit form for marking attendance
    document.getElementById('submitAttendance').addEventListener('click', function() {
        // Your code to handle form submission goes here
    });
</script>
<script>
    // Submit form for marking attendance using AJAX
    document.getElementById('submitAttendance').addEventListener('click', function() {
        var attendanceData = {}; // Object to store attendance data

        // Iterate through checkboxes and collect attendance data
        document.querySelectorAll('input[name="attendance[]"]').forEach(function(checkbox) {
            attendanceData[checkbox.value] = checkbox.checked ? 1 : 0; // Store 1 for checked, 0 for unchecked
        });

        // Send AJAX request to process_attendance.php
        $.ajax({
            type: 'POST',
            url: 'process_attendance.php',
            data: { attendance: attendanceData },
            success: function(response) {
                alert(response); // Show response message from the server
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error message to console
            }
        });
    });
</script>


</body>
</html>
