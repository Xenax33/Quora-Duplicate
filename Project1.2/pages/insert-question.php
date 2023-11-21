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
    $sql = 'INSERT INTO questions (UserId, body, questioncreatedAt, views, tags, image) VALUES("'.$cid.'", "'.$new_question.'", "'.date('Y-m-d').'","'.null.'" , "'.$cat_vals.'", "'.null.'")';

    if (mysqli_query($conn, $sql)) {
        // Get the inserted question ID
        $new_img_name = mysqli_insert_id($conn);
        $_SESSION['status'] = "Question Entered Successfully";
        header("location:landingpage.php");
    } else {
        echo "ERROR: Could not insert values " . mysqli_error($conn);
    }

    // Handle image upload
    if (isset($_FILES["q_name"]) && $_FILES["q_name"]["size"] > 0) {
        $target_dir = "../assets/images/userdata/";
        $target_file = $target_dir . $new_img_name . "." . pathinfo($_FILES["q_name"]["name"], PATHINFO_EXTENSION);

        // Check if the file is an image
        $check = getimagesize($_FILES["q_name"]["tmp_name"]);
        if ($check !== false) {
            // Upload the image
            if (move_uploaded_file($_FILES["q_name"]["tmp_name"], $target_file)) {
                // Update the question record with the image path
                $updateQuery = "UPDATE questions SET image = '$target_file' WHERE questionId = '$new_img_name';";

                if (mysqli_query($conn, $updateQuery)) {
                    header("location:landingpage.php");
                } else {
                    echo "<br>ERROR: Could not able to execute $updateQuery. " . mysqli_error($conn);
                    header("location:landingpage.php");
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";

            // If image is not uploaded, set the image column to null
            $updateQuery = "UPDATE questions SET image = '".null."' WHERE questionId = '$new_img_name';";
            if (mysqli_query($conn, $updateQuery)) {
                header("location:landingpage.php");
            } else {
                echo "<br>ERROR: Could not able to execute $updateQuery. " . mysqli_error($conn);
                header("location:landingpage.php");
            }
        }
    }

    mysqli_close($conn);
  
}
?>
