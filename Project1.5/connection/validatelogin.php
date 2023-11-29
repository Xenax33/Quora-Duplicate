<?php

if (isset($_POST["log-submit"])) {
    $username = $_POST["Username"];
    $pwd = $_POST["password"];

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = 'qoura';

    //Creating Database connection
    $conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
    if (!$conn) {
        die('Connection Failed: ' . mysqli_connect_error());
    }

    $sql = "SELECT * FROM userprofile WHERE Username = '$username';";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) == 0) {
            header("location:../pages/index.php?error=UseridDoesn'tExist");
            echo "User doesnot Exist!";
        } else {
            $row = mysqli_fetch_array($result);
            $pwdhashed = $row["password"];
            $checkpass = password_verify($pwd, $pwdhashed);
            if ($checkpass == false) {
                header("location:../pages/index.php?error=WrongLogin");
                echo "Password Entered doesnot Match";
            } 
            else if ($checkpass === true) 
            {
                session_start();

                $sql2 = "SELECT UserId FROM userprofile WHERE Username = '$username';";
                $_result2 = mysqli_query($conn, $sql2);
                if ($_result2) {
                    $row2 = mysqli_fetch_assoc($_result2);

                    // Check if a row was fetched
                    if ($row2) {
                        $userId = $row2["UserId"];
                        // Now you can use $userId in your SQL query
                        $sql = 'INSERT INTO login (UserId, LogoutTime, Active) VALUES("' . $userId . '", "", 1)';
                        mysqli_query($conn, $sql);
                    } 
                    else 
                    {
                        echo "User not found."; // Handle the case where the user was not found
                    }
                }
                 else
                {
                    echo "Query failed: " . mysqli_error($conn); // Handle the case where the query failed
                }

                $_SESSION["UserId"] = $row["UserId"];
                echo "$userId";
                 header("location:../pages/landingpage.php");
            }
        }
    }
}
?>