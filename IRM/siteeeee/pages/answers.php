<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Просмотр ответов</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="table-wrapper">
    <table>
        <caption>Ответы студента</caption>
        <tr>
            <th>Вопрос</th>
            <th>Правильные ответы</th>
            <th>Ответ студента</th>
            <th>Верность</th>
        </tr>
        <?php
        for ($i = 0; $i < count($_SESSION['studentAnswers']); ++$i) {
            echo '
                <tr>
                    <td>' . $_SESSION['studentAnswers'][$i]['name'] . '</td>
                    <td>' . $_SESSION['studentAnswers'][$i]['answers'] . '</td>
                    <td>' . $_SESSION['studentAnswers'][$i]['answer'] . '</td>
                    <td>' . $_SESSION['studentAnswers'][$i]['mark'] . '</td>
                </tr>
             ';
        }
        ?>
    </table>
</div>

<div class="confirm-wrapper">
    <a href="tutor.php" class="menu-href"><div class="button">Назад</div></a>
</div>

</body>
</html>
