<?php
// notifications.php

// Connect to the database
$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = 'qoura';

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have a table named 'notifications' with columns 'id' and 'message'
$sql = "SELECT id, message FROM notifications ORDER BY id DESC LIMIT 5"; // Fetch the latest 5 notifications
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>{$row['message']}</div>";
    }
} else {
    echo "No notifications";
}

// Close the connection
mysqli_close($conn);
?>
