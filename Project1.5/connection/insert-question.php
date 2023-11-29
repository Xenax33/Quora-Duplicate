<?php
session_start();

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";
$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

$new_question = "";
$new_qcat = [];
$cat_vals = "";
$new_img_name = "";

if (!$conn) {
    die('Connection Failed: ' . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $new_question = mysqli_real_escape_string($conn, $_POST["quesfield"]);

    // Get selected categories
    if (!empty($_POST['cat_check'])) {
        $new_qcat = $_POST['cat_check'];
        $cat_vals = implode(',', $new_qcat);
    }

    $cid = $_SESSION["UserId"];
    $defaultImagePath = "../assets/images/userdata/";
    $target = $_FILES["q_name"]["name"];
    $fullImagePath = $defaultImagePath . $target;

    // Move the uploaded file to a specific path on the server
    $target_dir = "../assets/images/userdata/";

    // Ensure the destination directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_path_on_server = $target_dir . $target;

    if (move_uploaded_file($_FILES["q_name"]["tmp_name"], $target_path_on_server)) {
        // File moved successfully, now update the database with the path
        $sql = 'INSERT INTO questions (UserId, body, questioncreatedAt, views, tags, image) VALUES("'.$cid.'", "'.$new_question.'", "'.date('Y-m-d').'","'.null.'" , "'.$cat_vals.'", "'.$fullImagePath.'")';

        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = "Question Entered Successfully";
            header("location:landingpage.php");
        } else {
            echo "ERROR: Could not insert values " . mysqli_error($conn);
        }
    } else {
        $_SESSION['status'] =  "Sorry, there was an error moving the uploaded file.";
    }

    mysqli_close($conn);
}
header("location:../pages/landingpage.php");
?>
