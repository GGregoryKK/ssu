<?php
session_start();
require_once '../includes/db.php';

$name = $_POST['name'];
$answers = $_POST['answers'];
$testID = $_SESSION['editTest']['id'];

mysqli_query(
    $connection,
    "INSERT INTO `questions` (`name`, `answers`, `test`)
    VALUES ('$name', '$answers', '$testID')"
);

$question = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `questions` WHERE `name` = '$name' AND `answers` = '$answers'"
));

if ($question) {
    $_SESSION['message'] = "Вопрос успешно добавлен";
    header('Location: ../pages/edit_test.php');
} else {
    $_SESSION['message'] = "Вопрос не добавлен.";
    header('Location: ../pages/edit_test.php');
}
?>
