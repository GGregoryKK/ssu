<?php
session_start();
require_once '../includes/db.php';

$login = $_POST['login'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$role = $_POST['role'];

$checkLogin = mysqli_num_rows(mysqli_query(
    $connection,
    "SELECT * FROM `users` WHERE `login` = '$login'"
));

if ($checkLogin != 0) {
    $_SESSION['message'] = 'Этот логин уже занят.';
} else {
    if ($password === $confirmPassword) {
        $password = $password;

        mysqli_query(
            $connection,
            "INSERT INTO `users` (`firstName`, `middleName`, `lastName`, `login`, `password`, `role`)
            VALUES ('$firstName', '$middleName', '$lastName', '$login', '$password', $role)"
        );

        mysqli_query(
            $connection,
            "INSERT INTO `role` (`role`) VALUES ($role)"
        );

        $user = mysqli_fetch_assoc(mysqli_query(
            $connection,
            "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'"
        ));

        if ($user) {
            $_SESSION['message'] = 'Регистрация прошла успешно.';
            $_SESSION['user'] = [
                'id' => $user['userID'],
                'firstName' => $user['firstName'],
                'middleName' => $user['middleName'],
                'lastName' => $user['lastName'],
                'login' => $user['login'],
                'role' => $user['role']
            ];
            header('Location: ../index.php');
        } else {
            $_SESSION['message'] = 'Что то пошло не так...';
            header('Location: ../pages/registration.php');
        }

    } else {
        $_SESSION['message'] = 'Пароли не совпадают.';
        header('Location: ../pages/registration.php');
    }
}
