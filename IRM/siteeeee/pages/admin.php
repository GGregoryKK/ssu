<?php
session_start();
include "../logic/handle_get_all_users.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Панель администрирования</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/header.php" ?>

<?php include "../html_elements/message.php" ?>

<div class="table-wrapper">
    <table>
        <caption>Зарегестрированные пользователи</caption>
        <tr>
            <th>id</th>
            <th>ФИО</th>
            <th>Логин</th>
            <th>Роль</th>
        </tr>
        <?php
        for ($i = 0; $i < $numOfRows; ++$i) {
            echo
            '<tr>
                <td>' . $allUsers[$i]['userID'] . '</td>
                <td>' . $allUsers[$i]['lastName'] . ' ' . $allUsers[$i]['firstName'] . ' ' . $allUsers[$i]['middleName'] . '</td>
                <td>' . $allUsers[$i]['login'] . '</td>
                <td>' . $allUsers[$i]['role'] . '</td>
            </tr>';
        }
        ?>
    </table>
</div>

<div class="table-wrapper">
    <p>Редактировать пользователя</p>

    <form method="get" action="../logic/handle_find_user.php">
        <label><input type="text" name="login" placeholder="Логин" value="<?php echo $_SESSION['foundUser']['login'] ?>"></label>
        <button type="submit" name="find-user">Найти</button>
    </form>

    <form method="post" action="../logic/handle_edit_user.php">
        <label><input type="text" name="lastName" placeholder="Фамилия" value="<?php echo $_SESSION['foundUser']['lastName'] ?>"></label>
        <label><input type="text" name="firstName" placeholder="Имя" value="<?php echo $_SESSION['foundUser']['firstName'] ?>"></label>
        <label><input type="text" name="middleName" placeholder="Отчество" value="<?php echo $_SESSION['foundUser']['middleName'] ?>"></label>
        <label><input type="password" name="password" placeholder="Пароль"></label>
        <label>
            <select required name="role">
                <option value="0">Администратор</option>
                <option value="1">Студент</option>
                <option value="2">Преподаватель</option>
            </select>
        </label>
        <button type="submit" name="add-button">Применить изменения</button>
    </form>
</div>

</body>
</html>
