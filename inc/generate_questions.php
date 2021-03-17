<?php
// Generate random questions
function generateQuestions(){
    $questionsCreate = [];
    // Loop for required number of questions
    for($i=0; $i<10; $i++){
        // Get random numbers to add
        $leftAdder = random_int(1,99);
        $rightAdder = random_int(1,99);
        // Calculate correct answer
        $correctAnswer = $leftAdder + $rightAdder;
        // Get incorrect answers within 10 numbers either way of correct answer
        // Make sure it is a unique answer
        //Get the first incorrect answer withing 10 numbers that is not the correct answer
        do{
            $firstIncorrectAnswer = random_int($correctAnswer-10, $correctAnswer+10);
        }while($firstIncorrectAnswer == $correctAnswer);
        //Get the second incorrect answer within 10 numbers that is not the correct or the first incorrect answer
        do{
            $secondIncorrectAnswer = random_int($correctAnswer-10, $correctAnswer+10);
        }while($secondIncorrectAnswer == $correctAnswer || $secondIncorrectAnswer == $firstIncorrectAnswer);

        // Add question and answer to questions array
        $questionsCreate[$i] = [
            "leftAdder" => $leftAdder,
            "rightAdder" => $rightAdder,
            "correctAnswer" => $correctAnswer,
            "firstIncorrectAnswer" => $firstIncorrectAnswer,
            "secondIncorrectAnswer" => $secondIncorrectAnswer
        ];
    }
    return $questionsCreate;

}
