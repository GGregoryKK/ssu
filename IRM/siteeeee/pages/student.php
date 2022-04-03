<?php
session_start();
include "../logic/handle_get_students_tests.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет студента</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="confirm-wrapper">
    <p>Ведите id теста, котрорый вы хотите пройти
        (уже пройденные тесты недоступны для повторного прохождения,
        результат их выполнения вы можете посмотреть в таблице ниже)
    </p>
    <form method="post" action="../logic/handle_find_test.php">
        <label><input type="text" name="testID" placeholder="ID теста"></label>
        <button type="submit" name="find-test">Пройти тест</button>
    </form>
</div>

<div class="table-wrapper">
    <table>
        <caption>Пройденные тесты</caption>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Процент верности</th>
            <th>Оценка</th>
        </tr>
        <?php
        for ($i = 0; $i < $numOfRows; ++$i) {
            echo '
                <tr>
                    <td>' . $tests[$i]['test'] . '</td>
                    <td>' . $tests[$i]['name'] . '</td>
                    <td>' .
                        round(
                            $tests[$i]['true_answers'] / ($tests[$i]['true_answers'] + $tests[$i]['false_answers']) * 100,
                            2
                        ) . '
                    </td>
                    <td>' . $tests[$i]['mark'] . '</td>
                </tr>
             ';
        }
        ?>
    </table>
</div>

</body>
</html>