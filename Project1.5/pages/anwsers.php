<!-- Add this line in the head section to include Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha384-GLhlTQ8iNl4N4L/+r6ZwF1kPGJQa9/7W8C+gR5L4N2UvUdHLaSJJZuG02t7PiSA" crossorigin="anonymous">

<?php
session_start();
if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: landingpage.php');
}
$userId = $_SESSION["UserId"];
$_SESSION["UserId"] = $userId; // Set the session variable

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

// Fetch distinct questions that have at least one answer
$quesQuery = "SELECT DISTINCT q.* FROM questions q
              JOIN answers a ON q.questionId = a.questionId";
$quesTable = mysqli_query($conn, $quesQuery);

if (!$quesTable) {
    die("Question query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha384-GLhlTQ8iNl4N4L/+r6ZwF1kPGJQa9/7W8C+gR5L4N2UvUdHLaSJJZuG02t7PiSA" crossorigin="anonymous">

    <title>Questions and Answers</title>
    <link rel="stylesheet" href="../style/anwsers.css">
    
</head>

<body>
    <header>
        <?php require_once 'navbar.php'; ?>
    </header>
    <main>
        <div class="container my-4">
            <?php
            while ($row = mysqli_fetch_array($quesTable)) {
                $qid = $row['questionId'];
                $qcid = $row['UserId'];
                $Ques_desc = $row['body'];
                $Asked_date = $row['questioncreatedAt'];
                $Q_name = $row['image'];
                $Q_view = $row['views'];
                $Q_cat = $row['tags'];

                $cust = mysqli_query($conn, "SELECT * FROM userprofile WHERE UserId = '$qcid'");
                $cust = mysqli_fetch_array($cust);
                $custName = $cust['Username'];
                $profile = $cust['ProfilePic'];

                echo "<div class='card mb-3'>
                    <div class='card-header'>
                        <div class='d-flex align-items-center'>
                            <img src='$profile' class='mr-2 rounded-circle' width='30' height='30' alt='User Avatar'>
                            <div>
                                <span class='font-weight-bold'>$custName</span>
                                <span class='text-muted ml-2'>Posted on $Asked_date</span>
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                        <p class='card-text'>$Ques_desc</p>
                        <img src='$Q_name' class='img-fluid' alt='Question Image'>
                    </div>";

                // Fetch answers for the current question
                $ansQuery = "SELECT * FROM answers WHERE questionId = '$qid'";
                $answer = mysqli_query($conn, $ansQuery);

                if (!$answer) {
                    die("Answers query failed: " . mysqli_error($conn));
                }

                while ($ans = mysqli_fetch_array($answer)) {
                    $answerText = $ans['body'];
                    $answerUserId = $ans['UserId'];
                    $answerDate = $ans['CreatedAt'];
                    $answerId = $ans['answerId'];
                    $upvotes = $ans['UpVotes'];
                    $downvotes = $ans['DownVotes'];

                    $answerUserQuery = "SELECT * FROM userprofile WHERE UserId = '$answerUserId'";
                    $answerUser = mysqli_query($conn, $answerUserQuery);

                    if (!$answerUser) {
                        die("Answer user query failed: " . mysqli_error($conn));
                    }

                    $answerUserData = mysqli_fetch_array($answerUser);
                    $answerUserName = $answerUserData['Username'];

                    echo "<div class='card-body'>
                        <div class='mt-3'>
                            <div class='font-weight-bold'>Answer:</div>
                            <div class='text-muted'>$answerText</div>
                            <div class='d-flex align-items-center'>
                                <span class='font-weight-bold mr-2'>Answered by:</span>
                                <span class='text-muted'>$answerUserName</span>
                            </div>
                            <div class='text-muted'>Answered on $answerDate</div>
                            <div class='d-flex mt-2'>
                                <button class='btn btn-outline-success mr-2' onclick='voteUp($answerId)'>
                                <i class='fas fa-thumbs-up'></i> Upvote (<span id='upvoteCount$answerId'>$upvotes</span>)
                                </button>
                                <button class='btn btn-outline-danger' onclick='voteDown($answerId)'>
                                    <i class='fas fa-thumbs-down'></i> Downvote (<span id='downvoteCount$answerId'>$downvotes</span>)
                                </button>
                            </div>
                        </div>
                    </div>";
                }

                echo "</div>"; // Close the card for the current question
            }
            ?>
        </div>
    </main>

    <!-- Bootstrap JS and other script imports here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI/t1aZlL2LidC6RzU5zqMu9zFk1aBd8LELW+QjI=" crossorigin="anonymous"></script>
    <script>
        function voteUp(answerId) {
            // Use AJAX to send the upvote action to the server and update the count
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the upvote count on the client side
                    document.getElementById('upvoteCount' + answerId).textContent = this.responseText;
                }
            };
            xhttp.open("GET", "update_votes.php?type=upvote&answerId=" + answerId, true);
            xhttp.send();
        }

        function voteDown(answerId) {
            // Use AJAX to send the downvote action to the server and update the count
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the downvote count on the client side
                    document.getElementById('downvoteCount' + answerId).textContent = this.responseText;
                }
            };
            xhttp.open("GET", "../connection/update_votes.php?type=downvote&answerId=" + answerId, true);
            xhttp.send();
        }
    </script>

</body>

</html>