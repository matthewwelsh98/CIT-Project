<!DOCTYPE html>

<?php
//SESSIONS
session_start();
if (!isset($_SESSION['primarylearn'])) {
    //move broswer to login.php
    header("Location: index.php");
} else {
    $user = $_SESSION['primarylearnutype'];
}if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }
    

include("connection.php");
$conn->set_charset('utf8');

//query to get the user and display in navigation bar
$query3 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery2 = $conn->query($query3);
// display in navigation bar
while ($row7 = $resultquery2->fetch_assoc()) {
    $userimg = $row7["profile_pic"];
    $useremail = $row7["email"];
}

if (isset($_POST['submit'])) {

       // get the variables
    $question_number = $_POST['question_number'];
    $question_text = htmlspecialchars($_POST['question_text']);
    $correct_choice = $_POST['correct_choice'];


      //this is the choices array. will display the choices within this quiz
    $choices = array();
    $choices[1] = htmlspecialchars($_POST['choice1']);
    $choices[2] = htmlspecialchars($_POST['choice2']);
    $choices[3] = htmlspecialchars($_POST['choice3']);
    $choices[4] = htmlspecialchars($_POST['choice4']);
    $choices[5] = htmlspecialchars($_POST['choice5']);
    
   
     // maths quiz question query 
    $query = "INSERT INTO `3047_mathsquiz` (question_number, text)VALUES ('$question_number','$question_text')";
    
      // to run the insert query

    $insert_row = $conn->query($query) or die($conn->error . __LINE__);

       // Validate the insert_row on this quiz
    
    if ($insert_row) {
        foreach ($choices as $choice => $value) {
            if ($value != '') {
                if ($correct_choice == $choice) {
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }
    
    
                
                
   // Maths Quiz Choice Query
                $query = "INSERT INTO `3047_quizchoices` (question_number, is_correct, text) VALUES ('$question_number','$is_correct','$value')";
                    echo "$query";
       
                  $insert_row = $conn->query($query) or die($conn->error . __LINE__);
                  
                  //validation provided for insertion of the row
                   if ($insert_row) {
                    continue;
                } else {
                    die('Error : (' . $conn->errno . ') ' . $conn->error);
                }
            }//values
        }// end of this loop
            
            
              // message display the following
                 $msg = "  <div class='container'>
                        <div class='col-sm-6'><div class='alert alert-success text-center'>
           
               <h4> <span class='glyphicon glyphicon-ok'></span><strong> Question and Choices Successfully Added</strong></h4>
               <a href='mathsquiz.php'><button class='btn btn-success'> Finish </button> </a>
        </div>
        

";
        }
    }// end of this query 
   
    //select all from the maths quiz
$query = "SELECT * FROM 3047_mathsquiz ";

$questions = $conn->query($query);


if (!$questions) {
    echo $conn->error;
}

$total = $questions->num_rows;
$next = $total + 1;

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
    
   <div class="container">

                <div class="col-sm-12 col-md-12  col-lg-12 ">

                    <div class="text-center">
                        <h2><span class="glyphicon glyphicon-plus"></span> ADD QUIZ QUESTIONS</h2>
                        <p> Teacher, here you can add questions to the Maths Quiz !   </p>     
                    </div>
                    <hr class="my-4"> <br>

                </div>
         </div>
        
        
         <!-- javascript to inform to complete the form again -->  
          <script>
function validateForm() {
  var x = document.forms["questionform"]["question_text"].value;
  if (x == "") {
    alert("Please complete form again!!");
    return false;
  }
   var a = document.forms["questionform"]["choice2"].value;
   if (a == "") {
    alert("Please complete form again!!");
    return false;
  }
  
  
   var c = document.forms["questionform"]["question_number"].value;
   if (c == "") {
    alert("Please complete form again!!");
    return false;
  }
  
  
   var d = document.forms["questionform"]["correct_choice"].value;
   if (d == "") {
    alert("Please complete form again!!");
    return false;
  }
  
   var e = document.forms["questionform"]["choice1"].value;
   if (e == "") {
    alert("Please complete form again!!");
    return false;
  }
  
  
  
  
  
}
        </script>
        
        
        
         <div class="container">
             <?php
                 // if is set query to be run
             if(isset($msg)){
                 echo '<p>'.$msg. '</p>';
             }
                 ?>
     <!-- post form in which teacher can add the questions -->
             <form method="POST" action="mathsaddquestions.php" onsubmit="return validateForm()" name='questionform'  
              
                 <p>
                     <label> Question Number:  </label>
                     <input type="number" value="<?php echo $next;?>" name="question_number" required />  
                 </p>
                 
                  <p>
                     <label> Question Text:  </label>
                     <input type="text" style="width:40%" name="question_text" placeholder='Type question here...'  required />  
                 </p>
                 
                  <p>
                     <label> Choice #1:  </label>
                     <input type="text" style="width:40%" name="choice1" required placeholder='1st choice, G0!' required/>  
                 </p>    
                 
                  <p>
                     <label> Choice #2:  </label>
                     <input type="text" style="width:40%" name="choice2" placeholder='2nd choice, G0!' required />  
                 </p>   
                 
                  <p>
                     <label> Choice #3:  </label>
                     <input type="text" style="width:40%" name="choice3" placeholder='3rd choice, G0!'/>  
                 </p>   
                 
                  <p>
                     <label> Choice #4:  </label>
                     <input type="text" style="width:40%" name="choice4" placeholder='4th choice, G0!' />  
                 </p>   
              
                  <p>
                     <label> Choice #5:  </label>
                     <input type="text" style="width:40%" name="choice5" placeholder='5th choice, G0!' />  
                 </p>  
                 
                 <p>
                     <label> Correct Choice Number:  </label>
                     <input type="number" name="correct_choice" required/>  
                 </p>   
                 
                 
                 <br>
                 <a href='mathsquiz.php'
                   <button class='btn btn-default glyphicon glyphicon-arrow-left' type='submit'> Go Back</button></a>
                 <button class='btn btn-success ' type='submit' name='submit'> Submit </button>
                 
             </form>                        
         </div> </div>  </div><br><br><br>
         

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
  
                       
    </body>
</html>

             
             
             