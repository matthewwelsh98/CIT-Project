<?php
session_start();
//SESSIONS
if (!isset($_SESSION['primarylearn'])) {
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
//GET RESOURCE TYPE ID
$subid = $_GET['resourcetypeid'];
echo $subid;
//QUERY THE SUBJECTS
$query = "SELECT * FROM 3047_subjects";
$result = $conn->query($query);

if (!$result) {
    echo $conn->error;
}

//GET ALL FROM ASSESSMENTS
$queryass = "SELECT * FROM 3047_assessment";
$result2 = $conn->query($queryass);

if (!$result2) {
    echo $conn->error;
}

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
             
                <a  href="index.php" title="OvO Learning"><h1>Primary Learn | VLE </h1></a>
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
        <!-- UPLOAD THE ASSESSMEN-->
                                   <div class="text-center">
                                    <h2><span class="glyphicon glyphicon-upload"></span> Upload Assessment</h2>
                                    <p>Upload for your student!</p>     
                                </div>
                    <hr class="my-4"> <br>
                                        
                                  
                                </div>

                
                    <hr class="my-4"> <br>
                </div>
            <div style="margin-left:40%">
                <form method="POST"  enctype="multipart/form-data">
                        <p> assessment title: <input name="title" type="text" required /></p>

                        <p> description: <input name="description" name="text" required/></p>     

                        <p> deadline date: <input name="deadline_date" name="bday" required/></p>

                        <p>upload file: <input name="uploads"  type="file" multiple /></p>

                        <p><input type="submit" value="create assessment" name="create"/></p>

                <?php echo        "<a class='btn btn-primary' href='assessment.php?subid=$subid' role='button'>View Assessments Uploaded</a>" ; ?> 

                    </form>
            
            </div>
            
              <?php
              
              //GRAB DETAILS FROM THE ASSESSMENT
                    if (isset($_POST['create'])) {

                   $asstitle = stripslashes($conn->real_escape_string($_POST['title']));
                   
                   $assdescript = stripslashes($conn->real_escape_string($_POST['description']));

                   $assdead_date = stripslashes($conn->real_escape_string($_POST['deadline_date']));
                   
                   
                   
                    
                        //  for($i=0 ; $i < $totalfiles; $i++){
                                $ran = rand();
                         $tmploc = $_FILES['uploads']['tmp_name'];
                         $filenameres = $_FILES['uploads']['name'];
                         
                            move_uploaded_file($tmploc, "resfiles/".$filenameres);
                         
                      //if(empty($filenameres)){
                          
                      
                   
                   $insertsql = "INSERT into 3047_assessment(title, subject_id, description, deadline_date, ass_file) VALUES ('$asstitle', '$subid', '$assdescript', '$assdead_date', '$filenameres')";
                   
                   
                          $insertresult = $conn->query($insertsql); 
                          
                          if(!$insertresult){
                              echo $conn->error;
                          }

                     
                      
                        $last_id = $conn->insert_id;

                        if (!$insertresult) {

                            echo $conn->error;
                        } else {

                            echo "<h2>Assessment added for download</h2>";
                        }
                        
                     //   $totalfiles = count($_FILES['uploads']['name']);


  //if ($totalfiles > 0) {

                          //  for ($i = 0; $i < $totalfiles; $i++) {
                           //     $ran = rand();
//                           //     $tmploc = $_FILES['uploads']['tmp_name'];
//                                $filename = $_FILES['uploads']['name'];
//
//                                move_uploaded_file($tmploc,  "resfiles/".$filename);
//
//                                $insertimg = "INSERT INTO 3047_resources (resource_path, subject_id) VALUES ('$filename','$subid')";
//                                  $imgresult = $conn->query($insertimg);
//
//                                if (!$imgresult) {
//                                    echo $conn->error;
                                }
//                            //end of loop
//                        }//end of file number check
//                    //post-back create button   
             ?>


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

       