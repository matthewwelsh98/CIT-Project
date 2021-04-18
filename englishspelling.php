




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
                 
                 
                 <li><?php echo "<a class='nav-link' href='profile.php'>Parents</a>";?>
                    </li>
                    <li><a href="chat.php"> Chat</a></li>    
                 
                    <div class="dropdown">
     
                   
                   <div class="dropdown-content">
                       <div class="text-center"> <a href="profile.php">  <?php echo "<img src='images/$userimg'width='100px'/>"?></div></a>
                       <a href="profile.php"><?php echo $useremail?></a>
                     <a href="processlogout.php"><span class="glyphicon glyphicon-log-out" ></span>Log Out</a></div>
                   </div>
                 </div>
            </div>
    </nav>

        <br><br><br><br>
        

<canvas id="canvas" width = "500" height = "500"></canvas>
	<script src="https://code.jquery.com/jquery-2.1.0.js"></script>
	<script>
		var canvas = document.getElementById("canvas");
		var context = canvas.getContext("2d");
		var width = canvas.width;
		var height = canvas.height;
		
	//variable to hold block size
	var blockSize = 10;
	//set how many blocks wide the canvas will behind
	var widthInBlocks = width/blockSize;
	//set how many blocks high the canvas will behind
	var heightInBlocks = height/blockSize;
	//score
	var score = 0;
	//function to draw a border around the canvas
	var drawBorder = function(){
		//set color
		context.fillStyle = "gray";
		//draw the top edge of the border
		context.fillRect(0, 0, width, blockSize);
		//draw the bottom edge of the border
		context.fillRect(0, height - blockSize, width, blockSize);
		//draw the left edge of the border
		context.fillRect(0, 0, blockSize, height);
		//draw the right edge of the border
		context.fillRect(width - blockSize, 0, blockSize, height);
	}
	
	
	//display the score to the canvas
	var drawScore = function(){
		//set font size and type
		context.font = "20px Arial";
		//set font color
		context.fillStyle = "black";
		//set alignment
		context.textAlign = "left";
		//set baseline
		context.textBaseline = "top";
		//write the score to the canvas (x, y at blockSize or 10px for location)
		context.fillText("score: " + score, blockSize, blockSize);
	}
	
	
	//function to end the game
	var gameOver = function(){
		//cancel the setInterval function
		clearInterval(intervalId);
		//set font size, type, color, alignment and baseline
		context.font = "60px Arial";
		context.fillStyle = "red";
		context.textAlign = "center";
		context.textBaseline = "middle";
		//write Game Over in the senter of the screen
		context.fillText("Game Over", width/2, height/2);
	}
	
	//block constryctor - values col and row passed in as arguments
	var Block = function(col, row){
		this.col = col;
		this.row = row;
	}
	
	//draw square method for Blocks
	Block.prototype.drawSquare = function(color){
		//calculate the x value by multiplying col by BlockSize
		var x = this.col * blockSize;
		//calculate the y value by multiplying row by blockSize
		var y = this.row * blockSize;
		//set the color
		context.fillStyle = color;
		//draw the rectangle at the x,y location with blockSize height and width
		context.fillRect(x, y, blockSize, blockSize);
	}
	
	//draw circle function
	var drawCircle = function(x, y, radius, fillCircle){
		context.beginPath();
		context.arc(x, y, radius, 0, Math.PI * 2, false);
		if(fillCircle){
			context.fill();
		}else{
			context.stroke();
		}
	};
	//draw circle method to draw the snake head
	Block.prototype.drawCircle = function(color){
		//calculate the center of the circle
		var centerX = this.col * blockSize + blockSize / 2;
		var centerY = this.row * blockSize + blockSize / 2;
		//fill color
		context.fillStyle = color;
		drawCircle(centerX, centerY, blockSize / 2, true);
	}
	
	//equal method checks to see if two blocks are in the same location
	Block.prototype.equal = function(otherBlock){
		//if the two blocks - this and otherBlock have the same column and row
			//properites they are in the same place and return the value TRUE else FALSE
		return this.col===otherBlock.col && this.row === otherBlock.row;
	}
	
	//snake constructor
	var Snake = function(){
		//array of block objects one for each segment of the body
		this.segments = [
			new Block(7,5),
			new Block(6,5),
			new Block(5,5)
		];
		//store current direction of snake
		this.direction = "right";
		//store direction snake will move next
		this.nextDirection = "right";
	}
	//draw Snake prototype
	Snake.prototype.draw = function(){
	for(i = 0; i < this.segments.length; i++){
		//draw each block object in the segments array
		if(i === 0){
			this.segments[i].drawSquare("black");
		}else if(i%2==0){
			this.segments[i].drawSquare("blue");
		}else{
			this.segments[i].drawSquare("purple");
		}
	}
	}

	//move Snake method
	Snake.prototype.move = function(){
		//variable to store the snake head segment
		var head = this.segments[0];
		//variable to store the block representing the new head of the snake
		var newHead;
		
		//set direction to the next direction snake should move based on arrow key pressed
		this.direction = this.nextDirection;
		
		//if direction is right
		if(this.direction === "right"){
			//add one to column number to move right
			newHead = new Block(head.col + 1, head.row);
		//if direction is down
		}else if (this.direction === "down"){
			//add one to row number to move down
			newHead = new Block(head.col, head.row + 1);
		//if direction is left
		}else if (this.direction === "left"){
			//subtract  one from column number to move left
			newHead = new Block(head.col - 1, head.row);
		//if direction is up
		}else if (this.direction === "up"){
			//subtract one form row number to move up
			newHead = new Block(head.col, head.row - 1);
		}
		
		//check if the head is colliding with a wall or itself
		if(this.checkCollision(newHead)){
			//if true, game over
			gameOver();
			//exit method
			return;
		}
		
		//add a new head to the front of the snake
		this.segments.unshift(newHead);
		
		//if the head is touching the apple
		if(newHead.equal(apple.position)){
			//score point
			score++;
			//move the apple to a new location
			apple.move();
		}else{
			//remove snake's tail while keeping snake the same size
			this.segments.pop();
		}
	}
	
	//check for collision with itself or wall
	Snake.prototype.checkCollision = function(head){
		var leftCollision = (head.col === 0);
		var topCollision = (head.row === 0);
		var rightCollision = (head.col === widthInBlocks -1);
		var bottomCollision = (head.row === heightInBlocks -1);
		
		//check to see if snake has collided with a wall
		var wallCollision = leftCollision || topCollision ||
		rightCollision || bottomCollision;
		
		var selfCollision = false;
		
		//loop through all the segments of the snake to determine whether the new head is in the same place as any segment
		for(var i = 0; i < this.segments.length; i++){
			//use equal method to see if blocks are in the same place
			if(head.equal(this.segments[i])){
				//if true, snake is colliding with itself
				selfCollision = true;
			}
		}
		//return true if wall or self collision false if not colliding with anything
		return wallCollision || selfCollision;
	}
	
	//keydown event handler handles keyboard events
	////set key numeric values to names
	var directions = {
		//left arrow
		37: "left",
		//up arrow
		38: "up",
		//right arrow
		39: "right",
		//down arrow
		40: "down"
	}
	
	//event handler for keydown-called when user presses a key
	$("body").keydown(function(event){
		//convert the event keyCode into a direction string
		var newDirection = directions[event.keyCode];
		//if key presses is defined as one of our directions
		if(newDirection !== undefined){
			//set the new direction
			snake.setDirection(newDirection);
		}
	});
	
	//set the snake's direction
	Snake.prototype.setDirection = function(newDirection){
		//exit if turn is illegal (you can't reverse direction)
		if(this.direction === "up" && newDirection === "down"){
			return;
		}else if(this.direction === "right" && newDirection === "left"){
			return;
		}else if(this.direction === "down" && newDirection === "up"){
			return;
		}else if(this.direction === "left" && newDirection === "right"){
			return;
		}
		//if turn is legal, set new Direction
		this.nextDirection = newDirection;
	}
	
	//apple constructor
	var Apple = function(){
		this.position = new Block(10,10);
	}
	//draw the apple
	Apple.prototype.draw = function(){
		this.position.drawCircle("lime");
	}
	//move the apple to a new position
	Apple.prototype.move = function(){
		//get a random column number
		var randomCol = Math.floor(Math.random() * (widthInBlocks -2)) + 1;
		//get a random row number
		var randomRow = Math.floor(Math.random() * (widthInBlocks -2)) + 1;
		//set the new position for the apple
		this.position = new Block(randomCol, randomRow);
	}

	var snake = new Snake();
	
	var apple = new Apple();
	var intervalId = setInterval(function(){
		context.clearRect(0, 0, width, height);
		drawScore();
		snake.move();
		snake.draw();
		apple.draw();
		drawBorder();
	}, 100);
	
	</script>

 
  <!-- SOCIAL MEDIA HOVER ICONS  -->

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
  
  

<!-- smooth scrolling javascript -->
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