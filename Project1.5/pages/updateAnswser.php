<?php
session_start();

if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: landingpage.php');
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

$uid = $_SESSION['UserId'];

// Retrieve answers given by the current user
$ansQuery = "SELECT * FROM answers WHERE UserId = '$uid'";
$ansResult = mysqli_query($conn, $ansQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Your Answers</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require_once 'navbar.php';
    if (isset($_SESSION['status'])) { ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['status']);
    }
    ?>
</head>

<body>

    <div class="container mt-4">

        <?php if (mysqli_num_rows($ansResult) > 0) { ?>
            <h2>Your Answers</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Answers</th>
                        <th>Submitted On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($answer = mysqli_fetch_assoc($ansResult)) { ?>
                        <tr id="row_<?php echo $answer['answerId']; ?>">
                            <form action="../connection/update_answer.php" method="post">
                                <input type="hidden" name="answerId" value="<?php echo $answer['answerId']; ?>">
                                <td>
                                    <span class="editable" contenteditable="false">
                                        <?php echo $answer['body']; ?>
                                    </span>
                                    <input type="text" name="updatedBody" class="form-control editable"
                                        value="<?php echo $answer['body']; ?>" style="display: none;">
                                </td>
                                <td>
                                    <?php echo $answer['CreatedAt']; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                        onclick="toggleEdit('<?php echo $answer['answerId']; ?>')">
                                        Update
                                    </button>
                                    <button type="submit" class="btn btn-success" style="display: none;">
                                        Submit
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No answers found.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
        function toggleEdit(answerId) {
            var row = document.getElementById('row_' + answerId);
            var textSpan = row.querySelector('.editable');
            var inputField = row.querySelector('input.editable');
            var updateBtn = row.querySelector('.btn-danger');
            var submitBtn = row.querySelector('.btn-success');

            // Toggle the display of the text and input field
            textSpan.style.display = (textSpan.style.display === 'none') ? 'inline' : 'none';
            inputField.style.display = (inputField.style.display === 'none') ? 'inline' : 'none';

            // Toggle button visibility
            updateBtn.style.display = (updateBtn.style.display === 'none') ? 'inline' : 'none';
            submitBtn.style.display = (submitBtn.style.display === 'none') ? 'inline' : 'none';
        }
    </script>

</body>

</html>

<?php
mysqli_close($conn);
?>