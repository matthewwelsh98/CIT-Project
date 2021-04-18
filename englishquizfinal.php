
<?php
//SESSIONS
session_start();
include("connection.php");

if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    } $user = $_SESSION['primarylearn'];

    
    
$conn->set_charset('utf8');
//Select all from english quiz query
$query = "SELECT * FROM 3047_englishquiz";

$final = $conn->query($query) or die($conn->error . __LINE__);
$total = $final->num_rows;
//select from quiz query and call where answer is correct
$queryquizcall = "SELECT * FROM 3047_englishquizchoices WHERE is_correct = '1'";

$resultquiz = $conn->query($queryquizcall);

if (!$resultquiz) {
    echo $conn->error;
}

//get the user id
$query3 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery2 = $conn->query($query3);

while ($row7 = $resultquery2->fetch_assoc()) {
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}


//student can view their stars in the system 
$queryviewstars = $conn->query("SELECT * FROM 3047_star_total WHERE user_id = '$user'");
while($row1 = $queryviewstars -> fetch_assoc()){
         $points = $row1['total'];

 }
 //set the stars and get points to unlock the stars
$querystars = $conn->query("UPDATE 3047_star_total SET total = $points + '1' WHERE user_id = '$user'");


if(!$querystars){
   echo $conn->error;
}
 

?>

<html
    
    lang="en">
    <head>
        <!-- My Theme   -->
        <title>Primary Learn</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="ui.css" rel="stylesheet" type="text/css"/>
    </head>
   

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        
 <!--- NAVIGATION -->
    <nav class="my-navbar navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
             
                <a  href="index.php" title="PrimaryLearn"><h1>Primary Learn | VLE </h1></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                  
                 <li class="active">  <a href="subjects.php"><span class="glyphicon glyphicon-home" ></span> Home</a></li>
                 
                 
 <?php if($utype == 1 || $utype == 2){echo"<a href='profile.php'>Parents</a>";
     
 
 } elseif ($utype == 3) {
                     echo"<a href='settrophy.php'>Rewards</a>";
                 }
                 ?> 


                    <li><a href="chat.php"> Chat</a></li>    
                 
                                  <div class="dropdown">
                    <?php    $username = $_SESSION['plusername'];
           echo"        <button class='dropbtn'>$username <i class='fa fa-caret-down'></i></button>";?>
                   
                   <div class="dropdown-content">
                       <div class="text-center"> <a href="profile.php">  <?php echo "<img src='images/$userimg'width='100px'/>"?></div></a>
                       <a href="profile.php"><?php echo $useremail?></a>
                     <a href="processlogout.php"><span class="glyphicon glyphicon-log-out" ></span>Log Out</a></div>
                   </div>
                 </div>
            </div>
    </nav>

        <br><br>

        
      <div class="container">
     <div class='text-center'>
