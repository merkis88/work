<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>
</head>
<body>

    <h1>Профиль</h1>
    <h2>Добро пожаловать, <?= htmlspecialchars($user->name)?></h2>

    <p><a href="/work/logout">Выйти</a></p>
</body>
</html>