<?php

session_start();

if (!isset($_SESSION['primarylearn'])) {
    //move broswer to login.php
    header("Location: index.php");
} else {   
    $user = $_SESSION['primarylearn'];
    // echo $user;
}
if (isset($_SESSION['primarylearnutype'])) {

    $utype = $_SESSION['primarylearnutype'];
} else {
    $utype = 'false';
}


//db connection
include('connection.php');


//username and password sanitised
$username = htmlspecialchars($conn->real_escape_string($_POST['usern']));
$pw = stripslashes($conn->real_escape_string($_POST['pass']));

//check on the database
$check = "SELECT * FROM 3047_user WHERE username='$username' AND password= '$pw' ";

//query check
$result = $conn->query($check);
?>


<!DOCTYPE html>
<html lang="en">
   <head>
        <!-- My Theme   -->
        <title>PrimaryLearn VLE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="ui.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
 
        
  
        
        //get the number of rows from a variable
            $num = $result->num_rows;
        
        if($num > 0){
            while ($row = $result->fetch_assoc()){
                 $userid = $row['id'];
                 $usertype = $row['type_id'];
                 $username = $row ['usern'];
                
          // set the sessions
          $_SESSION['primarylearn'] = $userid;
          $_SESSION['plusername'] = $username;
   
          
         //user type session
          $_SESSION['primarylearnutype'] = $usertype;
//          echo "You are a valid user";
          header("location: subjects.php");
            }
   
            
            // else then do this 
       }else{

                echo "<div class='container'><br> <hr class='my-4'>




        <div class='alert alert-danger text-center'>
                <h2>Unsuccessfully Logged In, Re-enter Credentials</h2>
                <a href='index.php'><strong>Log in</strong></a>
                


             </div>
           <hr class='my-4'>";
        }
        ?>
        
        
        
        
        
        
    </body>
</html>

