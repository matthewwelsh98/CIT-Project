<?php
//SESSIONS
session_start();

if(!isset($_SESSION['primarylearn'])){
    //move broswer to login.php
    header("Location: index.php");
} else {
    if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }
}

include("connection.php");
// QUERY TO GET ID
$query = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";
$resultquery = $conn->query($query);

$resultquery2 = $conn->query($query);
//select the trophies
$trophyquery = "SELECT * FROM 3047_trophies";
$trophyqueryresult = $conn->query($trophyquery);

if(!$trophyqueryresult){
    echo $conn->error;
}

while($row7 = $resultquery2->fetch_assoc()){
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}



if(!$resultquery){
    echo $conn->error;
}

?>


<html
    
     lang="en"
    <head>

        <!-- My Web Theme   -->
        <title>Primary Learn</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        
     <!--- NAVIGATION -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                
             
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

    <br><br><br>
    

    <!-- profile details for the child -->
    <div class="col-sm-12 col-md-12  col-lg-12 ">
                             <div class="text-center">
                                    <h2><span class="glyphicon glyphicon-user"></span> PROFILE</h2>
                                    <p>See your child's profile details below!</p>     
                                </div>
                          
                    <hr class="my-4"> <br>
                                        
                                 
                                </div>
    
   
         
        <div class="container-fluid bg-3 text-center">
            <div class="row">


               <?php
               //call the user information
                 while($row = $resultquery->fetch_assoc()){
                    $name = $row['username'];
                    $email = $row['email'];
                    $passw = $row['password'];
                    $userimg = $row["profile_pic"];
                   
                    }
      
             echo "<div class='col-sm-4'></div>
                 <div class='row col-sm-4'>
                    <form class='form-horizontal' method='POST' action='profile.php' enctype='multipart/form-data'>
                         <div class='form-group'>
                          <label class='control-label col-sm-2' for='name'>Name:</label>
                     <div class='col-sm-10'>
                      <input type='text' class='form-control' id='name' name='uname'  value='$name'>
                     </div>
                 </div>
                 <div class='form-group'>
                          <label class='control-label col-sm-2' for='email'>Email:</label>
                     <div class='col-sm-10'>
                      <input type='email' class='form-control' id='email' name='email'  value='$email'>
                     </div>
                 </div>
                 <div class='form-group'>
                          <label class='control-label col-sm-2' for='imageupload'>Profile Pic: <br></label>
                     <div class='col-sm-10'> <div class='thumbnail'>
                     <img src='images/$userimg'/>
                      <input type='file' name='profilepic' class='form-control'>
                     </div>
                 </div></div>
                
                  <div class='form-group'>        
                     <div class='col-sm-offset-2 col-sm-10'>
                     <button type='submit' name='submit' class='btn btn-default'Submit>Save</button>
                   </div>
                  </div>
                  <div class='form-group'>        
                     <div class='col-sm-offset-2 col-sm-10'>
                     <a href='updatepassword.php'<button type='submit' name='passwordchange' class='btn btn-default'Submit>Change password</button></a>
                   </div>
                  </div>
                  
               </form>
               </div>
               
               
               <div class='col-sm-4'></div>";
   
                ?>
                
                
                <?php
                
                // show the trophy image
                 while($row = $trophyqueryresult->fetch_assoc()){
                    $seetrophy = $row["image_URL"];
                   
                    }
                    
                    echo "    <div class='form-group'>        
                     <div class='col-sm-offset-2 col-sm-10'>
                   
                   </div>
                   

     <div class='form-group'>        
                     <div class='col-sm-offset-2 col-sm-10'>
                    
                   </div>
 


                  " ;     
                    
                    ?>
  
                  <?php    
                  
                  //profile being editable
                  
                  if(isset($_POST['submit'])){
                     echo "<meta http-equiv='refresh' content='0'/>";
       
                     
                     
                     $name = htmlspecialchars($_POST['uname']);
                     $email = htmlspecialchars($_POST['email']);

                    
                    $filename = $_FILES['profilepic']['name'];
                    $filetemp = $_FILES['profilepic']['tmp_name'];
                                 
                    move_uploaded_file($filetemp, 'images/'.$filename);
                    
                    
                    if(empty($filename)){
                     $updatequery = "UPDATE 3047_user SET username='$name', email='$email' WHERE id = {$_SESSION['primarylearn']}";
                     $updateresult = $conn->query($updatequery);
                     
                     
                     if(!$updateresult){
                         echo $conn->error;
                     }
                     
                    }else{
                        $imgupdate = "UPDATE 3047_user SET username='$name', email='$email', profile_pic = '$filename' WHERE id = {$_SESSION['primarylearn']}";
                        $imgresult = $conn->query($imgupdate);
                        
                        if(!$imgresult){
                            echo $conn->error;
                        }
                    }
                 }
                  
                  

                    ?>
          
            </div></div>
    
      <div class="col-sm-12 col-md-12  col-lg-12 ">
                             <div class="text-center">
                                 <hr class="light">
                                    <h2><span class="glyphicon glyphicon-badge"></span> Rewards</h2>
                                    <p>See your child's Rewards details below!</p>     
                                </div>
                          
                   <br>
                                        
                                 
                                </div>
    
       <div class='row'>
  <div class='col-sm-4'></div>
  <div class='col-sm-4'>  <a href='stars.php'<button type='submit' name='badges' class='btn btn-default'Submit>Stars</button></a>
  
      <a href='trophiespage.php'<button type='submit' name='badges' class='btn btn-default'Submit>Trophies</button></a>

  </div>
  



  <div class='col-sm-4'></div>
</div> <hr class="my-4"> 
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
