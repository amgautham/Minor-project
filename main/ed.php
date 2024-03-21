<?php
session_start(); // Start the session

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
    <title>Attendance Dates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #d000ff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #d000ff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-form {
            display: inline-block;
        }

        .action-form button {
            padding: 8px 16px;
            margin-right: 5px;
            background-color: #d000ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-form button:hover {
            background-color: #d000ff;
        }
        .container button {
            padding: 10px 20px;
            background-color: #d000ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #d000ff;
        }
    </style>
</head>
<body>

<?php
include('db.php');
//session_start();

// Query to fetch unique dates for the subject
$subject = $_SESSION['subject'];
$sql = "SELECT DISTINCT date FROM total_periods_tracker WHERE subject = '$subject'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    echo "<div class='container'>";
    echo "<h2>Attendance Dates</h2>";
    echo "<table>";
    echo "<tr><th>Attendance Date</th><th>Actions</th></tr>";
    // Loop through each row
    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        echo "<tr>";
        echo "<td>$date</td>";
        // Add buttons for editing and deleting
        echo "<td>";
        echo "<form action='edit.php' method='post' class='action-form'>";
        echo "<input type='hidden' name='date' value='$date'>";
        echo "<button type='submit'>Edit</button>";
        echo "</form>";
        echo "<form action='delete.php' method='post' class='action-form'>";
        echo "<input type='hidden' name='date' value='$date'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "Error: " . mysqli_error($connection);
}

if ($_SESSION['user_type'] == 'admin') {
    echo '<div class="container"><button class="menu-button" onclick="window.location.href = \'../temp/menu.php\';">Back to Menu</button></div>';
} else {
    echo '<div class="container"><button class="menu-button" onclick="window.location.href = \'ae_main.php\';">Back to Menu</button></div>';
}


?>

</body>
</html>
