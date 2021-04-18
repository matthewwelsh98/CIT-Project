<!DOCTYPE html>
<?php
include ('connection.php');
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
            </div></nav>

    <br><br><br>
    

        <div class="container">

        <div class="section text-center">

     
            <img src="images/PL_logo.PNG" alt="PrimaryLearn logo "/>
           <br>
           
            <h2>Welcome Children to Primary Learn! </h2>
            
            <hr class="my-4">          
         
     <!-- login to primarylearn here --> 
            <div class="my-login alert alert-info text-center">
            <form method="POST" action="processlogin.php">  
           
            <p><strong> Username: </strong>
                <input name="usern" type="text"  placeholder="Type Username here!" required></p>
         
            <p><strong> Password: </strong> 
                <input name="pass" type="password" placeholder="Type Password here!" required></p>
            <br>
            <p><input type="submit" class="btn btn-success" value="Let's Go!"></p>
            <p></p>
        </form>
                <p><a <input type="submit" name='submit' href="forgetpassword.php"  class="btn btn-danger" value="Forgoten Password">Forgot your password?</a></p>
        </div>
        </div>
        
            </div>
    
        
           

    </body>
    </html>

 

