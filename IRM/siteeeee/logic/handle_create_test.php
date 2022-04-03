<?php
session_start();
require_once '../includes/db.php';

$name = $_POST['name'];
$owner = $_SESSION['user']['id'];

mysqli_query(
    $connection,
    "INSERT INTO `tests` (`name`, `owner`)
    VALUES ('$name', '$owner')"
);

$test = mysqli_fetch_assoc(mysqli_query(
    $connection,
    "SELECT * FROM `tests` WHERE `name` = '$name' AND `owner` = '$owner'"
));

if ($test) {
    $testID = $test['testID'];
    $_SESSION['message'] = "Тест создан. ID теста - $testID.";
    $_SESSION['editTest'] = [
        'id' => $testID,
        'name' => $name,
    ];
    header('Location: ../pages/edit_test.php');
} else {
    $_SESSION['message'] = 'Тест не создан';
    header('Location: ../pages/tutor.php');
}
?>
