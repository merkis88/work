<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="/work/public/css/home.css">
</head>
<body>
<div class="home-container">
    <h1>Добро пожаловать на сайт!</h1>
    <p>
        <?php if (empty($_SESSION['user'])): ?>
            <a class="button-link" href="/work/register">Регистрация</a>
            <a class="button-link" href="/work/login">Вход</a>
        <?php else: ?>
            <a class="button-link" href="/work/profile">Профиль</a>
            <a class="button-link" href="/work/logout">Выйти</a>
        <?php endif; ?>
    </p>
</div>
</body>
</html>
