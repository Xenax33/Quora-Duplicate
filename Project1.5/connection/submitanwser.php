<?php

session_start();
$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

if (isset($_SESSION["UserId"])) {
    $userId = $_SESSION['UserId'];
    $successMessage = '';
    if (isset($_POST['anssubmit'])) {
        $anstext = $_POST['answerfield'];
        $qid = $_POST['qid'];
        $cid = $_SESSION['UserId'];
        $date = date('Y-m-d');
        $sql = 'INSERT INTO answers (questionId, UserId, body) VALUES ("' . $qid . '", "' . $cid . '", "' . $anstext . '")';

        $row = mysqli_query($conn, $sql);
        if ($row) {
            $_SESSION['status'] = "Answer Submitted Successfully!";
            header("location:questions.php");
        } else {
            $_SESSION['status'] = "Error Submitting Answer!";
        }
    } else {
        echo "not submitted";
    }

     header("location: ../pages/questions.php?id=$qid&successMessage=$successMessage");
} else {
    echo "Not Getting the User Id";
}



?>