<?php
session_start();
require_once '../includes/db.php';

$userID = $_POST['user'];
$testID = $_POST['test'];

mysqli_query(
    $connection,
    "DELETE FROM `answers` 
    WHERE `user` = '$userID' AND `test` = '$testID'"
);

mysqli_query(
    $connection,
    "DELETE FROM `solved_tests` 
    WHERE `user` = '$userID' AND `test` = '$testID'"
);

$solvedTest = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `solved_tests` WHERE `user` = '$userID' AND `test` = '$testID'"
));

if ($solvedTest) {
    $_SESSION['message'] = "Вторая попытка не дана.";
    header('Location: ../pages/tutor.php');
} else {
    $_SESSION['message'] = "Вторая попытка дана.";
    header('Location: ../pages/tutor.php');
}