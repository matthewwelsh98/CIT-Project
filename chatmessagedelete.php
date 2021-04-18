<?php
//SESSIONS
session_start();

include("connection.php");
$conn ->set_charset('utf8');

if(!isset($_SESSION['primarylearn'])){
    //move broswer to login.php
    header("Location: index.php");
} else {
    if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
   
    }
    if (isset($_SESSION['primarylearnusername'])) {
        $uname = $_SESSION['primarylearnusername'];
    }
}

// query to get the delete id and then delete from the DB
$delete_id = $_GET["delete_id"];

$deletequery = "DELETE FROM 3047_chatdiscussion WHERE id='$delete_id'" ;

$results = $conn -> query($deletequery);

   
if (!$results) {
    echo $conn->error;
}

// query to get user id
$query1 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery1 = $conn->query($query1);


while($row7 = $resultquery1->fetch_assoc()){
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
    <body>

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

                    <div class="text-center">
                        <h2><span class="glyphicon glyphicon-comment"></span> Message</h2>
                        <p> Communicate and Send Messages to Students   </p>     
                    </div>
                    <hr class="my-4"> <br>


                </div>

                <br><br><br><br>
                
                
                
  <div class="container">

        <!-- delete the chat message -->

        <div class="alert alert-success text-center">
           
                <h2> <span class='glyphicon glyphicon-ok'></span><strong> Delete Success!</strong></h2>
                <p>Message has been Deleted!</p><br>
            
       
         <a href='chat.php'<button class='btn btn-success' type='submit'> Finish</button></a>
     </div>
     </div>
            


       
        
         
    </body> 
        </html>