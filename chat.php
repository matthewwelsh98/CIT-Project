<?php
//SESSIONS
include("connection.php");
session_start();
if (!isset($_SESSION['primarylearn'])) {
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

$conn->set_charset('utf8');

//query to chat
$query = "SELECT * FROM 3047_chatdiscussion ";


$results = $conn->query($query);

//select the user id
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
                        <h2><span class="glyphicon glyphicon-comment"></span>Chat!</h2>
                        <p> Need some help? Chat away!  </p>     
                    </div>
                    <hr class="my-4"> 


                </div>

                <br><br><br><br>

                 
                <div class="output">
<?php

//this is the query to allow the communication facility
$display = "SELECT 3047_chatdiscussion.id, 3047_user.username, 3047_chatdiscussion.message, 3047_chatdiscussion.date FROM 3047_chatdiscussion INNER JOIN 3047_user ON 3047_user.id = 3047_chatdiscussion.name WHERE 3047_chatdiscussion.message_to = {$_SESSION['primarylearn']} OR 3047_chatdiscussion.name ={$_SESSION['primarylearn']}";
//echo "$display";
$displayresult = $conn->query($display);
$checkusermessage= $displayresult->num_rows;

// if statement to check the user message
 if($checkusermessage > 0){
       while($row = $displayresult->fetch_assoc()){
           $name = $row['username'];
           $delid = $row['id'];

           
                 echo "<strong>From - </strong>" . $name . "  " . ":  " . $row['message'] . " (" . "<strong>sent: </strong>" . $row['date'] . ")"."<a href=chatmessagedelete.php?delete_id=$delid><button class='btn btn-danger'> Delete</button></a><br>";
        echo "<br>";
    }
} else {
    echo "No messages";
}
  
?>
                </div>
        
        <!-- Javascript for chat form -->
                <script>
                    function validateForm() {
                        var x = document.forms["chatform"]["message"].value;
                        if (x == "") {
                            alert("Please type a message");
                            return false;
                        }
                    }
                </script>

                          <div class='container-fluid'>
                    <form action='chat.php' onsubmit="return validateForm()" name="chatform" method='POST' >
                        <div class='form-group'>
                            <p><strong>To: </strong></p>
                            <select name='to' required/>
                            
                            
                            <?php
                            
                           //if user type is a 'student' show this
if ($utype == '1') {
    include("connection.php");


    $selectquery = "SELECT 3047_user.id AS ID, 3047_user.username AS USERNAME  FROM 3047_teacherstudent INNER JOIN 3047_user ON 3047_user.id = 3047_teacherstudent.teacher_id WHERE 3047_teacherstudent.student_id = {$_SESSION['primarylearn']}";
    $selectresult = $conn->query($selectquery);

    while ($row = $selectresult->fetch_assoc()) {
        $useid = $row['ID'];
        $usename = $row['USERNAME'];


        echo "<option value='$useid'>$usename</option>";
    }
} else {
    $selectquery2 = "SELECT * FROM 3047_user WHERE type_id = '2' OR type_id = '1'";
    $selectresult2 = $conn->query($selectquery2);


    while ($row = $selectresult2->fetch_assoc()) {
        $useid2 = $row['id'];
        $usename2 = $row['username'];
        
          echo "<option value='$useid2'>$usename2</option>";
    }
}

?>

                            
                            </select> <br><br> 

                            <label for="name" >Message: </label>
                            <p> <textarea rows='4' cols='50' type = 'text' name='message' placeholder='Type your message here!' required></textarea></p>

                        </div>
                        <button class='btn btn-success glyphicon glyphicon-send ' type='submit' name='submit'> Send</button><br><br>
                    </form>
                </div></div>

                
                <?php
                
                // query for the message
                
if (isset($_POST['submit'])) {
    include("connection.php");
    echo "<meta http-equiv='refresh' content='0'/>";
    


    $messto = $_POST['to'];
    $msg = htmlspecialchars($_POST['message']);
    $name = $_SESSION['primarylearn'];

    $chatinsert = "INSERT INTO 3047_chatdiscussion(message, name, message_to) VALUES('$msg', '$name', '$messto')";
    $chatresult = $conn->query($chatinsert);

    if (!$chatresult) {
        echo $conn->error;
    }
}
?>

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