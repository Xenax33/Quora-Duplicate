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
    $questionId = $_POST['questionId'];

    // Delete the question
    $deleteQuery = "DELETE FROM questions WHERE questionId = '$questionId'";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        $_SESSION['status'] = 'Question deleted successfully';
    } else {
        $_SESSION['status'] = 'Error deleting question: ' . mysqli_error($conn);
    }

    header('location: deleteQuestion.php');
    exit();
} else {
    header('location: landingpage.php'); // Redirect if not a POST request
    exit();
}
?>
