<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Open Elective Allocation</title>
<style>


        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding:px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            padding:12px ;
            color: white;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
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