<?php
//SESSIONS
session_start();
include("connection.php");

if(!isset($_SESSION['primarylearn'])){
    //move broswer to login.php
    header("Location: index.php");
}else {
if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
}
}


include("connection.php");

$delann = $_GET['delann'];
//Delete announcement query
$dequery = "SELECT * FROM 3047_announcement WHERE subject_id = $delann ";
$deresult = $conn->query($dequery);
// query to get the user id        
$query7 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery2 = $conn->query($query7);

while($row7 = $resultquery2->fetch_assoc()){
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
    </nav>

        <br><br><br><br>

        
          <div class='container'> 

          <h2>Delete an announcement here!</h2>
            <div id="content">
               	
           
    
                
                
         <div class="row">  
           
          <div class="nine columns"> 
            
                          
               <form <?php echo "action='deleteannouncement.php?delann=$delann'"; ?>method="POST">
                   <div class="row">
                       
                       
                           <select name="ann">  
                   
                       <?php
                       //call the db table and delete it
                       
                       while($row = $deresult->fetch_assoc()){
                            $annid = $row['id'];
                            $ann_comm = $row['comment'];
                            
                            
                            echo "<option value='$annid'>$ann_comm</option>";
                            }      
                            
                            ?>
                
                   </select>
                       
                       
                          <!-- PrimaryLearn Footer -->
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
    });

   
</script> 