  <?php
  session_start();
  session_destroy();
  header("Location: index.php");
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
    

</head>
<body> 

       <!--- NAVIGATION -->
    <nav class="navbar navbar-default navbar-fixed-top">
          <div align="left">
  <a align=left href="index.php" title="Primary Learn"><h1>Primary Learn | VLE </h1></a>
</div>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
             
               
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                
            </div>
        </div>
    </nav>

    <br>

    <br> <br>

    
    
</body>
</html>