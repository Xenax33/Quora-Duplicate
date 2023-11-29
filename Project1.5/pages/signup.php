<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Login Form</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../connection/connection.php">
    <link rel="stylesheet" href="../connection/process.php">

</head>

<body>
    <section>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <form class="Login" action="../connection/signupdb.php" method="post" enctype="multipart/form-data">
            <div class="heading">
                <h2>Sign Up</h2>
                <div class="form">
                    <div class="inputbox">
                        <input type="text" name="Username" required><i>Username</i>
                    </div>
                    <div class="inputbox">
                        <input type="email" name="email" required><i>Email</i>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="bio" required><i>Enter Your Bio</i>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password1" required><i>Enter Your Password</i>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password2" required><i>Re-Enter Your Password

                        </i>
                    </div>
                    <div class="inputbox">
                        <input type="file" name="profilePic" id="profilePic" accept="image/*">
                    </div>
                    <div class="inputbox">

                        <div class="inputbox">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $_pass1 = $_POST["password1"];
                                $_pass2 = $_POST["password2"];

                                if ($_pass1 == $_pass2) {
                                    echo '<input type="submit" id="signup-submit" name="signup-submit">';
                                } else {
                                    echo '<p style="color: red;">Passwords do not match. Please try again.</p>';
                                    // Clear password fields
                                    $_pass1 = "";
                                    $_pass2 = "";
                                }
                            }
                            ?>
                            <input type="submit" id="signup-submit" name="signup-submit" >

                        </div>
                    </div>
                </div>
        </form>
    </section>
    </div>
    <script src="/js/script.js">

    </script>
</body>

</html>