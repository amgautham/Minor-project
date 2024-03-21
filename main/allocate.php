<?php
session_start();

// Check if the user is logged in
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
<title>Open Elective Allocation</title>
<style>
    /* lnba */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff; /* White background */
        color: #333; /* Text color */
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #d000ff; /* Title color */
        margin-top: 50px;
    }

    form {
        max-width: 800px;
        width: 80%; /* Adjusted width */
        margin: 20px auto;
        background-color: #f9f9f9; /* Light gray background */
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
    }

    label {
        display: block;
        margin-bottom: 20px;
        color: #333; /* Label color */
    }

    select {
        width: calc(100% - 2px);
        padding: 10px;
        margin-bottom: 30px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        color: #333;
        appearance: none; /* Remove default dropdown arrow */
        outline: none;
        background-color: transparent; /* Transparent background */
        box-shadow: 0 0 20px rgba(208, 0, 255, 0.5); /* Glowing effect */
        transition: box-shadow 0.3s ease; /* Smooth transition */
    }

    select:hover,
    select:focus {
        box-shadow: 0 0 40px rgba(208, 0, 255, 0.8); /* Enhanced glowing effect on hover/focus */
    }

    select::-ms-expand {
        display: none; /* Hide arrow in IE & Edge */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        border-radius: 10px; /* Rounded corners */
        overflow: hidden; /* Hide overflow for rounded corners */
    }

    th, td {
        border: 1px solid #ddd; /* Border color */
        padding: 12px;
        text-align: left;
        color: #333;
    }

    th {
        background-color: #d000ff; /* Header background color */
        color: #fff;
    }

    button {
        padding: 12px 24px;
        background-color: #d000ff; /* Button background color */
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease; /* Smooth transition */
    }

    button:hover {
        background-color: #9500b3; /* Button hover color */
    }

</style>
</head>
<body>

<?php
include('db.php');

// Fetching unique branches
$sql_branches = "SELECT DISTINCT branch FROM students ORDER BY branch ASC";
$result_branches = $conn->query($sql_branches);

echo "<h1>Open Elective Allocation</h1>";
if (isset($_SESSION['success_message'])) {
    echo "<center><STRONG style='color: green; text-align: center;'>".$_SESSION['success_message']."</STRONG></center>";
    // Unset the session variable to remove the message after displaying it
    unset($_SESSION['success_message']);
}

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
echo "<button type='submit'>Filter</button>";

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
    echo "<button type='submit'>Update Subjects</button>";
    echo "</form>";
} else {
    echo "<p>No results found.</p>";
}

$conn->close();
?>
<center>

    <button  onclick="window.location.href = '../temp/menu.php';">Back to Menu</button>
</center>

</body>
</html>
