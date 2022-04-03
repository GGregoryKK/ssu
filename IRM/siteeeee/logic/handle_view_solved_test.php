<?php
session_start();
require_once '../includes/db.php';

$userID = $_POST['user'];
$testID = $_POST['test'];


$dbAnswers = mysqli_query(
    $connection,
    "SELECT q.name, q.answers, a.answer, a.mark
    FROM `answers` a INNER JOIN `questions` q ON a.question=q.questionID
    WHERE a.user='$userID' AND a.test='$testID'"
);

$numOfRows = mysqli_num_rows($dbAnswers);
$answers = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $answers[$i] = mysqli_fetch_assoc($dbAnswers);
}

$_SESSION['studentAnswers'] = $answers;
$_SESSION['message'] = "$testID, $userID.";

header('Location: ../pages/answers.php');
?>
