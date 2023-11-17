<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Process the data (you can perform database operations, send emails, etc.)
    // For this example, we'll just echo the data
    echo "Name: $name <br>";
    echo "Email: $email";
}
?>