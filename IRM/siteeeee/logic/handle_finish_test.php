<?php
session_start();
require_once '../includes/db.php';

$userID = $_SESSION['user']['id'];
$testID = $_SESSION['testToSolve']['id'];

$dbAnswers = mysqli_query(
    $connection,
    "SELECT * FROM `answers` WHERE `user` = '$userID' AND `test` = '$testID'"
);

$numOfRows = mysqli_num_rows($dbAnswers);
$answers = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $answers[$i] = mysqli_fetch_assoc($dbAnswers);
}

$trueAnswersNum = 0;
foreach ($answers as $answer) {
    if ($answer['mark']) {
        $trueAnswersNum++;
    }
}
$falseAnswersNum = $numOfRows - $trueAnswersNum;

mysqli_query(
    $connection,
    "INSERT INTO `solved_tests` (`user`, `test`, `true_answers`, `false_answers`, `mark`)
    VALUES ($userID, $testID, $trueAnswersNum, $falseAnswersNum, NULL)"
);

$dbFinishedTest = mysqli_query(
    $connection,
    "SELECT * FROM `solved_tests` WHERE `user` = '$userID' AND `test` = '$testID'"
);

if ($dbFinishedTest) {
    $_SESSION['message'] = "Тест успешно сохранен.";
    unset($_SESSION['testToSolve']);
    header('Location: ../pages/student.php');
} else {
    $_SESSION['message'] = "Тест не сохранен.";
    header('Location: ../pages/solve_test.php');
}
?>
