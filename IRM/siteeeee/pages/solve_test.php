<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест <?= $_SESSION['testToSolve']['name'] ?></title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="table-wrapper">
    <p><b>Тест: <?= $_SESSION['testToSolve']['name'] ?></b></p>
    <?php
    for ($i = 0; $i < $_SESSION['testToSolve']['numOfQuestions']; ++$i) {
        if ($_SESSION['testToSolve']['questions'][$i]['state'] == 0) {
            echo '
            <div class="question-answer-block">
                <form method="post" action="../logic/handle_answer_question.php">
                    <label><input type="text" name="questNum" value="' . $i . '" hidden></label>
                    <p class="question">Вопрос: ' . $_SESSION['testToSolve']['questions'][$i]['question']['name'] . '</p>
                    <label><input type="text" name="answer" placeholder="Ваш ответ"></label>
                    <button type="submit" name="answer-question">Сохранить</button>
                </form>
            </div>
        ';
        }
    }
    ?>
</div>

<div class="confirm-wrapper">
    <form method="post" action="../logic/handle_finish_test.php">
        <button type="submit" name="finish-test">Завершить тест</button>
    </form>
</div>

</body>
</html>