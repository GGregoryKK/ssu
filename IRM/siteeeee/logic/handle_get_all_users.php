<?php
session_start();
require_once '../includes/db.php';

$dbUsers = mysqli_query(
    $connection,
    "SELECT u.userID, u.firstName, u.lastName, u.middleName, u.login, u.role
    FROM `users` u"
);

$numOfRows = mysqli_num_rows($dbUsers);
$allUsers = array();

for ($i = 0; $i < $numOfRows; ++$i) {
    $allUsers[$i] = mysqli_fetch_assoc($dbUsers);
}
?>
