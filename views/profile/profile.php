<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="/work/public/css/profile.css">
</head>
<body>
<div class="profile-container">
    <h1>Профиль</h1>
    <h2>Добро пожаловать, <?= htmlspecialchars($user->name) ?></h2>
    <h2>Ваш email: <?= htmlspecialchars($user->email) ?></h2>
    <h2>Ваш телефон: <?= htmlspecialchars($user->phone) ?></h2>

    <a class="button-link" href="/work/profile_edit">Редактировать профиль</a><br><br>
    <a class="button-link" href="/work/logout">Выйти</a>
</div>
</body>
</html>
