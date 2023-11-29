<?php
if (isset($_POST["signup-submit"])) {
    $uname = $_POST["Username"];
    $newemail = $_POST["email"];
    $Bio = $_POST["bio"];
    $pwd = $_POST["password1"];

    // Image upload handling
    $target = $_FILES["profilePic"]["name"];
    $defaultImagePath = "/../assests/images/userdata/";
    $fullImagePath = $defaultImagePath . $target;



    $targetDir = __DIR__ . "/../assests/images/userdata/";
    $targetFile = $targetDir . basename($_FILES["profilePic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check for upload errors
    if ($_FILES["profilePic"]["error"] > 0) {
        echo "Error: " . $_FILES["profilePic"]["error"];
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profilePic"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" &&
        $imageFileType != "jpeg" && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFile)) {
            // Additional handling for storing the file on the user's computer
            $userSpecificPath = "/../assests/images/userdata/"; // Change this to the desired path

            // Create the user-specific path if it doesn't exist
            if (!file_exists($userSpecificPath)) {
                mkdir($userSpecificPath, 0755, true);
            }

            // Copy the uploaded file to the user-specific path
            $userSpecificFile = $userSpecificPath . basename($_FILES["profilePic"]["name"]);
            copy($targetFile, $userSpecificFile);

            // Connection to database
            $dbhost = 'localhost';
            $dbUsername = 'root';
            $dbpassword = '';
            $dbname = 'qoura';

            // Creating Database connection
            $conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
            if (!$conn) {
                die('Connection Failed: ' . mysqli_connect_error());
            }

            $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO userprofile (Username, email, password, Bio, Active, ProfilePic) VALUES("' . $uname . '","' . $newemail . '","' . $hashedpwd . '","' . $Bio . '", 1, "' . $fullImagePath . '")';
            mysqli_query($conn, $sql);

            // to Display success message in an inline popup using JavaScript
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var popup = document.createElement("div");
                        popup.className = "popup";
                        popup.innerHTML = "<p>Successfully registered! &#127881;</p>";
                        document.body.appendChild(popup);

                        setTimeout(function() {
                            document.body.removeChild(popup);
                            window.location.href = "index.php";
                        }, 5000); // 5000 milliseconds = 5 seconds
                    });
                </script>';
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<style>
    .popup {
        display: inline-block;
        background: #4CAF50;
        color: white;
        padding: 10px;
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 5px;
        animation: fadeOut 5s ease;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style>