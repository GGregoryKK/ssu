<?php
session_start();
require_once '../includes/db.php';

$userID = $_POST['user'];
$testID = $_POST['test'];
$mark = $_POST['mark'];

mysqli_query(
    $connection,
    "UPDATE `solved_tests` 
         SET  
            `mark` = '$mark' 
         WHERE `user` = '$userID' AND `test` = '$testID'"
);

$dbMark = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `solved_tests` WHERE `user` = '$userID' AND `test` = '$testID' AND `mark` = '$mark'"
));

if ($dbMark) {
    $_SESSION['message'] = "Оценка успешно изменена.";
    header('Location: ../pages/tutor.php');
} else {
    $_SESSION['message'] = "Оценка не изменена.";
    header('Location: ../pages/tutor.php');
}