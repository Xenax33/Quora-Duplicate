<?php

if(isset($_POST["signup-submit"]))
{
    $uname = $_POST["Username"];
    $newemail = $_POST["email"];
    $Bio = $_POST["bio"];
    $pwd = $_POST["password1"];

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = 'qoura';

    //Creating Database connection
    $conn  = mysqli_connect($dbhost,$dbUsername,$dbpassword,$dbname);
    if (!$conn)
    {
        die('Connection Failed: '.mysqli_connect_error());
    }

    $sql = "SELECT * FROM userprofile WHERE email = '$newemail'";
    if($result = mysqli_query($conn, $sql))
    { 
        if(mysqli_num_rows($result) == 0)
        { 
            $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO userprofile (Username, email, password, Bio, Active) VALUES("'.$uname.'","'.$newemail.'","'.$hashedpwd.'","'.$Bio.'", 1)';
            mysqli_query($conn, $sql);
            header("location:index.php");
        }
    
    }
}