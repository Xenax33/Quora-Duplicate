<?php
// update_answer.php

session_start();

if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: ../pages/landingpage.php');
    exit(); // Ensure script stops execution if the user is not logged in
}

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answerId = $_POST['answerId'];
    $updatedBody = $_POST['updatedBody'];

    // Update the database with the new data
    $updateQuery = "UPDATE answers SET body = '$updatedBody' WHERE answerId = '$answerId'";
    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['status'] = "Updated Successfully";

    }
    else{
        $_SESSION['status'] = "CouldNot Update";
    }
    ;

}

mysqli_close($conn);
header("location:../pages/updateAnswser.php");
?>