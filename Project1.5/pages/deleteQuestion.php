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

$uid = $_SESSION['UserId'];

// Retrieve questions asked by the current user
$questionsQuery = "SELECT * FROM questions WHERE UserId = '$uid'";
$questionsResult = mysqli_query($conn, $questionsQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Your Questions</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
        <?php require_once  'navbar.php'?>
</head>

<body>

    <div class="container mt-4">

        <?php if (mysqli_num_rows($questionsResult) > 0) { ?>
            <h2>Your Questions</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Date Asked</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($question = mysqli_fetch_assoc($questionsResult)) { ?>
                        <tr>
                            <td><?php echo $question['body']; ?></td>
                            <td><?php echo $question['questioncreatedAt']; ?></td>
                            <td>
                                <form method="post" action="../connection/delete_question_process.php">
                                    <input type="hidden" name="questionId" value="<?php echo $question['questionId']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No questions found.</p>
        <?php } ?>

        <a href="landingpage.php" class="btn btn-primary">Back to Base</a>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>

<?php
mysqli_close($conn);
?>
