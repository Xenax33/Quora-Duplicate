<?php
session_start();
if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    die("Unauthorized access");
}

// Ensure the type parameter is set
if (!isset($_GET['type'])) {
    die("Invalid request");
}

$answerId = $_GET['answerId'];
$userId = $_SESSION['UserId'];
$type = $_GET['type'];

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//To Check if the user has already voted
$checkVoteQuery = "SELECT * FROM votes WHERE UserId = '$userId' AND AnswerId = '$answerId'";
$checkVoteResult = mysqli_query($conn, $checkVoteQuery);

if (!$checkVoteResult) {
    die("Vote check query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($checkVoteResult) > 0) {
    die("You have already voted for this answer");
}

// Update the votes based on the type (upvote or downvote)
if ($type == 'upvote') {
    $updateVotesQuery = "UPDATE answers SET UpVotes = UpVotes + 1 WHERE answerId = '$answerId'";
} elseif ($type == 'downvote') {
    $updateVotesQuery = "UPDATE answers SET DownVotes = DownVotes + 1 WHERE answerId = '$answerId'";
} else {
    die("Invalid vote type");
}

// Perform the update
$updateVotesResult = mysqli_query($conn, $updateVotesQuery);

if (!$updateVotesResult) {
    die("Update votes query failed: " . mysqli_error($conn));
}

// To Record the vote in the votes table to prevent multiple votes from the same user
$recordVoteQuery = "INSERT INTO votes (UserId, AnswerId) VALUES ('$userId', '$answerId')";
$recordVoteResult = mysqli_query($conn, $recordVoteQuery);

if (!$recordVoteResult) {
    die("Record vote query failed: " . mysqli_error($conn));
}

// To Retrieve the updated vote count and send it as the response
$getVoteCountQuery = "SELECT UpVotes, DownVotes FROM answers WHERE answerId = '$answerId'";
$getVoteCountResult = mysqli_query($conn, $getVoteCountQuery);

if (!$getVoteCountResult) {
    die("Get vote count query failed: " . mysqli_error($conn));
}

$voteCount = mysqli_fetch_assoc($getVoteCountResult);

// To Send the vote count as the response
echo $voteCount['UpVotes'] . "," . $voteCount['DownVotes'];

mysqli_close($conn);
?>
