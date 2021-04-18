<!DOCTYPE html>
<?php
session_start();
$_SESSION['primarylearn'];
if(!isset($_SESSION['primarylearn'])){
    //move broswer to login.php
    header("Location: index.php");
   } else {
  if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }
//    $useid = $_GET['userid']; 
//    $user = $_SESSION['primarylearn'];
    // echo $utype;
}



include ('connection.php');
$conn ->set_charset('utf8');


$userquery = "SELECT * FROM 3047_subjects";
$uqueryresult = $conn->query($userquery);

$query1 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";
$uqueryresult1 = $conn->query($query1);

while($row7 = $uqueryresult1->fetch_assoc()){
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}

if(!$uqueryresult1){
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
    
        
        
              
<div class="container">
        
       
		<div class="col-sm-12 col-md-12  col-lg-12 ">
        
                                   
                           <center>         <h2>Primary 3 Let's Learn in Lockdown!</h2> </center>
                            <center>   <img src="images/tutor_learning.jpg" alt=""/>  </center>
          
                                
                    <hr class="my-4"> <br>
                                        
                  
                                </div>
             
                 <?php  
                    
                       
                 while($row = $uqueryresult->fetch_assoc()){
                    $subjectid = $row['id'];
                    $subject = $row['subject'];
                    $description = $row['descript'];
                    $sub_img = $row['img'];
                    
                    
             echo"
         
             <div class='container col-sm-12 col-md-6  col-lg-3 '>
              <div class='panel panel-default text-center'>
                <div class='panel-heading'>
                    <img src='images/$sub_img' width='60' height='60'>
                </div>
                <div class='panel-body'>
                 <h4>$description</h4>
                </div>
                <div class='panel-footer'>
               <a href='viewsubject.php?subid=$subjectid'><button class='btn btn-warning'>Click Subject!</button>
                </div>
                </div>      
            </div></a><br><br>";
                 }
                
       
                 ?>
              
              
</div>
       
            
            
            
            <!-- Hover Extra Resources  -->
            <footer>
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





   <!-- Footer -->
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
  
  

<!-- This is script that adds smooth scrolling and the slide animation to the VLE -->
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
    });

   
</script> 
  
                       
    </body>
</html>
