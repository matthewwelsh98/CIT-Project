<?php
session_start();
//sessions
include("connection.php");

if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }  $user = $_SESSION['primarylearn'];

    
$conn->set_charset('utf8');

// Get all from maths quiz
$query = "SELECT * FROM 3047_mathsquiz";

// Get the result or else do this

$final = $conn->query($query) or die($conn->error . __LINE__);
$total = $final->num_rows;

$queryshow = "SELECT * FROM 3047_mathsquiz";


//get the user
$query3 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery2 = $conn->query($query3);

while ($row7 = $resultquery2->fetch_assoc()) {
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}

//query written to create the stars
$queryviewstars = $conn->query("SELECT * FROM 3047_star_total WHERE user_id = '$user'");
while($row1 = $queryviewstars -> fetch_assoc()){
         $points = $row1['total'];

 }
 

 //query written to show stars by user id depending on how many are unlocked
$queryreadstars = $conn->query("SELECT * FROM 3047_stars WHERE user_id = '$user'");
while($row2 = $queryreadstars -> fetch_assoc()){
         $star1 = $row2['star_one'];
          $star1grey = $row2['star_one_grey'];

          $star2 = $row2['star_two'];
           $star2grey = $row2['star_two_grey'];

          $star3 = $row2['star_three'];
          $star3grey = $row2['star_three_grey'];


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
                 
                 
 <?php if($utype == 1 || $utype == 2){echo"<li><a href='profile.php'>Parents</a></li>";
     
 
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

        <br>
        <div class="row">
        
  <div class="col-sm-12 col-md-12  col-lg-12 ">
                             <div class="text-center">
                                    <h2><span class="glyphicon glyphicon-certificate"></span>STARS</h2>
                                    <p>See below your child's stars that they have earned !</p> 
                                    <h1>You have a Total of <?php echo"<b>$points</b>";?> Star Fragments</h1>
                                   <hr class='light'>
                                    <div class="row">
                                        

                                        
                                        
                              <?php
             
                              //query is less than 5 points show this
     if($points < '5'){
             echo "
                    
                                        <div class='row text-center'>
  <div class='col-sm-4'><img src='images/$star1grey' width='120' height='120'/> <h1><p>5</p></h1></div>
  <div class='col-sm-4'><img src='images/$star2grey' width='120' height='120' /><h1><p> 10</p></h1></div>
  <div class='col-sm-4'><img src='images/$star3grey' width='120' height='120' /><h1><p> 15</p></h1></div>
</div>

                                
                                        
   
    "  ; }elseif($points == '5' OR $points < '10'){
             //between 5 and 10 points
                            
                                       echo "
                    
                                        <div class='row text-center'>
  <div class='col-sm-4'><img src='images/$star1' width='120' height='120'/> <h1><p>5</p></h1></div>
  <div class='col-sm-4'><img src='images/$star2grey' width='120' height='120' /><h1><p> 10</p></h1></div>
  <div class='col-sm-4'><img src='images/$star3grey' width='120' height='120' /><h1><p> 15</p></h1></div>
</div>

                                
                                        
   
    "  ;
                
                            
                            
                            
                            
                        //if between 10 and 15 points
             
                        }elseif($points == '10' OR $points < '15'){
             
                            
                                       echo "
                    
                                        <div class='row text-center'>
  <div class='col-sm-4'><img src='images/$star1' width='120' height='120'/> <h1><p>5</p></h1></div>
  <div class='col-sm-4'><img src='images/$star2' width='120' height='120' /><h1><p> 10</p></h1></div>
  <div class='col-sm-4'><img src='images/$star3grey' width='120' height='120' /><h1><p> 15</p></h1></div>
</div>

                                
                                        
   
    "  ;
                
                            
                            
                            //if 15 points or greater
                            
                        }elseif($points == '15' OR $points > '15'){
                        
                                                         echo "
                    
                                        <div class='row text-center'>
  <div class='col-sm-4'><img src='images/$star1' width='120' height='120'/> <h1><p>5</p></h1></div>
  <div class='col-sm-4'><img src='images/$star2' width='120' height='120' /><h1><p> 10</p></h1></div>
  <div class='col-sm-4'><img src='images/$star3' width='120' height='120' /><h1><p> 15</p></h1></div>
</div>

                                
                                        
   
    "  ;
                            
                            
                            
                            
                            
                        }
                        
             ?>
                             
                             
                             </div>   
                             
                             
                             
                             </div>
  </div></div>
                          
                    <hr class="my-4"> <br>
                                        
                                 
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
