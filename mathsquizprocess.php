<?php
//SESSIONS
session_start();
include("connection.php");

// do a check to see if score is set as an error

if (!isset($_SESSION['score_numbers'])) {
    $_SESSION['score_numbers'] = 0;
}

// post from quiz
if ($_POST) {
    $number = $conn->real_escape_string($_POST['number']);
    $selected_choice = $conn->real_escape_string($_POST['choice']);
    $next = $number + 1; // increment by 1
    // Get Total 
    $query = "SELECT * FROM 3047_mathsquiz";


   // Get the end result

    $final = $conn->query($query) or die($conn->error . __LINE__);
    $total = $final->num_rows;



    // get the correct answer

    $processquery = "SELECT * FROM `3047_quizchoices` WHERE question_number = $number AND is_correct = 1";


    
     // Getting Result

    $result = $conn->query($processquery) or die($conn->error . __LINE__);


    $row = $result->fetch_assoc();

    // Select correct choice
    $correct_choice = $row['id'];

    if ($correct_choice == $selected_choice) {
        // Answer is then correct
        $_SESSION['score_numbers'] ++; // increment by 1
    } else {
        
    }
    
    
     // Checks if on last question or not
    if ($number == $total) {
        header("Location: mathsquizfinal.php");
        exit();
    } else {
        header("Location: mathsquizquestions.php?n=" . $next);
    }
}


