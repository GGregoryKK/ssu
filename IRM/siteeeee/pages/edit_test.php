<?php
session_start();
include "../logic/handle_get_test_questions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест <?= $_SESSION['editTest']['name'] ?></title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="table-wrapper">
    <p><b><?= $_SESSION['editTest']['name'] ?></b></p>
    <table>
        <caption>Вопросы теста</caption>
        <tr>
            <th>id</th>
            <th>Вопрос</th>
            <th>Варианты ответов</th>
            <th>Действия</th>
        </tr>
        <?php
        for ($i = 0; $i < $numOfRows; ++$i) {
            echo '
                <tr>
                    <td>' . $testQuestions[$i]['questionID'] . '</td>
                    <td>' . $testQuestions[$i]['name'] . '</td>
                    <td>' . $testQuestions[$i]['answers'] . '</td>
                    <td>
                        <form method="post" action="../logic/handle_delete_question.php">
                            <label><input type="text" name="questID" value="' . $testQuestions[$i]['questionID'] . '" hidden></label>
                            <button type="submit" name="delete-question">Удалить</button>
                        </form>
                    </td>
                </tr>
             ';
        }
        ?>
        <tr>
            <td></td>
            <td><label><input type="text" name="name" placeholder="Вопрос" form="create-question"></label></td>
            <td><label><input type="text" name="answers" placeholder="Варианты ответа" form="create-question"></label></td>
            <td>
                <form method="post" action="../logic/handle_create_question.php" id="create-question">
                    <button type="submit" name="create-question">Добавить вопрос</button>
                </form>
            </td>
        </tr>
    </table>
</div>

<div class="confirm-wrapper">
    <form method="post" action="../logic/handle_end_test_edition.php">
        <button type="submit" name="end-test-edition">Закончить редактирование</button>
    </form>
</div>

</body>
</html>
