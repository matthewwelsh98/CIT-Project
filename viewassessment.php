<?php
//sessions
session_start();
include("connection.php");

if (!isset($_SESSION['primarylearn'])) {
    //move broswer to login.php
    header("Location: index.php");
}else {
  if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }
     echo $utype;
}

//get the assessment id
$ass = htmlentities($_GET['assessmentid']);
$single_read = "SELECT * FROM 3047_assessment WHERE 3047_assessment.id = $ass";
//assessment get the id
$ass = $_GET['assessmentid'];

$getresult = $conn->query($single_read);

if (!$getresult) {
    echo $conn->error;
}


//result query the database to post the assessment
$resquery = "SELECT DISTINCT 3047_ass_file.assessment_file "
        . "FROM 3047_ass_file "
        . "JOIN 3047_assessment "
        . "ON 3047_ass_file.assessment_id = 3047_assessment.id "
        . "WHERE 3047_assessment.subject_id = 1 "
        . "AND 3047_assessment.id = $ass";

$queryresult = $conn->query($resquery);

//query check
if(!$queryresult){
    echo $conn->error;
}
//while loop the data
while ($row = $getresult->fetch_assoc()) {
    $titledata = $row["title"];
    $subject_id = $row["subject_id"];
    $descript = $row["description"];
    $deadlinedate = $row['deadline_date'];
    $fileass = $row['ass_file'];
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
             
                <a  href="index.php" title="Primary Learn"><h1>Primary Learn | VLE </h1></a>
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

        
            <div class="jumbotron jumbotron-fluid">
                <div class="container"

                     <h1 class="display-4">Welcome to your assessments</h1>
                    <p class="lead">See Assessment details below and click to download the file.</p>
                </div>
            </div>

            <div class="container-fluid bg-3 text-center">
                <div class="row">

                    <h1>View Your Assessments Below</h1>

                    
                    
                    <?php
                    
                    //view the assessments here
                    
                    echo "<div class='row'>
                       
			<div class=$subject_id</div>
                        <h2> assessment title: $titledata</h2>    
			<h2> deadline date: $deadlinedate</h2>
			<p> description of assessment: $descript</p>
                        <a href='resfiles/$fileass'> file: $fileass </a>
                            
		  </div>";


      $selectimages = "SELECT * FROM 3047_ass_file where subject_id = $subid";

      $imageresult = $conn -> query($selectimages);
        
         while($rowimg = $queryresult->fetch_assoc()){
            
            $fileass = $rowimg['assessment_file'];
        
            
             echo "<div class='row'> <a href='resfiles/$fileass'><span class='glyphicon glyphicon-file height=50px'>$fileass</span></a> </div>";
            
            
        }
       
        
        ?>

                                </div>
        </div>  
        
        
        
        
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

        