<div class="col-md-12">
    
    
                        <h2><span class='glyphicon glyphicon-list-alt'></span> Your Results</h2>
    
                        <p><strong> <h3<b>Final Score: <?php echo $_SESSION['score_numbers']; ?> </b>/ <?php echo $total; ?> </p></strong> <br>    
            <h4> <?php echo" You Earned + <b>1</b> Point towards a star!
                   <br>
               "; ?> </h4>
            <a href='englishquizquestions.php?n=1'><button class='btn btn-warning'>Retake Quiz</button>  </a>   
            <a href='englishquiz.php'><button class='btn btn-success'> Finish </button> 


              
            
                
                <hr class='light'>
                
               </div></div>

          
            <?php
            
            // more complex php. in this student can get a star for completing quizzes to a high standard
                if (isset($_POST['newstar'])) {
                    
$querystars = $conn->query("UPDATE 3047_star_total SET total = $points + '1' WHERE user_id = '$user'");
                }
                
                ?>
          
   <?php
   
      // run through the questions
                  if($_SESSION['score_numbers'] == 1)
          {         

          echo      "<div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-ok'></span> Quiz has been completed but not full marks. Please try again!!</h2>
                        <p> Have another go! </p>     
                    </div>
                    <hr class='my-4'> <br>
                </div>
            </div>

            <div class='container text-center'>

                <h4>Please try again to get full marks! </h4>";
          
          
           }else if($_SESSION['score_numbers'] == 2)
          {         
                  
                    echo      "<div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-ok'></span> Quiz has been completed but not full marks. Please try again!!!!</h2>
                        <p> Have another go!  </p>     
                    </div>
                    <hr class='my-4'> <br>
                </div>
            </div>

            <div class='container text-center'>

                <h4> Please try again to get full marks!! </h4>";
              
          }else if($_SESSION['score_numbers'] == 3)
          {         
                  
                    echo      "<div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-ok'></span> Quiz has been completed but not full marks. Please try again!!!!</h2>
                        <p> Have another go!  </p>     
                    </div>
                    <hr class='my-4'> <br>
                </div>
            </div>

            <div class='container text-center'>

                <h4> Please try again to get full marks!! </h4>";
              
          }else if($_SESSION['score_numbers'] == 4)
          {         
                  
                    echo      "<div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-ok'></span> Quiz has been completed but not full marks. Please try again!!!!</h2>
                        <p> Have another go!  </p>     
                    </div>
                    <hr class='my-4'> <br>
                </div>
            </div>

            <div class='container text-center'>

                <h4> Please try again to get full marks!! </h4>";
              
          }else if($_SESSION['score_numbers'] == 5)
          {         
                  
                    echo      "<div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-ok'></span>  Give yourself a pat on the back and a big well done! You have worked very hard!!!!!</h2>
                        <p> Well done!  </p>     
                    </div>
                    <hr class='my-4'> <br>
                </div>
            </div>

            <div class='container text-center'>

                <h4> Section is completed well done!! </h4>";
              
          }else{
            echo    "  <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-ok'></span> A disappointing result. Please try again!!!!</h2>
                        <p> Have another go!  </p>     
                    </div>
                    <hr class='my-4'> <br>
                </div>
            </div>

            <div class='container text-center'>

                <h4> You will need to complete this section again!! </h4>";   
          }
        
   
          
        ?>
                
        </div>
        <div class="text-center">
            <h1>Below are the Correct Answers</h1>
            <hr class="light">
        <?php
        // show what was correct and incorrect
       while($row = $resultquiz -> fetch_assoc()){
           
 	$correctans = $row['text'];
                             
        echo "<h2>$correctans</h2>";
           
       } 
       
       
       
        
        
        
        ?>
</div>
        <br><br>    
        
        
    <!-- Hover Extra Resources  -->

            <div class="container-fluid bg-grey">
                <div class="container-fluid text-center ">
                    <h2>More Resources</h2>
                    <br>
                    <div class="col-12 social padding social slideanim">
                        <a href="https://en-gb.facebook.com/DUMMY/"><i
                                class="fab fa-facebook "></i></a>
                        <a href="https://twitter.com/DUMMY"><i
                                class="fab fa-twitter"></i></a>
                        <a href="https://plus.google.com/DUMMY"><i
                                class="fab fa-google-plus-g"></i></a>
                        <a href="https://www.instagram.com/DUMMY/"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/user/DUMMY"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>





   <!-- PrimaryLearn Footer -->
    <footer>
        <div class="container padding">
            <div class="row">
                <div class="col-sm-6 textCr">
                    <hr class="light">
                    <p> Privacy | Cookies | Legal | ©2021 PrimaryLearn VLE. All Rights Reserved</p>
                    <a href="#myPage" title="To Top">
                        <span class="glyphicon glyphicon-chevron-up"></span></a>
                </div>
            </div>
        </div>
    </footer>    
  
  


<!-- Smooth Scrolling Animation to the footer in Javascript-->
<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
            // Make sure this.hash has a value before overriding default behavior

            if (this.hash !== "") {

                event.preventDefault();

                // Store hash
                var hash = this.hash;
                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });

        $(window).scroll(function () {
            $(".slideanim").each(function () {
                var pos = $(this).offset().top;

                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });
    })

   
</script> 
  
                       
    </body>
</html>
