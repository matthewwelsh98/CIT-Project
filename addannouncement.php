<?php
// SESSIONS
session_start();
include("connection.php");
if(!isset($_SESSION['primarylearn'])){
     //move broswer to login.php
    header("Location: index.php");
}else{
 if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
}
}

//announcement query
$query = "SELECT * FROM 3047_announcement INNER JOIN 3047_subjects ON 3047_subjects.id= 3047_announcement.subject_id";
//get the result
$result = $conn->query($query);

if(!$result){
    echo $conn->error;
}

//query for userid in the system
$query7 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

//resultquery
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

          <h2>Post an announcement here for your students!</h2>
            <div id="content">
               	

         <div class="row">

           <!-- javascript for the form -->  
             <script>
 function validateForm() {
   var x = document.forms["announceform"]["comment"].value;
   if (x == "") {
     alert("Form not complete!");
     return false;
   }
   
   var r = document.forms["announceform"]["module"].value;
   if (r == "") {
     alert("Form not complete!");
     return false;
   }
   
   
 }
             </script>
             
             
                                
               <form action="addannouncement.php" onsubmit="return validateForm()" name='announceform'  method="POST">
                   <div class="row">
                       <div class="co1">
                           <input type="text" class="form-control" name="comment"  placeholder="Add an annoucement" required>
                       </div>
                       <p> SUBJECT: </p>
                       <select name='subject' required/>
                       
                 <?php
                //query to add announcements
                 
                 $options = "SELECT DISTINCT * FROM 3047_subjects INNER JOIN 3047_usersubjunc ON 3047_subjects.id = 3047_usersubjunc.subject_id INNER JOIN 3047_user ON 3047_usersubjunc.user_id = 3047_user.id WHERE 3047_user.id={$_SESSION['primarylearn']}";
                       
                    $result_add = $conn->query($options);
                              
                     while($row = $result_add->fetch_assoc()){
                         $post_id = $row['subject_id'];
                         $post_name = $row['subject'];
                         
                        echo "<option value='$post_id'>$post_name</option>";
                              
                     }
                 
                 ?>
                   </select>
                       
                       <button class='btn btn-success glyphicon' type='submit' name='insert'>Post Announcement</button>           
                  
                   </div>
               </form>
             
         <?php
               
               if(isset($_POST['insert'])){
                   $post_comment = stripslashes($conn->real_escape_string($_POST['comment']));
                   $post_subid = $conn->real_escape_string($_POST['subject']);
               
                   
                   $insertquery = "INSERT INTO 3047_announcement (comment, subject_id) VALUES ('$post_comment', '$post_subid')";
                   
                   $resultinsert = $conn->query($insertquery);
            
                   if(!$resultinsert){
                     echo "<p>Annoucement has not added</p>";
                   }else{
                       echo "New Announcement has been added!";
                   }
                   
               }
               
               ?>
                   
             
             
                <div class='row text-center'>                         
                <button class='btn btn-default glyphicon glyphicon-arrow-left' onclick="goBack()"> Go Back</button>
            </div>
</div>
            </div></div>
            
          <br>
     <br>
     <br> 
 

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
              
                       