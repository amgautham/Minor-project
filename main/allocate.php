<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Open Elective Allocation</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>

<?php
include('db.php');

// Fetching unique branches
$sql_branches = "SELECT DISTINCT branch FROM students ORDER BY branch ASC";
$result_branches = $conn->query($sql_branches);

echo "<form action='' method='post'>";
echo "<label for='branch'>Select Branch:</label>";
echo "<select name='branch' id='branch'>";
echo "<option value=''>All Branches</option>";
if ($result_branches->num_rows > 0) {
    while($row_branch = $result_branches->fetch_assoc()) {
        echo "<option value='".$row_branch["branch"]."'>".$row_branch["branch"]."</option>";
    }
}
echo "</select>";
echo "<input type='submit' value='Filter'>";
echo "</form>";

// Fetching students
$filter_branch = isset($_POST['branch']) ? $_POST['branch'] : '';
$sql_students = "SELECT * FROM students";
if (!empty($filter_branch)) {
    $sql_students .= " WHERE branch = '$filter_branch'";
}
$sql_students .= " ORDER BY rollno ASC";
$result_students = $conn->query($sql_students);

if ($result_students->num_rows > 0) {
    echo "<form action='update_subjects.php' method='post'>";
    echo "<table><tr><th>Roll No</th><th>Name</th><th>Branch</th><th>Open Elective Subject Opted</th></tr>";
    while($row = $result_students->fetch_assoc()) {
        echo "<tr><td>".$row["rollno"]."</td><td>".$row["name"]."</td><td>".$row["branch"]."</td><td>";
        echo "<select name='subject_".$row["rollno"]."'>";
        
        // Query to get subjects based on branch excluding subjects from the student's branch
        $branch = $row["branch"];
        $sql_subjects = "SELECT * FROM subjects WHERE branch <> '$branch'";
        $result_subjects = $conn->query($sql_subjects);

        if ($result_subjects->num_rows > 0) {
            while($subject_row = $result_subjects->fetch_assoc()) {
                echo "<option value='".$subject_row["subject"]."'>".$subject_row["subject"]."</option>";
            }
        } else {
            echo "<option value=''>No subjects available</option>";
        }
        
        echo "</select></td></tr>";
    }
    echo "</table>";
    echo "<input type='submit' value='Update Subjects'>";
    echo "</form>";
} else {
    echo "0 results";
}

$conn->close();
?>
</body>
</html>