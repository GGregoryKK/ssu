<?php
session_start();
require_once '../includes/db.php';

$questionID = $_POST['questID'];

mysqli_query(
    $connection,
    "DELETE FROM `questions` 
    WHERE `questionID` = '$questionID'"
);

$question = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `questions` WHERE `questionID` = '$questionID'"
));

if (!$question) {
    $_SESSION['message'] = "Вопрос успешно удален.";
    header('Location: ../pages/edit_test.php');
} else {
    $_SESSION['message'] = "Вопрос не удален.";
    header('Location: ../pages/edit_test.php');
}