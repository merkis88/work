<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
</head>
<body>
<h1>Добро пожаловать на сайт!</h1>

<p>
    <?php if (empty($_SESSION['user'])): ?>
        <a href="/work/register">Регистрация</a> |
        <a href="/work/login">Вход</a> |
    <?php else: ?>
        <a href="/work/profile">Профиль</a> |
        <a href="/work/logout">Выйти</a>
    <?php endif; ?>
</p>

</body>
</html>
