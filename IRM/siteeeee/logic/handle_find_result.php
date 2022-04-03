<?php
session_start();
require_once '../includes/db.php';

$fullName = $_GET['fullName'];
$login = $_GET['login'];
$testID = $_GET['testID'];

$owner = $_SESSION['user']['id'];

$queryParams = '';
if ($login != null) {
    $queryParams = "$queryParams AND u.login = '$login'";
}
if ($testID != null) {
    $queryParams = "$queryParams AND t.testID = $testID";
}
if ($fullName != null) {
    $fullName = explode(" ", $fullName);
    $lastName = $fullName[0];
    $firstName = $fullName[1];
    $middleName = $fullName[2];
    $queryParams = "$queryParams AND u.firstName = '$firstName' AND u.middleName = '$middleName' AND u.lastName = '$lastName'";
}

if (strcasecmp($queryParams, '') == 0) {
    unset($_SESSION['foundResult']);

    header('Location: ../pages/tutor.php');
} else {
    $dbFoundResults = mysqli_query(
        $connection,
        "SELECT u.userID, u.lastName, u.firstName, u.middleName, u.login, t.testID, t.name, st.true_answers, st.false_answers, st.mark
    FROM `solved_tests` st INNER JOIN `users` u, `tests` t
    WHERE st.user = u.userID AND st.test = t.testID AND t.owner = '$owner' $queryParams"
    );

    $numOfFoundResults = mysqli_num_rows($dbFoundResults);

    if ($numOfFoundResults > 0) {
        $foundResults = array();
        for ($i = 0; $i < $numOfFoundResults; ++$i) {
            $foundResults[$i] = mysqli_fetch_assoc($dbFoundResults);
        }

        $_SESSION['foundResult'] = $foundResults;

        header('Location: ../pages/tutor.php');
    } else {
        $_SESSION['message'] = 'Результатов с этими параметрами не найдено';
        unset($_SESSION['foundResult']);

        header('Location: ../pages/tutor.php');
    }
}
