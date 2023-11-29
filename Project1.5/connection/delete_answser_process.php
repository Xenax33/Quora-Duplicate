<?php
session_start();

if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: landingpage.php');
    exit(); // Ensure script stops execution if user is not logged in
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
    $AnwserId = $_POST['answerId'];

    // Delete the question
    $deleteQuery = "DELETE FROM answers WHERE answerId = '$AnwserId'";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        $_SESSION['status'] = 'Answser deleted successfully';
    } else {
        $_SESSION['status'] = 'Error Answser question: ' . mysqli_error($conn);
    }

    header('location: ../pages/DeleteAnwsers.php');
    exit();
} else {
    header('location: ../pages/landingpage.php'); // Redirect if not a POST request
    exit();
}
?>
