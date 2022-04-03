<?php
session_start();
require_once '../includes/db.php';

$owner = $_SESSION['user']['id'];

$dbTests = mysqli_query(
    $connection,
    "SELECT t.testID, t.name FROM `tests` t WHERE `owner`='$owner'"
);

$numOfRows = mysqli_num_rows($dbTests);
$allTests = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $allTests[$i] = mysqli_fetch_assoc($dbTests);
}