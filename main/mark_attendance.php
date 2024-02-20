<?php
include('db.php');
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['subject']))
{   
    header("Location: /login.html");
    exit;
}

$username = $_SESSION['username'];
$subject = $_SESSION['subject'];


$sql = "SELECT * FROM students WHERE open_elective = '$subject'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{ 
    echo "<h2>Students of $subject:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) 
    {
        echo "<li>Name: " . $row['name'] . ", Roll No: " . $row['roll_no'] . "</li>";
    }
    echo "</ul>";
} 
else 
{
    echo "No students found for $subject";
}
?>
