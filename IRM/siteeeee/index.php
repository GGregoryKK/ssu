<?php
session_start();
require "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>

<div class="header-wrapper">
    <div class="title">
        <a class="title-href" href="index.php"><h3><?= $config['title'] ?></h3></a>
    </div>

    <?php
    if ($_SESSION['user']) {
        echo '
            <div class="logout-block">' .
                $_SESSION['user']['login'] . '
                <a class="logout-href" href="core/handle_logout.php">
                    <div class="logout-button">Выйти</div>
                </a>
            </div>
        ';
    } else {
        echo '
            <div>
                <a class="logout-href" href="core/handle_login.php">
                    <div class="logout-button">Войти</div>
                </a>
                <a class="logout-href" href="core/handle_registration.php">
                    <div class="logout-button">Зарегестрироваться</div>
                </a>
            </div>
        ';
    }
    ?>
</div>

<?php include "html_elements/message.php" ?>

<div class="menu">
    <?php
    if ($_SESSION['user']) {
        switch ($_SESSION['user']['role']) {
            case 0:
                echo '
                    <a href="pages/admin.php" class="menu-href">
                        <div class="menu-item">
                            <p class="item-name"><b>Войти в панель администрирования</b></p>
                            <p class="prompt">Позволяет редактировать существующих пользователей</p>
                        </div>
                    </a>
                ';
                break;
            case 1:
                echo '
                    <a href="pages/student.php" class="menu-href">
                        <div class="menu-item">
                            <p class="item-name"><b>Войти в кабинет студента</b></p>
                            <p class="prompt">Позволяет искать тесты по ID и проходить их, смотреть оценки за пройденные тесты</p>
                        </div>
                    </a>
                ';
                break;
            case 2:
                echo '
                    <a href="pages/tutor.php" class="menu-href">
                        <div class="menu-item">
                            <p class="item-name"><b>Войти в кабинет преподователя</b></p>
                            <p class="prompt">Позволяет создавать и редактировать тесты, оценивать пройденные студентами тесты и давать студентам больше попыток для прохождения</p>
                        </div>
                    </a>
                ';
                break;
        }
    }
    ?>
    <a href="task.html" class="menu-href">
        <div class="menu-item">
            <p class="item-name"><b>Открыть постановку задачи</b></p>
            <p class="prompt">Перейти к описанию проекта и его функционала</p>
        </div>
    </a>
</div>

</body>
</html>
