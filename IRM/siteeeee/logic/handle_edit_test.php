<?php
session_start();
require_once '../includes/db.php';

$testID = $_POST['testID'];
$name = $_POST['name'];

$_SESSION['message'] = "Тест для редактирования открыт.";
$_SESSION['editTest'] = [
    'id' => $testID,
    'name' => $name,
];
header('Location: ../pages/edit_test.php');