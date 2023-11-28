<?php
session_start();
if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: login.php');
}

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";
$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

function answers()
{
    echo
        "<img src='../assests/images/postbox.png' style='width:15%' class='mt-5'><span id='empty-message' class='text-muted'>You haven't answered any questions yet.</span><button id='activitybtn'class='btn btn-primary mt-5' onclick='gotoHome()' style='border-radius: 20px;'>Answer questions</button>";
}

// User Profile queries
$cid = $_SESSION['UserId'];
$custQuery = "SELECT * FROM userprofile WHERE UserId = '$cid'";

$categoriestable = mysqli_query($conn, $custQuery);
$row = mysqli_fetch_array($categoriestable);
$cname = $row['Username'];
$joined = $row['createdAt'];
$DP_name = $row['ProfilePic'];

// Question Count
$countQuestions = "SELECT COUNT(*) AS question_count FROM questions WHERE UserId = '$cid'";
$countQ = mysqli_query($conn, $countQuestions);
$row1 = mysqli_fetch_assoc($countQ);
$questionCount = $row1['question_count'];

// Anwsers Counts

$countans = "SELECT COUNT(*) AS ans_count FROM answers WHERE UserId = '$cid'";
$countA = mysqli_query($conn, $countans);
$row2 = mysqli_fetch_assoc($countA);
$AnswerCount = $row2['ans_count'];

// Following Count

$countFollow = "SELECT COUNT(*) AS follow_count FROM followers WHERE Followedby = '$cid'";
$countF = mysqli_query($conn, $countFollow);
$row3 = mysqli_fetch_assoc($countF);
$FollowingCount = $row3['follow_count'];
// Follower Count

$countFollowing = "SELECT COUNT(*) AS follow_count FROM followers WHERE Following = '$cid'";
$countFr = mysqli_query($conn, $countFollowing);
$row4 = mysqli_fetch_assoc($countFr);
$FollowerCount = $row4['follow_count'];

// Update UserProfile

$userProfileQuery = "SELECT * FROM userprofile WHERE UserId = '$cid'";
$userProfileResult = mysqli_query($conn, $userProfileQuery);
$userProfile = mysqli_fetch_assoc($userProfileResult);

// Update user profile information if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProfile'])) {
    // Get updated values from the form
    $updatedUsername = $_POST['updatedUsername'];
    $updatedEmail = $_POST['updatedEmail'];

    // Update the user profile in the database
    $updateProfileQuery = "UPDATE userprofile SET Username = '$updatedUsername', Email = '$updatedEmail' WHERE UserId = '$cid'";
    mysqli_query($conn, $updateProfileQuery);

    // Refresh the page to reflect the changes
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Follow Function
function followUser($followerId, $followingId, $conn)
{
    $followQuery = "INSERT INTO followers (Followedby, Following) VALUES ('$followerId', '$followingId')";
    $result = mysqli_query($conn, $followQuery);

    if (!$result) {
        die("Error inserting data: " . mysqli_error($conn));
    }

    return $result;
}

