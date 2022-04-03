<?php
session_start();
require_once '../includes/db.php';

$userID = $_SESSION['user']['id'];

$dbTests = mysqli_query(
    $connection,
    "SELECT st.test, t.name, st.true_answers, st.false_answers, st.mark 
    FROM `solved_tests` st INNER JOIN `tests` t ON st.test=t.testID 
    WHERE `user`='$userID'"
);

$numOfRows = mysqli_num_rows($dbTests);
$tests = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $tests[$i] = mysqli_fetch_assoc($dbTests);
}