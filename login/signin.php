<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    $username = $_POST['username']; 
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password']))
         {   
            
            $sub = $row['subject'];

            $_SESSION['username'] = $username; 
            $_SESSION['subject'] = $sub;
           

            header("Location: /Minor-project/main/menu.php");
            exit;
        } else 
        {
            echo "Incorrect password!";
        }
    } 
    else
     {
        echo "User not found!";
    }
}
?>
