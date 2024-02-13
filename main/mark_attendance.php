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

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject">Filter by Subject:</label>
        <select name="subject" id="subject">
            <?php
            include('db.php'); // Include your database connection file

            // Fetch unique subjects from the subjects table
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
        <label for="periods">Number of Periods:</label>
        <input type="number" name="periods" id="periods" value="1" min="1">
        <label for="attendance_date">Attendance Date:</label>
        <input type="date" name="attendance_date" id="attendance_date">
        <button type="submit">Filter</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subject = $_POST['subject'];
        $periods = $_POST['periods'];
        $attendance_date = $_POST['attendance_date'];

        // Fetch students for the selected subject
        $sql = "SELECT * FROM students WHERE open_elective = '$subject'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<form method='post' action='update_attendance.php'>";
            echo "<table>";
            echo "<tr><th>Roll No</th><th>Name</th><th>Branch</th>";
            for ($i = 1; $i <= $periods; $i++) {
                echo "<th>Period $i <input type='checkbox' class='check-all' data-period='$i'></th>";
            }
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['rollno'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";
                for ($i = 1; $i <= $periods; $i++) {
                    echo "<td><input type='checkbox' name='attendance[" . $row['id'] . "][]' value='$i' class='attendance-checkbox period-$i'></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<button type='submit'>Submit Attendance</button>";
            echo "</form>";
        } else {
            echo "No students found for the selected subject.";
        }
    }
    ?>

</div>

<script>
    // Select all checkboxes for a specific period
    document.querySelectorAll('.check-all').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let period = this.dataset.period;
            document.querySelectorAll('.attendance-checkbox.period-' + period).forEach(function(checkbox) {
                checkbox.checked = this.checked;
            });
        });
    });
</script>

</body>
</html>
