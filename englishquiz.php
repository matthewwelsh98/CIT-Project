<?php
//SESSIONS
session_start();
include ('connection.php');
$utype = $_SESSION['primarylearnutype'];
$conn ->set_charset('utf8');

// query and select all from the english quiz
$query = "SELECT * FROM 3047_englishquiz ";

$result = $conn->query($query);

$query3 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery2 = $conn->query($query3);

while ($row7 = $resultquery2->fetch_assoc()) {
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}


if (!$result) {
    echo $conn->error;
}

$total = $result->num_rows;


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

        <br><br><br><br>
        
        
      <center><img src="images/spelling_bee.jpg" width='100' height='140'/></center> 
        

<?php
 
// If the user is a teacher allow them to see the quiz, add questions and delete questions to the quiz. 
            if ($utype == 3) {

                echo "   <div class='container text-center'>

                <div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-search'></span> QUIZ</h2>
                        <p> View, Add and Delete Quiz Questions below !   </p>     
                    </div>
                    <hr class='my-4'> <br>

                </div>
            </div>
            <div class='container text-center'>
                <div class='col-sm-12 col-md-12  col-lg-12 '>
                    <p>This is a multiple choice quiz to test your knowledge on numerous topics within your course</p>
                    <ui>

                        <li><strong> Number of Questions: </strong>$total </li>
                        <li><strong> Type: </strong> Multiple Choice </li>";
                ?>
            <li><strong> Estimated Time: </strong> <?php echo $total * .5; //one question will roughly take this amount of time   ?> Minutes </li> <br>
        </ui>
        <?php
        echo "  <a href='englishquizquestions.php?n=1'><button class='btn btn-warning'>View Quiz</button>  </a>         
                    <br><br>

                </div>
</div>";
        
        // add more questions to this quiz
        
 echo "<div class='container'>
        
                <div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h4><span class='glyphicon glyphicon-plus'></span> Add Questions</h4>
                        <p> Add more questions to the English quiz !   </p>     
                    
                    <hr class='my-4'> <br>

            
            <a href='englishaddquestions.php'><button class='btn btn-success'>Insert Questions</button>  </a>        
</div>
                </div>
            </div>
            <br><br>
                ";

 
         // then delete these questions
 
   echo "<div class='container'>
        
                <div class='col-sm-12 col-md-12  col-lg-12 '>

                    <div class='text-center'>
                        <h4><span class='glyphicon glyphicon-trash'></span> Delete Questions</h4>
                        <p> Delete questions from the English quiz !   </p>     
                    
                    <hr class='my-4'> <br>

            
            <a href='englishdeletequestions.php'><button class='btn btn-danger'>Delete Questions</button>  </a>        
</div>
                </div>
            </div>
            <br><br><br>
                ";
            }
?>

        
        

        
                   <?php
// If the user is a student or parent, only show the quiz questions and answers.  
            if ($utype == 2 || $utype == 1) {
                
            
             echo "   <div class='container text-center'

                <div class='col-sm-5 col-md-5  col-lg-5 '>

                    <div class='text-center'>
                        <h2><span class='glyphicon glyphicon-pencil'></span> QUIZ</h2>
                        <p> Let's learn some english spelling! </p>     
                    </div>
                    <hr class='my-4'> <br>

                </div>
            </div>
            <div class='container text-center'>
                <div class='col-sm-12 col-md-12  col-lg-12 '>
                    <p>Welcome this is the fun english quiz!</p>
                    <ui>

                        <li><strong> Questions: </strong>$total </li>
                        <li><strong> Multiple Choice Questions: </strong></li>";
                ?>
            <li><strong> This should take you: </strong> <?php echo $total * .5; //one question will roughly take this amount of time    ?> Minutes </li> <br>
        </ui>
        <?php
        echo "  <a href='englishquizquestions.php?n=1'><button class='btn btn-success'>Let's go!</button>  </a>         
                    <br><br>

                </div>
</div>";

       
                

            }        

            ?>

    
    
    
    
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



   <!-- PrimayLearn Footer -->
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
