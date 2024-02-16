<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a2e; /* Dark Navy Blue */
            color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #61dafb; /* Sky Blue */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
            color: #e8e8e8; /* Light Grey */
        }

        select,
        input[type="number"],
        input[type="date"],
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 2px solid #16213e; /* Dark Blue */
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #0f3460; /* Royal Blue */
            color: white; /* White */
        }

        button:hover {
            background-color: #45a049; /* Light Green */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: white;
        }

        th {
            background-color: #61dafb; /* Sky Blue */
        }

        .attendance-checkbox {
            margin: 0;
        }

        .check-all {
            margin-bottom: 5px;
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
                    $selected = ($_POST['subject'] == $row['subject']) ? 'selected' : '';
                    echo "<option value='" . $row['subject'] . "' $selected>" . $row['subject'] . "</option>";
                }
            } else {
                echo "<option value=''>No subjects available</option>";
            }
            ?>
        </select>
        <label for="periods">Number of Periods:</label>
        <input type="number" name="periods" id="periods" value="<?php echo isset($_POST['periods']) ? $_POST['periods'] : '1'; ?>" min="1">
        <label for="attendance_date">Attendance Date:</label>
        <input type="date" name="attendance_date" id="attendance_date" value="<?php echo isset($_POST['attendance_date']) ? $_POST['attendance_date'] : ''; ?>">
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
    // Select all checkboxes in the same column when clicking on any checkbox
    document.querySelectorAll('.check-all').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let period = this.dataset.period;
            let isChecked = this.checked;
            document.querySelectorAll('.attendance-checkbox.period-' + period).forEach(function(studentCheckbox) {
                studentCheckbox.checked = isChecked;
            });
        });
    });

    // Update the state of 'check-all' checkbox when clicking on any student checkbox
    document.querySelectorAll('.attendance-checkbox').forEach(function(studentCheckbox) {
        studentCheckbox.addEventListener('change', function() {
            let period = this.classList[1].split('-')[1];
            let isAllChecked = document.querySelectorAll('.attendance-checkbox.period-' + period + ':checked').length === document.querySelectorAll('.attendance-checkbox.period-' + period).length;
            document.querySelectorAll('.check-all[data-period="' + period + '"]').forEach(function(periodCheckbox) {
                periodCheckbox.checked = isAllChecked;
            });
        });
    });
</script>









</body>
</html>
