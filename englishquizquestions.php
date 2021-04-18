
<?php
//SESSIONS
session_start();
include("connection.php");

if (isset($_GET['n'])) {
    if ($_GET['n'] == 1) {
        $_SESSION['score_numbers'] = 0;
    }
}

if (isset($_SESSION['primarylearnutype'])) {

        $utype = $_SESSION['primarylearnutype'];
    } else {
        $utype = 'false';
    }
    

    
$conn->set_charset('utf8');
// english letter query
$englishletter = (int) $conn->real_escape_string($_GET['n']);


// Get the Total 
$query = "SELECT * FROM 3047_englishquiz";

// Get the said Result

$final = $conn->query($query) or die($conn->error . __LINE__);
$total = $final->num_rows;

// quiz query select from the english quiz
$quizquery1 = "SELECT * FROM 3047_englishquiz WHERE question_number = $englishletter";

$result = $conn->query($quizquery1);

if (!$result) {
    echo $conn->error;
}

$englishquestion = $result->fetch_assoc();

$englishimg = $result->fetch_assoc();

//select from the quiz choice questions
$quizquery = "SELECT * FROM 3047_englishquizchoices WHERE question_number = $englishletter";

$choices = $conn->query($quizquery);

// query check
if (!$choices) {
    echo $conn->error;
}

$query3 = "SELECT * FROM 3047_user WHERE id = {$_SESSION['primarylearn']}";

$resultquery2 = $conn->query($query3);
// while loop to show in the nav bar
while ($row7 = $resultquery2->fetch_assoc()) {
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
    
        
        <!-- javascript provides form integration to show an answer needs filled in -->
          <script>
function validateForm() {
  var x = document.forms["quizform"]["choice"].value;
  if (x == "") {
    alert("Please select an option!");
    return false;
  }
}
        </script>

        
        
      <div class="container">
   
                <div class="col-sm-12 col-md-12  col-lg-12 ">

                    <div class="text-center">
                        <h2><span class="glyphicon glyphicon-search"></span>FUN TIME WITH ENGLISH SPELLINGS!</h2>
                        <p> Have a go below to win trophies! </p>     
                    </div>
                    <hr class="my-4"> <br>
                </div>
            </div>
   
        
         <div class="container">

               <div class="col-md-4"></div>
               
                <div class="col-md-4">

   <!-- english questions are displayed -->             
                <div class="current">Question <?php echo $englishquestion['question_number']; ?> of <?php echo $total; ?></div>
                <p class="question">

                    <?php echo $englishquestion ['text']; ?>
                </p>
                <?Php $img = $englishquestion['english_pic']; ?>

                <a>        <?php echo "<img src='images/$img'>"; ?>         </a> 
     
                <form method="POST" action="englishquizprocess.php" name='quizform' onsubmit="return validateForm()"> 

                    <ul class="choices">
                        <?php while ($row = $choices->fetch_assoc()):{ ?> 
                        <li><input name="choice" type="radio" value="<?php echo $row ['id']; }?>"required />

                                <?php echo $row ['text']; ?></li>
                       
  
        <?php endwhile; ?>
                    </ul><br>

                    <button class='btn btn-default glyphicon glyphicon-arrow-left' onclick="goBack()"> Go Back</button>
                    <button class='btn btn-success ' type='submit'> Submit </button>
                    <input type="hidden" name="number" value="<?php echo $englishletter; ?>" />
                </form>

                </div>  <div class="col-md-4"></div> </div>

            <br><br><br>

            
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
  function goBack() {
                    window.history.back();
                }


   
</script> 
  
                       
    </body>
</html>


