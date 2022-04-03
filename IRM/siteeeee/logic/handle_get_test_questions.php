<?php
session_start();
require_once '../includes/db.php';

$testID = $_SESSION['editTest']['id'];

$dbQuestions = mysqli_query(
    $connection,
    "SELECT q.questionID, q.name, q.answers FROM `questions` q WHERE `test`='$testID'"
);

$numOfRows = mysqli_num_rows($dbQuestions);
$testQuestions = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $testQuestions[$i] = mysqli_fetch_assoc($dbQuestions);
}
?>
