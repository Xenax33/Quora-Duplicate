<?php

session_start();

if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == false) {
    header('location: index.php');
}

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbname = "qoura";

$conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
$uid = $_SESSION['UserId'];
$custQuery = "SELECT * FROM userprofile WHERE UserId = '$uid'";

$custTable = mysqli_query($conn, $custQuery);

// Check if the query was successful
if ($custTable) {
    // Fetch data from the result set
    $row = mysqli_fetch_array($custTable);

    // Check if the row was found
    if ($row) {
        $cname = $row['Username'];
        $joined = $row['createdAt'];
        $DP_name = $row['Bio'];
    } else {
        // Handle the case where the user data was not found
        echo "User not found.";
    }
} else {
    // Handle query failure
    echo "Query failed: " . mysqli_error($conn);
}

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Quora</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="../style/landingpage.css">
    </head>
    <body>
        <header>
            <!-- <?php require_once 'navbar.php' ?> -->
        </header>

        <main>
           
            <div class="container d-flex p-4">
                
                <!-- LEFT SIDE BAR -->
                <div class="col-md-2 d-flex flex-column justify-content-start" id="leftcol">
                    <button onclick="showques()" class="leftcolbtn my-1 py-2  text-muted rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Add question
                    </button>


                    <?php 

                        $categoriesQuery = "SELECT * FROM tags";
                        
                        if($categoriestable = mysqli_query($conn, $categoriesQuery)){
                            if(mysqli_num_rows($categoriestable) > 0){
                                //echo "<br>whole table : <br>"; 
                                while ($row = mysqli_fetch_array($categoriestable)){
                                    $tagName = $row['Tagname'];
                                    echo 
                                    "<button class='leftcolbtn my-1 py-2  text-muted rounded'>
                                        $tagName
                                    </button>";
                                    
                                }
        
                            }else{
                                echo "<br> no such row";
                            }
                        }

                    ?>

                </div>

                <!-- MIDDLE CONTENT -->
                <div class="col-md-7">
                    <div class="card p-2 mb-2" onclick="showques()">
                        <div class="d-flex flex-column">
                            <div class="m-1">
                                <?php echo "<img id='qcardavatar' name='qcardavatar' src='../assests/images/image.jpeg'>" ?>
                                <span class="text-muted"><?php echo $cname; ?></span>
                            </div>
                            <span class="d-block font-weight-bold m-1 text-muted" id="quesHeading">What is your question ?</span>
                        </div>
                    </div>
                    <!-- QUESTIONS -->
                    <div class="card mb-2" id="qid">
                        <div class="d-flex flex-column">
                            <div class="d-flex m-1 p-2">
                                <img id="qidAvatar" name="qidAvatar" class="postimg" src="../assests/images/dp1.jpeg">
                                <div class="mx-2 d-flex flex-column">
                                    <span class="font-weight-bold postname h-50">Kim Taehyung</span>  
                                    <span class="text-muted postdate  h-50">2021-Nov-17</span>  
                                </div>
                            </div>
                            <div class="px-2 pb-2">
                                <span class="postdesc">
                                Kim Tae-hyung, known professionally as V, is a South Korean singer and a member of the boy band BTS.
                                Since his debut with the band in 2013, V has performed three solo songs under their name—"Stigma" in 2016, "Singularity" in 2018, and "Inner Child" in 2020—all of which charted on South Korea's Gaon Digital Chart.
                                </span>
                            </div>
                            <img src="../assests/images/dp1.jpeg" class="w-100">
                        </div>
                    </div>
                    
                    <div class="card mb-2" id="qid">
                        <div class="d-flex flex-column">
                            <div class="d-flex m-1 p-2 justify-content-between">
                                <div class="d-flex">
                                    <img id="qidAvatar" name="qidAvatar" class="postimg" src="../assests/images/dp2.jpeg">
                                    <div class="mx-2 d-flex flex-column">
                                        <span class="font-weight-bold postname h-50">Lee Jong-suk</span>  
                                        <span class="text-muted postdate  h-50">2021-Oct-10</span>  
                                    </div>
                                </div>
                                <form method="post" action="question.php"> <button id="qid" class="answerbtn">answer</button> </form>
                            </div>
                            <div class="px-2 pb-2">
                                <span class="postdesc">
                                Lee Jong-suk is a South Korean actor and model. He debuted in 2005 as a runway model, becoming the youngest male model ever to participate in Seoul Fashion Week.
                                 Lee's breakthrough role was in School 2013.                                </span>
                            </div>
                            <img src="../assests/images/dp2.jpeg" class="w-100">
                        </div>
                    </div>


                    <?php
                        $quesQuery = "SELECT * FROM questions";
                        $quesTable = mysqli_query($conn, $quesQuery);
                        
                        if(mysqli_num_rows($quesTable) > 0){
                            while ($row = mysqli_fetch_array($quesTable)){
                                
                                $qid = $row['questionId'];
                                $qcid = $row['UserId'];
                                $Ques_desc = $row['body'];
                                $Asked_date = $row['questioncreatedAt'];
                                $Q_name = $row['Title'];
                                $Q_cat = $row['views'];

                                $cust = mysqli_query($conn, "SELECT * FROM userprofile WHERE UserId = '$qcid'");
                                $cust = mysqli_fetch_array($cust);
                                $custName = $cust['Username'];
                                // $custImg = $cust['Bio'];

                                if($Q_name == ""){
                                    echo
                                    "<div class='card mb-2' id='$qid-container'>
                                        <div class='d-flex flex-column'>
                                            <div class='d-flex m-1 p-2 justify-content-between'>
                                                <div class='d-flex'>
                                                    <div class='mx-2 d-flex flex-column'>
                                                        <span class='font-weight-bold postname h-50'>$custName</span>  
                                                        <span class='text-muted postdate  h-50'>posted-on $Asked_date</span>  
                                                    </div>
                                                </div>
                                                <form method='post' action='question.php?id=$qid'> <button id='$qid' class='answerbtn p-2 px-4 rounded btn btn-primary'>Answer</button> </form>
                                            </div>
                                            <div class='px-2 pb-2'>
                                                <span class='postdesc'>
                                                    $Ques_desc
                                                </span>
                                            </div>
                                        </div>
                                    </div>"
                                ;
                                }else{
                                    echo
                                        "<div class='card mb-2' id='$qid-container'>
                                            <div class='d-flex flex-column'>
                                                <div class='d-flex m-1 p-2 justify-content-between'>
                                                    <div class='d-flex'>
                                                        <img id='$qid-Avatar' name='$qid-Avatar' class='postimg' src='$custImg'>
                                                        <div class='mx-2 d-flex flex-column'>
                                                            <span class='font-weight-bold postname h-50'>$custName</span>  
                                                            <span class='text-muted postdate  h-50'>posted-on $Asked_date</span>  
                                                        </div>
                                                    </div>
                                                    <form method='post' action='question.php?id=$qid'> <button id='$qid' class='answerbtn p-2 px-4 rounded btn btn-primary'>Answer</button> </form>
                                                </div>
                                                <div class='px-2 pb-2'>
                                                    <span class='postdesc'>
                                                        $Ques_desc
                                                    </span>
                                                </div>
                                                <img src='$Q_name' class='w-100'>
                                            </div>
                                        </div>"
                                    ;
                                }

                            }

                        }else{
                            echo "<br> no such row";
                        }
                    
                    
                    ?>
                    

                </div>



                <div class="col-md-3">
                    
                </div>
            </div>


        </main>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script>
            posts = document.getElementsByClassName("postdesc");
            for(var i=0; i<posts.length; i++){
                posts[i].onclick = function () {
                this.style['-webkit-line-clamp'] = 10000;
                //this.style['line-clamp'] = 'none';
            }
            }
            
        </script>

<?php mysqli_close($conn); ?>
    </body>
</html>