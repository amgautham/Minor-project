<?php

include('db.php');
session_start();
// Query to fetch unique dates for the subject
$subject = $_SESSION['subject'];
$sql = "SELECT DISTINCT date FROM total_periods_tracker WHERE subject = '$subject'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    echo "<table border='1'>";
    echo "<tr><th>Attendance Date</th><th>Actions</th></tr>";
    // Loop through each row
    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        echo "<tr>";
        echo "<td>$date</td>";
        // Add buttons for editing and deleting
        echo "<td>";
        echo "<form action='edit.php' method='post'>";
        echo "<input type='hidden' name='date' value='$date'>";
        echo "<input type='submit' value='Edit'>";
        echo "</form>";
        echo "<form action='delete.php' method='post'>";
        echo "<input type='hidden' name='date' value='$date'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($connection);
}
?>
