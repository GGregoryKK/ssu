<?php
session_start();
require_once '../includes/db.php';

$owner = $_SESSION['user']['id'];

$dbSolvedTests = mysqli_query(
    $connection,
    "SELECT u.userID, u.lastName, u.firstName, u.middleName, u.login, t.testID, t.name, st.true_answers, st.false_answers, st.mark 
    FROM `solved_tests` st INNER JOIN `users` u, `tests` t 
    WHERE st.user = u.userID AND st.test = t.testID AND t.owner = '$owner'"
);

$numOfSolvedTests = mysqli_num_rows($dbSolvedTests);
$solvedTests = array();
for ($i = 0; $i < $numOfSolvedTests; ++$i) {
    $solvedTests[$i] = mysqli_fetch_assoc($dbSolvedTests);
}