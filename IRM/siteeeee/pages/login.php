<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>

<?php include "../html_elements/message.php" ?>

<div class="auth-form">
    <form method="post" action="../core/handle_login.php">
        <label><input type="text" name="login" placeholder="Логин"></label>
        <label><input type="password" name="password" placeholder="Пароль"></label>
        <button type="submit" name="login-button">Войти</button>
    </form>
    <p class="auth-redirect">Нет аккаунта? - <a href="registration.php">Зарегестрируйтесь</a>!</p>
</div>

</body>
</html>