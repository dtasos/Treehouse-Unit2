<?php



// Start the session
session_start();

// Include questions from the questions.php file
include 'generate_questions.php';

//Assign dynamic the questions
if(!isset($_SESSION["questions"])){
    $_SESSION["questions"] = generateQuestions();
}


// Make a variable to determine if the score will be shown or not. Set it to false.
$show_score = false;

// Make a variable to hold a random index. Assign null to it.
$index = null;

// Make a variable to hold the total number of questions to ask
$totalQuestions = count($_SESSION["questions"]);

// Make a variable to hold the toast message and set it to an empty string
$toast = null;


//If the server request was of type POST
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Check if the user's answer is the correct answer
    if($_POST['answer'] == $_SESSION["questions"][$_POST['index']]['correctAnswer']){
        //Assign a congratulutory string to the toast variable 
        $toast = 'Well done! Thats correct';
        //Increment the session variable that holds the total number correct by one
        $_SESSION["totalCorrect"] += 1;
    }
    else {
        //Assign a bummer message to the toast variable
        $toast = 'Bummer! That was incorrect';
    }
} 



//Check if a session variable has ever been set/created to hold the indexes of questions already asked
if(!isset( $_SESSION["used_indexes"])){
    //Create a session variable to hold used indexes and initialize it to an empty array
    $_SESSION["used_indexes"] = [];
    //Set a session variable with the total correct answers to 0
    $_SESSION["totalCorrect"] = 0;
}


//If all of the questions have been answered
if(count($_SESSION["used_indexes"]) == $totalQuestions){
    //reset the session variable for used_indexes to an empty array
    $_SESSION["used_indexes"] = [];
    //set show score to true to end the quiz
    $show_score = true;
} else {
    //Game is still in progress
    $show_score = false;
    //If it is the first question
    if(count($_SESSION["used_indexes"]) == 0){
        //Set total correct questions to 0
        $_SESSION["totalCorrect"] = 0;
        //Set toast variable to an empty string
        $toast = '';
    }
    //As long as the index belongs to the used indexes array generate another one
    do {
        $index = rand(0,$totalQuestions-1);
    } while(in_array($index,$_SESSION["used_indexes"]));

    //Assign the new random question in variable question
    $question = $_SESSION["questions"][$index];
    //Push in the array used indexes the newly generated index
    array_push( $_SESSION["used_indexes"], $index);
    //Create an array with the answers of the question we have just assigned in the question variable
    $answers = array(
        $question["correctAnswer"],
        $question["firstIncorrectAnswer"],
        $question["secondIncorrectAnswer"]
    );
    //Shuffle the array to randomize the answers order
    shuffle($answers);
}

// session_destroy();
