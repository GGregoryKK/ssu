<?php

require_once "config.php";

$connection = mysqli_connect(
    $config['db']['server'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['name']
);

if (!$connection) {
    echo "Cannot connect to database\n";
    echo mysqli_connect_error();
    exit();
}
?>
