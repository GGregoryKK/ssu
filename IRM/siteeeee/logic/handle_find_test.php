<?php
session_start();
require_once '../includes/db.php';

$userID = $_SESSION['user']['id'];
$testID = $_POST['testID'];

$checkIfAlreadySolved = mysqli_num_rows(mysqli_query(
    $connection,
    "SELECT * 
        FROM `solved_tests` st 
        WHERE `user` = '$userID' AND `test` = '$testID'"
));

if ($checkIfAlreadySolved == 0) {
    $testName = mysqli_fetch_assoc(mysqli_query($connection,
        "SELECT t.name 
    FROM `tests` t 
    WHERE `testID` = '$testID'"))['name'];

    if ($testName) {
        $dbTestQuestions = mysqli_query(
            $connection,
            "SELECT q.questionID, q.name, q.answers 
        FROM `questions` q 
        WHERE `test` = '$testID'"
        );

        $numOfRows = mysqli_num_rows($dbTestQuestions);
        $testQuestions = array();

        for ($i = 0; $i < $numOfRows; ++$i) {
            $testQuestions[$i] = [
                'question' => mysqli_fetch_assoc($dbTestQuestions),
                'state' => 0
            ];
        }

        $_SESSION['testToSolve'] = [
            'id' => $testID,
            'name' => $testName,
            'numOfQuestions' => $numOfRows,
            'numOfStudentAnswers' => 0,
            'questions' => $testQuestions
        ];

        header('Location: ../pages/solve_test.php');
    } else {
        $_SESSION['message'] = "Тест с ID $testID не найден.";
        header('Location: ../pages/student.php');
    }
} else {
    $_SESSION['message'] = "Вы уже проходили тест с ID $testID.";
    header('Location: ../pages/student.php');
}