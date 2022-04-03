<?php
session_start();
require_once '../includes/db.php';

$login = $_GET['login'];

$dbUser = mysqli_query(
    $connection,
    "SELECT u.userID, u.firstName, u.lastName, u.middleName, u.login, u.role
    FROM `users` u WHERE `login` = '$login'"
);

$foundUser = mysqli_fetch_assoc($dbUser);

$_SESSION['foundUser'] = [
    'id' => $foundUser['userID'],
    'firstName' => $foundUser['firstName'],
    'middleName' => $foundUser['middleName'],
    'lastName' => $foundUser['lastName'],
    'login' => $foundUser['login'],
    'role' => $foundUser['role']
];

header('Location: ../pages/admin.php');
?>
