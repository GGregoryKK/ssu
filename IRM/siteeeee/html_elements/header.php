<?php
session_start();

echo '
    <div class="header-wrapper">
        <div class="title">
            <a class="title-href" href="../index.php"><h3>' . $config['title'] . '</h3></a>
        </div>
        <div class="logout-block">' .
            $_SESSION['user']['login'] .
            '<a class="logout-href" href="../core/handle_logout.php">
                <div class="logout-button">Выйти</div>
             </a>
        </div>
    </div>
';
?>
