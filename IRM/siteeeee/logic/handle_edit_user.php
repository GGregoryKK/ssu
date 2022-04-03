<?php
session_start();
require_once '../includes/db.php';

$id = $_SESSION['foundUser']['id'];
$login = $_SESSION['foundUser']['login'];
$password = $_POST['password'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$role = $_POST['role'];


mysqli_query(
    $connection,
    "UPDATE `users`
    SET
        `userID`='$id',
        `firstName`='$firstName',
        `middleName`='$middleName',
        `lastName`='$lastName',
        `login`='$login',
        `password`='$password',
        `role`='$role'
    WHERE `login`='$login'"
);

$user = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `users`
    WHERE
        `userID`='$id' AND
        `login` = '$login' AND
        `password` = '$password' AND
        `firstName`='$firstName' AND
        `middleName`='$middleName' AND
        `lastName`='$lastName' AND
        `role`='$role'"
));

if ($user) {
    $_SESSION['message'] = 'Редактирование прошло успешно.';
} else {
    $_SESSION['message'] = 'Что то пошло не так...';
}
header('Location: ../pages/admin.php');
