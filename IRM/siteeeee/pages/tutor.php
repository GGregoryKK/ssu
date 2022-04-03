<?php
session_start();
include "../logic/handle_get_tutors_tests.php";
include "../logic/handle_get_tests_to_assessment.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет преподователя</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="table-wrapper">
    <table>
        <caption>Ваши тесты</caption>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        <?php
        for ($i = 0; $i < $numOfRows; ++$i) {
            echo '
                <tr>
                    <td>' . $allTests[$i]['testID'] . '</td>
                    <td>' . $allTests[$i]['name'] . '</td>
                    <td>
                        <form method="post" action="../logic/handle_edit_test.php">
                            <label><input type="text" name="testID" value="' . $allTests[$i]['testID'] . '" hidden></label>
                            <label><input type="text" name="name" value="' . $allTests[$i]['name'] . '" hidden></label>
                            <button type="submit" name="edit-test">Редактировать</button>
                        </form>
                    </td>
                </tr>
             ';
        }
        ?>
        <tr>
            <td></td>
            <td><label><input type="text" name="name" placeholder="Название теста" form="create-test"></label></td>
            <td>
                <form method="post" action="../logic/handle_create_test.php" id="create-test">
                    <button type="submit" name="create-test">Создать тест</button>
                </form>
            </td>
        </tr>
    </table>
</div>

<div class="table-wrapper">
    <table>
        <caption>
            <?php
            if ($_SESSION['foundResult'] == null)
                echo 'Все тесты для оценивания';
            else
                echo 'Найденные тесты для оценивания';
            ?>
        </caption>
        <tr>
            <th>ФИО</th>
            <th>Логин студента</th>
            <th>ID теста</th>
            <th>Название теста</th>
            <th>Процент верности</th>
            <th>Действия</th>
        </tr>
        <tr>
            <td>
                <label><input type="text" name="fullName" placeholder="ФИО" form="find-result"></label>
            </td>
            <td>
                <label><input type="text" name="login" placeholder="Логин студента" form="find-result"></label>
            </td>
            <td>
                <label><input type="text" name="testID" placeholder="ID теста" form="find-result"></label>
            </td>
            <td></td>
            <td></td>
            <td>
                <form method="get" action="../logic/handle_find_result.php" id="find-result">
                    <button type="submit" name="find-result">Найти результаты студента(ов) за тест(ы)</button>
                </form>
                <?php
                if ($_SESSION['foundResult'] != null) {
                    echo '
                        <form method="get" action="../logic/handle_find_result.php">
                            <button type="submit" name="find-all">Показать все результаты</button>
                        </form>
                    ';
                }
                ?>
            </td>
        </tr>
        <?php
        if ($_SESSION['foundResult'] == null) {
            for ($i = 0; $i < $numOfSolvedTests; ++$i) {
                echo '
                    <tr>
                        <td>' . $solvedTests[$i]['lastName'] . ' ' . $solvedTests[$i]['firstName'] . ' ' . $solvedTests[$i]['middleName'] . '</td>
                        <td>' . $solvedTests[$i]['login'] . '</td>
                        <td>' . $solvedTests[$i]['testID'] . '</td>
                        <td>' . $solvedTests[$i]['name'] . '</td>
                        <td>' .
                        round(
                            $solvedTests[$i]['true_answers'] / ($solvedTests[$i]['true_answers'] + $solvedTests[$i]['false_answers']) * 100,
                            2
                        ) . '
                        </td>
                        <td>
                            <form method="post" action="../logic/handle_view_solved_test.php">
                                <label><input type="text" name="user" value="' . $solvedTests[$i]['userID'] . '" hidden></label>
                                <label><input type="text" name="test" value="' . $solvedTests[$i]['testID'] . '" hidden></label>
                                <button type="submit" name="view-solved-test">Посмотреть работу</button>
                            </form>
                            <form method="post" action="../logic/handle_rate_solved_test.php">
                                <label><input type="text" name="user" value="' . $solvedTests[$i]['userID'] . '" hidden></label>
                                <label><input type="text" name="test" value="' . $solvedTests[$i]['testID'] . '" hidden></label>
                                <label><input type="text" name="mark" value="' . $solvedTests[$i]['mark'] . '" placeholder="Оценка"></label>
                                <button type="submit" name="mark-test">Оценить</button>
                            </form>
                            <form method="post" action="../logic/handle_one_more_time.php">
                                <label><input type="text" name="user" value="' . $solvedTests[$i]['userID'] . '" hidden></label>
                                <label><input type="text" name="test" value="' . $solvedTests[$i]['testID'] . '" hidden></label>
                                <button type="submit" name="one-more-time">Дать еще попытку</button>
                            </form>
                        </td>
                    </tr>
                ';
            }
        } else {
            for ($i = 0; $i < count($_SESSION['foundResult']); ++$i) {
                echo '
                    <tr>
                        <td>' . $_SESSION['foundResult'][$i]['lastName'] . ' ' . $_SESSION['foundResult'][$i]['firstName'] . ' ' . $_SESSION['foundResult'][$i]['middleName'] . '</td>
                        <td>' . $_SESSION['foundResult'][$i]['login'] . '</td>
                        <td>' . $_SESSION['foundResult'][$i]['testID'] . '</td>
                        <td>' . $_SESSION['foundResult'][$i]['name'] . '</td>
                        <td>' .
                        round(
                            $_SESSION['foundResult'][$i]['true_answers'] / ($_SESSION['foundResult'][$i]['true_answers'] + $_SESSION['foundResult'][$i]['false_answers']) * 100,
                            2
                        ) . '
                        </td>
                        <td>
                            <form method="post" action="../logic/handle_view_solved_test.php">
                                <label><input type="text" name="user" value="' . $_SESSION['foundResult'][$i]['userID'] . '" hidden></label>
                                <label><input type="text" name="test" value="' . $_SESSION['foundResult'][$i]['testID'] . '" hidden></label>
                                <button type="submit" name="view-solved-test">Посмотреть работу</button>
                            </form>
                            <form method="post" action="../logic/handle_rate_solved_test.php">
                                <label><input type="text" name="user" value="' . $_SESSION['foundResult'][$i]['userID'] . '" hidden></label>
                                <label><input type="text" name="test" value="' . $_SESSION['foundResult'][$i]['testID'] . '" hidden></label>
                                <label><input type="text" name="mark" value="' . $_SESSION['foundResult'][$i]['mark'] . '" placeholder="Оценка"></label>
                                <button type="submit" name="mark-test">Оценить</button>
                            </form>
                            <form method="post" action="../logic/handle_one_more_time.php">
                                <label><input type="text" name="user" value="' . $_SESSION['foundResult'][$i]['userID'] . '" hidden></label>
                                <label><input type="text" name="test" value="' . $_SESSION['foundResult'][$i]['testID'] . '" hidden></label>
                                <button type="submit" name="one-more-time">Дать еще попытку</button>
                            </form>
                        </td>
                    </tr>
                 ';
            }
        }
        ?>
    </table>
</div>

</body>
</html>