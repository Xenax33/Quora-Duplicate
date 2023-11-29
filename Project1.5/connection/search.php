<?php
// Establish database connection and sanitize input
// ...
session_start();

if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: ../pages/index.php');
    exit;
}

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
$uid = $_SESSION['UserId'];

if (isset($_POST['query'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_POST['query']);
    // $searchQuery = "what";
    // Query the database for matching questions
    $searchResultsQuery = "SELECT * FROM questions WHERE body LIKE '%$searchQuery%'";
    $searchResults = mysqli_query($conn, $searchResultsQuery);

    // Process and return the search results
    while ($row = mysqli_fetch_array($searchResults)) {
        echo '<div>' . $row['body'] . '</div>';
    }

    if (!$searchResults) {
        die('Error in SQL query: ' . mysqli_error($conn));
    }
}
?>
