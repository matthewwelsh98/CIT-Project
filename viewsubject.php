<!DOCTYPE html>
<?php
//sessions
session_start();

$_SESSION['primarylearn'];
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

include ('connection.php');
$conn ->set_charset('utf8');
//get the subject id
$query1 = "SELECT * FROM 3047_subjects WHERE id= '$subid'";

$result = $conn->query($query1);
//query subject resource
$query2 = "SELECT * FROM 3047_subjectresource";

$result2 = $conn->query($query2);
//query subject assessment
$assessquery = "SELECT * FROM 3047_subjectassess";
$assresult = $conn->query($assessquery);
//get the id
$query7 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";


$resultquery2 = $conn->query($query7);

while($row7 = $resultquery2->fetch_assoc()){
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}

//if result is right if not error
if(!$result){
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

        <br><br>
        
        
        
        <div class="container">

		<div class="col-sm-12 col-md-12  col-lg-12 ">
        <!-- subjects welcome -->
                                   <div class="text-center">
                                    <h1>Welcome to your subjects!</h1>
                                  
                                    
                                </div>
                    
                    <center>   <img src="images/childrens_lessons.jpg" alt=""/>  </center>
                    
                    <hr class="my-4"> <br>
                                        
                  
                                </div>
             
        
        
        <?php   
                    
               //while loop from subjects table        
                 while($row = $result->fetch_assoc()){  //grabs the data
                    $subjectid = $row['id'];
                    $subject = $row['subject'];
                    $description = $row['descript'];
                    $sub_img = $row['img'];
                    
                    
     


		  
	echo "<div class='answer text-center'>
			<div class='sm style='text-align: center''><strong><h1></strong>$subject</h1></div>
			<div class='sm style='text-align: center''><strong><h1>$description</h1><br><br></div>
		  </div>";
                 
       
        
                 
                 
        //show resources type
                 
      while($row = $result2->fetch_assoc()){
        $subresourceid= $row["id"]; 
	$subjectresource_type= $row["type"]; 
        
        if ($subresourceid > 1){
            echo " <div class='row text-center'>
         
                      <hr class='my-4'>	
      			<div class='card large'>
                            <a href='resources.php?subid=$subresourceid'<div class=''><h4><span class='glyphicon glyphicon-folder-open'></span> $subjectresource_type</h4>
					<div class='section'>
                                            
                                            <p>Click to see downloaded resources for this subject!</p> 
                                               
					</div>
                                          </a>
  				</div>
                  
            </div>    
            
        ";
                 
            
            //else then do this
              }else{
             echo " <div class='row text-center'>
    
      			     <hr class='my-4'>	
      			<div class='card large'>
                            <a href='announcement.php?announcesubid=$subresourceid'<div class=''><h4><span class='glyphicon glyphicon-volume-up'></span>$subjectresource_type</h4>
					<div class='section'>
                                            
                                            <p>Click to see subject announcements!</p> 
                                               
					</div>
                                      </a>    
  				</div>
                  
            </div>    
            
            ";    
            
         
        }// closing else loop
                }//end of loop
                
              
                 }
               
                
?>
        
        
        
         <div class="container">
                    <?php
                    while($row4 = $assresult->fetch_assoc()){
                        $subjectassessmentid = $row4['id'];
                        $assesssubid = $row4['subject_id'];
                        
                    }
                          
                    //if user is a teacher then show this
                     if($utype == 3){
       
         echo" <div class='col-sm-12 col-md-12  col-lg-12 '>
                        
                        <div class='row text-center'>
                            <hr class'my-4'>	
                            <div class='card large'>
                                <a href='assessment.php?subid=$subid'>
                                    <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-book'></span> Assessments</h4>
                                        <p>View your assessments for this subject here!</p>

                                    </div>
                                </a>      
                            </div>
                            <hr class='my-4'>


                        </div>
                    </div>
               ";
        
        //if user is a student or parent then show this
        
         }elseif($utype == 1 || $utype == 2){
  
         echo" <div class='col-sm-12 col-md-12  col-lg-12 '>
                        
                        <div class='row text-center'>
                            <hr class'my-4'>	
                            <div class='card large'>
                                <a href='assessment.php?subid=$subid'>
                                    <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-book'></span> Assessments</h4>
                                        <p>View your assessments for this subject here!</p>

                                    </div>
                                </a>      
                            </div>
                            <hr class='my-4'>


                        </div>
                    </div>
               ";      
                           
                           
                           
                      }
          //subject one
                      if($subid == 1){
                      
             echo" <div class='col-sm-12 col-md-12  col-lg-12 '>
                              
                        <div class='row text-center'> ";
          
                              echo "<div class='card large'>
                                <a href='mathsquiz.php'>";
         
                           
                               echo"     <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-pencil'></span>  Quiz </h4>
                                        <p>Test Your Knowledge and Take the Maths Quiz to earn trophies!</p>

                                    </div>
                                </a>      
                            </div>
                            <hr class='my-4'>

<br>
                        </div>
                    </div> 
                    
             ";
                          
                            //subject 2   
                               
                          }elseif($subid ==2){      
                               
                               echo" <div class='col-sm-12 col-md-12  col-lg-12 '>
                              
                        <div class='row text-center'> ";
          
                              echo "<div class='card large'>
                                <a href='englishquiz.php'>";
         
                           
                               echo"     <div class='section'>
                                        <h4>   <span class='glyphicon glyphicon-pencil'></span>  Quiz </h4>
                                        <p>Test Your Knowledge and Take the English Quiz to earn trophies!</p>

                                    </div>
                                </a>      
                            </div>
                            <hr class='my-4'>

<br>
                        </div>
                    </div> 
                    
             ";
                               
                                    
                          }             
                               
                               
                               
                               ?>
                    
                    
                
                      

             <div id="content">
                  <div class='row text-center'>                         
                <button class='btn btn-default glyphicon glyphicon-arrow-left' onclick="goBack()"> Go Back</button>
            </div>
       
        </div>
            </div>
        </div>
        </div>
        
        <br>
        <br>
             
        
        
    
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
  
 
  <script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>





</body>
</html>