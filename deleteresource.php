<!DOCTYPE html>
<?php
//SESSIONS
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
     echo $utype;
}



include("connection.php");
$conn ->set_charset('utf8');

$resdel = $_GET['resdelid'];
//delete resource query
$delresquery = "DELETE FROM 3047_resources WHERE id='$resdel'"; 


$delresresult = $conn -> query($delresquery);


if (!$results) {
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

 
  <div class="container">

		<div class="col-sm-12 col-md-12  col-lg-12 ">
        
                                   <div class="text-center">
                                    <h2><span class="glyphicon glyphicon-trash"></span> DELETE RESOURCES</h2>
                                    <p> Resource deleted</p>     
                                </div>
                    <hr class="my-4"> 
                    
                </div>
        
            <!-- go back button to previous page, to be a nice feature -->  
         <div id="content">
                  <div class='row text-center'>                         
                <button class='btn btn-default glyphicon glyphicon-arrow-left' onclick="goBack()"> Go Back</button>
            </div>
         
         
          <script>
         function goBack() {
           window.history.back();
         }
               </script>
         
    </body> 
        </html>
    




