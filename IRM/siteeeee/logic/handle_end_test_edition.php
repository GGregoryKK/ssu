<?php
session_start();

unset($_SESSION['editTest']);

$_SESSION['message'] = "Редактирование теста завершено";

header("Location: ../pages/tutor.php");