function getFollowingStatus($followerId, $followingId, $conn)
{
    $checkQuery = "SELECT * FROM followers WHERE Followedby = '$followerId' AND Following = '$followingId'";
    $result = mysqli_query($conn, $checkQuery);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $count = mysqli_num_rows($result);

    return $count > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['followUser'])) {
    $otherUserId = $_POST['otherUserId'];

    // Check if the user is not trying to follow themselves
    if ($otherUserId != $cid) {
        // Follow the other user
        if (followUser($cid, $otherUserId, $conn)) {
            // Redirect to the same page to reflect changes
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        main {
            margin-top: 20px;
        }

        #userDetails {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #profileimg {
            width: 100%;
            height: auto;
            border-radius: 50%;
            margin-top: 20px;
        }

        .user-info {
            text-align: center;
            margin-top: 15px;
        }

        .user-info h3 {
            margin-bottom: 10px;
        }

        .user-info p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .user-info span {
            font-weight: bold;
            color: #007bff;
        }

        .counts-line {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .count-item {
            text-align: center;
        }

        .count-item img {
            width: 30px;
            margin-bottom: 5px;
        }

        #questions-section,
        #answers-section {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <header>
        <?php require_once 'navbar.php' ?>
    </header>

    <main>
        <div class="container" id="userDetails">
            <!-- User info section -->
            <div class="user-info">
                <?php echo "<h3>$cname</h3>"; ?>
                <?php echo "<img id='profileimg' src='$DP_name' alt='profile image'>"; ?>
                <div class="counts-line">
                    <div class="count-item">
                    <p>Following<br>
                        <?php echo "<span>$FollowerCount</span>"?>
                    </p>
                    </div>
                    <div class="count-item">
                        <p>Following<br>
                        <?php echo "<span>$FollowingCount</span>"?>
                    </p>
                    </div>
                    <div class="count-item">
                        <p>Answers<br>
                            <?php echo "<span>$AnswerCount</span>"; ?>
                        </p>
                    </div>
                    <div class="count-item">
                        <p>Questions<br>
                            <?php echo "<span>$questionCount</span>"; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Questions Asked section -->
            <div id="questions-section">
                <h4>Questions Asked</h4>
                <!-- Display user's questions -->
                <?php
                $dbhost = 'localhost';
                $dbUsername = 'root';
                $dbpassword = '';
                $dbname = "qoura";
                $conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
                $cid = $_SESSION['UserId'];
                $quesQuery = "SELECT * FROM questions WHERE UserId = $cid";
                if ($questions = mysqli_query($conn, $quesQuery)) {
                    if (mysqli_num_rows($questions) > 0) {
                        while ($row = mysqli_fetch_array($questions)) {
                            $desc = $row['body'];
                            echo "<div class='card'>$desc</div>";
                        }
                    } else {
                        answers();
                    }
                }
                mysqli_close($conn);
                ?>
            </div>

            <!-- Separator -->
            <hr>

            <!--  Answers section -->
            <div id="answers-section">
                <h4>Your Answers</h4>
                <!-- Display user's answers -->
                <?php
                $dbhost = 'localhost';
                $dbUsername = 'root';
                $dbpassword = '';
                $dbname = "qoura";
                $conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
                $cid = $_SESSION['UserId'];
                $ansQuery = "SELECT * FROM answers WHERE UserId = $cid";
                if ($ans = mysqli_query($conn, $ansQuery)) {
                    if (mysqli_num_rows($ans) > 0) {
                        while ($row = mysqli_fetch_array($ans)) {
                            $desc = $row['body'];
                            echo "<div class='card'>$desc</div>";
                        }
                    } else {
                        answers();
                    }
                }
                mysqli_close($conn);
                ?>
            </div>

            <!-- Following Section -->
            <div id="following-section">
                <?php
                $dbhost = 'localhost';
                $dbUsername = 'root';
                $dbpassword = '';
                $dbname = "qoura";
                $conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
                $otherUsersQuery = "SELECT * FROM userprofile WHERE UserId != '$cid'";
                $otherUsersResult = mysqli_query($conn, $otherUsersQuery);
                ?>
                <!-- Separator -->
                <hr>

                <!-- Other Users section -->
                <!-- Other Users section -->
                <div id="other-users-section">
                    <h4>Other Users</h4>
                    <!-- Display other users with follow button -->
                    <?php
                    while ($otherUser = mysqli_fetch_assoc($otherUsersResult)) {
                        $otherUserId = $otherUser['UserId'];
                        $otherUserName = $otherUser['Username'];

                        // Check if the user is already following this other user
                        $isFollowingResult = mysqli_query($conn, "SELECT * FROM followers WHERE Followedby = '$cid' AND Following = '$otherUserId'");
                        if ($isFollowingResult) {
                            $isFollowing = mysqli_num_rows($isFollowingResult) > 0;
                            $followButtonText = $isFollowing ? "Following" : "Follow";
                        } else {
                            // Handle the error or log it
                            die("Error checking if following: " . mysqli_error($conn));
                        }

                        echo "<div class='card' style='display: inline-block; align-items: left; margin-right: 5px;'>
            <p style='flex: 1;'>$otherUserName</p>
            <form method='post'>
                <input type='hidden' name='otherUserId' value='$otherUserId'>";

                        // Check if the user is already following and change the button text accordingly
                        if ($isFollowing) {
                            echo "<span>Following</span>";
                        } else {
                            echo "<button class='btn btn-primary' name='followUser'>$followButtonText</button>";
                        }

                        echo "</form>
        </div>";
                    }
                    ?>
                </div>


                <hr>

                <!-- Update Profile section -->
                <div id="update-profile-section">
                    <h4>Update Profile</h4>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="updatedUsername">Username:</label>
                            <input type="text" class="form-control" id="updatedUsername" name="updatedUsername"
                                value="<?php echo $userProfile['Username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updatedEmail">Email:</label>
                            <input type="email" class="form-control" id="updatedEmail" name="updatedEmail"
                                value="<?php echo $userProfile['email']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="updateProfile">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
</body>

</html>