<?php
// forgot password
include("connection.php");

$forgotquery = "SELECT * FROM 3047_user";
$forgotresult = $conn->query($forgotquery);

if(!$forgotresult){
    echo $conn->error;
}

?>
<!DOCTYPE html>


    
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
                 
                 

                 </div>
            </div>
    </nav>

        <br>

             </nav>

    <br>

       <div class="container">
           
		<div class="col-sm-12 col-md-12  col-lg-12 ">
                             <div class="text-center">
                                    <h2><span class="glyphicon glyphicon-wrench"></span> Forgot your Password ? </h2>
                                    <p>Recover your password here!</p>     
                          
                    <hr class="my-4"> <br>
                                        
                                 
                                
       
        
  <div class="container-fluid bg-3 text-center">
            <div class="row">
                <?php
                
                // forget password if set to this and select username
                
                if(isset($_GET['code'])){
    $get_username = $conn->real_escape_string($_GET['username']);
    $get_code = $conn->real_escape_string($_GET['code']);
    
    $query = "SELECT * FROM 3047_user WHERE username ='$get_username'";
    $getresult = $conn->query($query);
    
    while($row4 = $getresult->fetch_assoc()){
        $db_code = $row4['passreset'];
        $db_username = $row4['username'];
    }
    if($get_username == $db_username && $get_code == $db_code){
        echo "<div class='col-sm-4'></div>
                <div class='col-sm-4'>
              <form action='passresetfinish.php?code=$get_code' method = 'POST'>
              Enter a new password:<br><input type='password' name='newpass'><br>
              Re-enter password:<br><input type='password' name='newpass1'><br>
              <input type='hidden' name='username' value='$db_username'>
              <input type='submit' value='Reset Password'>
              </form>
              </div>
                <div class='col-sm-4'></div>";  

    }
    
}    
            
                ?>
                
                
                
                
         <?php
         
         // if empty then do this and select
    
    if(empty($_GET['code'])){
        
             echo  "<div class='col-sm-4'></div>
                 <div class='row col-sm-4'>
                     <form class='form-horizontal' method='POST' action='forgetpassword.php' enctype='multipart/form-data'>
                         <div class='form-group'>
                          <label class='control-label col-sm-5' for='name'>Username: </label>
                     <div class='col-sm-10'>
                      <input type='text' class='form-control' name='username'>
                     </div>
                 </div>
                         <div class='form-group'>
                      <label class='control-label col-sm-3' for='name'>Email: </label>
                     <div class='col-sm-10'>
                      <input type='email' class='form-control' id='name' name='email'>
                     </div>
                 </div>
                       <div class='form-group'>        
                     <div class='col-sm-offset-2 col-sm-3'>
                     <button type='submit' name='submit' class='btn btn-default'Submit>Submit</button>
                   </div>
                  </div>
                     </form>
            </div>
             <div class='col-sm-4'></div>";
                  ?>
                
       
                    <?php
                    
                    // if is set string to post 
                    
               if (isset($_POST['submit'])){
                   $uname = $conn->real_escape_string($_POST['username']);             
                   $email = $conn->real_escape_string($_POST['email']);
                   
                    $forquery = "SELECT * FROM 3047_user WHERE username = '$uname'";
                    $forres = $conn->query($forquery);
                   
                     $num = $forres->num_rows;
                     
                      if($num > 0){
                       while($rowres = $forres->fetch_assoc()){
                           $db_email = $rowres['email'];
                       } 
                       if($email == $db_email){
                           $code = rand(10000,1000000);
                   
                           $to = $db_email;
                           $subject = "Password Reset";
                           $body = "This is an automated email. Click the link to reset password. http://mwelsh04.web.eeecs.qub.ac.uk/PrimayLearn/forgetpassword.php?code=$code&username=$uname";    
                           
                            $resetquery = "UPDATE 3047_user SET passreset = '$code' WHERE username ='$uname' ";
                           $resertresult = $conn->query($resetquery);  
                           
                          mail($to,$subject,$body);
                          echo "<div class='col-sm-4'></div>"
                          . "<div class='col-sm-4'>"
                          . "Password Reset link has been sent to your email!"
                                  . "</div>"
                                  . "<div class='col-sm-4'></div>";
                           
                       }   
           }else{
                        echo "<h4><span class='glyphicon glyphicon-user'></span> The username does not exist, Try Again !</h4>";
                    }
                       
               }         
                       
     }// end of loop
               
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
    })

   
</script>         
        
        
    </body>
 
</html>