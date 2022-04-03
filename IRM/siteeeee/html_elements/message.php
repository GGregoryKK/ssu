<?php
session_start();
if ($_SESSION['message']) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
}
unset($_SESSION['message']);
?>
