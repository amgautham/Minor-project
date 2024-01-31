<?php
include('db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['elective'])) {
        $electives = $_POST['elective'];

        foreach ($electives as $rollno => $elective) {
            $sql = "UPDATE student_electives SET o_subject = '{$elective}' WHERE rollno = {$rollno}";
            $conn->query($sql);
        }
    }
}

// Construct SQL query based on branch filter
$sql = "SELECT * FROM student_electives";
if(isset($_GET['branchFilter']) && $_GET['branchFilter'] !== '') {
    $branchFilter = $_GET['branchFilter'];
    $sql .= " WHERE branch = '$branchFilter'";
}
$result = $conn->query($sql);
$subjects = ["Introduction to IoT", "Fundamentals of Web Technology", "Multimedia", "Cloud Computing"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Elective Allocation</title>
    <!-- Add your CSS styles here -->
</head>
<body>

<h1>Open Elective Allocation</h1>

<form id="filterForm" method="get">
    <label for="branchFilter">Filter by Branch:</label>
    <select name="branchFilter" id="branchFilter" onchange="this.form.submit()">
        <option value="">All Branches</option>
        <option value="CT">CT</option>
        <option value="EEE">EEE</option>
        <option value="CE">CE</option>
        <option value="ME">ME</option>
        <option value="EE">EE</option>
    </select>
</form>

<form id="electiveForm" method="post">
    <table border="1">
        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Branch</th>
            <th>Open Elective Subject</th>
        </tr>
        <?php
        // Display table data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['rollno']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['branch']}</td>";
            echo "<td>";
            echo "<select name='elective[{$row['rollno']}]'>";
            foreach ($subjects as $subject) {
                $selected = ($subject == $row['o_subject']) ? 'selected' : '';
                echo "<option value='{$subject}' {$selected}>{$subject}</option>";
            }
            echo "</select>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button type="submit">Submit</button>
</form>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
