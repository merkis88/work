<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
<h1>Вход</h1>

<form action="/work/login" method="POST">
    <div>
        <label>Телефон или Email</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($old['login'] ?? '') ?>">
        <?php if (!empty($errors['login'])): ?>
            <div style="color:red"><?= htmlspecialchars($errors['login']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Пароль</label>
        <input type="password" name="password">
        <?php if (!empty($errors['password'])): ?>
            <div style="color:red"><?= htmlspecialchars($errors['password']) ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Войти</button>
</form>

<p>Нет аккаунта? <a href="/work/register">Зарегистрироваться</a></p>
</body>
</html>
