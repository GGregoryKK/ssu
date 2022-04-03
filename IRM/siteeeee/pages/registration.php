<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/message.php" ?>

<div class="auth-form">
    <form method="post" action="../core/handle_registration.php">
        <label><input type="text" name="lastName" placeholder="Фамилия"></label>
        <label><input type="text" name="firstName" placeholder="Имя"></label>
        <label><input type="text" name="middleName" placeholder="Отчество"></label>
        <label>
            <select required name="role">
                <option value="1">Студент</option>
                <option value="2">Преподаватель</option>
            </select>
        </label>
        <label><input type="text" name="login" placeholder="Логин"></label>
        <label><input type="password" name="password" placeholder="Пароль"></label>
        <label><input type="password" name="confirmPassword" placeholder="Подтвердите пароль"></label>
        <button type="submit" name="register-button">Зарегестрироваться</button>
    </form>
    <p class="auth-redirect">Уже есть аккаунт? - <a href="login.php">Войдите</a>!</p>
</div>

</body>
</html>