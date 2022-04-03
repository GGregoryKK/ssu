<?php
session_start();
unset($_SESSION['editTest']);
unset($_SESSION['studentAnswers']);
unset($_SESSION['foundUser']);
unset($_SESSION['foundResult']);
unset($_SESSION['testToSolve']);
unset($_SESSION['user']);
unset($_SESSION['message']);
header('Location: ../pages/login.php');