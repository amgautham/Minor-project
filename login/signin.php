<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) 
        {   
            $sub="SELECT subject FROM users WHERE username=$username";
            $_SESSION['username'] = $_POST['username']; 
            $_SESSION['password']=$_POST['password'];
            $_SESSION['subject']=$sub;        
            header("Location: /Minor-project/main/menu.php");
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
