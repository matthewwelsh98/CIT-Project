<?php
//SESSIONS
include("connection.php");
session_start();
//session variable
if(!isset($_SESSION['primarylearn'])){
    //move broswer to login.php
    header("Location: index.php");
}else{
    if (isset($_SESSION['primarylearn'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }

 $subid = htmlentities($_GET['subid']);
}


//QUERY to get resource id
$resourcequery = "SELECT * FROM 3047_subjects";
$query = $conn->query($resourcequery);

if(!$query){
    echo $conn->error;
}

$resquery = "SELECT * FROM 3047_resources";

$queryresult = $conn->query($resquery);

//query check
if(!$queryresult){
    echo $conn->error;
}
// query to get the user id 
$query1 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";
$resultquery = $conn->query($query1);

while($row7 = $resultquery->fetch_assoc()){
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
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
            </div>
    </nav>

        <br><br><br><br>
    
        
         <div class="container">

		<div class="col-sm-12 col-md-12  col-lg-12 ">
        
                                   <div class="text-center">
                                    <h2><span class="glyphicon glyphicon-list-alt"></span> Extremely Useful Resources Here</h2>
                                    <p>Select what you would like to do below!</p>     
                                </div>
                    <hr class="my-4"> <br>
                                        
                                  
                                </div>
        
        <div class='container text-center'> 

            <div id="content" style="">
                
                 <?php
            
      // if a teacher show the file uploads for resources and assessments
            if($utype == 3){
                
             
             while($row3 = $queryresult->fetch_assoc()){
                 $file = $row3['resource_path'];
                 $res_id = $row3['id'];

                 
                 echo  "<div style='margin-left:40%;'> <a href='resfiles/$file'><span class='glyphicon glyphicon-file height=50px'>$file</span></a><a href='deleteresource.php?resdelid=$res_id'><strong> Delete </a> </strong></div>";

                   }
                
                   
                   
                    echo "<div class='col-sm-12 col-md-12  col-lg-12 '>
                        
                        <div class='row text-center'>
                            <hr class'my-4'>	
                            <div class='card large'>
                                <a href='uploadassessment.php?resourcetypeid=$subid'>
                                    <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-upload'></span> Upload Assessment </h4>
                                        <p>Upload an assessment for your students to take!</p>

                                    </div>
                                </a>      
                            </div>
           
                        </div>
                    </div>
            
            ";
                    
                    
       echo " <div class='col-sm-12 col-md-12  col-lg-12 '>
                        
                        <div class='row text-center'>
                            <hr class'my-4'>	
                            <div class='card large'>
                                <a href='uploadresources.php?resourceid=$subid'>
                                    <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-file'></span>Upload Resources </h4>
                                        <p>Upload resources for your students!</p>

                                    </div>
                                </a>      
                            </div>
                 
                        </div>
                    </div>
            ";    
       
       
         echo " <div class='col-sm-12 col-md-12  col-lg-12 '>
                        
                        <div class='row text-center'>
                            <hr class'my-4'>	
                            <div class='card large'>
                                <a href='mystudents.php?classlist=$subid'>
                                    <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-user'></span> Class List </h4>
                                        <p>View the class list!</p>

                                    </div>
                                </a>      
                            </div>
                            <hr class='my-4'>


                        </div>
                    </div>
            ";    
       
         
         }else{
                //else if a student or parent show the resources
             while($row3 = $queryresult->fetch_assoc()){
                 $file = $row3['resource_path'];

                 
                    echo "
                    <div class='row'> <a href='resfiles/$file'><span class='glyphicon glyphicon-file height=50px'>$file</span></a><span class='glyphicon glyphicon-ok'></span><hr class='light'> </div>";               
               
             }
                
                
                
            }
       
                     ?>

                <br>
               
                 <div class='row text-center'>                         
                <button class='btn btn-default glyphicon glyphicon-arrow-left' onclick="goBack()"> Go Back</button>
            </div>
       
        </div>
            </div>
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

       