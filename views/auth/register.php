<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>
    <h2>Регистрация</h2>

    <form method="post" action="/register">
        <div>
            <label>Имя</label>
            <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '')?>">

            <?php if (!empty($errors['name'])): ?>
                <div style="color: red"><?= htmlspecialchars($errors['name']) ?></div>
            <?php endif; ?>
        </div>

        <div>
            <label>Email</label>
            <input type="text" name="email" value="<?= htmlspecialchars($old['name'] ?? '')?>">

            <?php if (!empty($errors['email'])): ?>
                <div style="color: red"><?= htmlspecialchars($errors['email']) ?> </div>
            <?php endif; ?>
        </div>

        <div>
            <label>Телефон</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '')?>">

            <?php if (!empty($errors['phone'])): ?>
                <div style="color: red"><?= htmlspecialchars($errors['phone']) ?> </div>
            <?php endif; ?>
        </div>

        <div>
            <label>Пароль</label>
            <input type="password" name="password">
        </div>

        <div>
            <label>Повторение пароля</label>
            <input type="password" name="repeat_password" value="<?= htmlspecialchars($old['password'] ?? '')?>">

            <?php if (!empty($errors['password'])): ?>
                <div style="color: red"><?= htmlspecialchars($errors['password']) ?> </div>
            <?php endif; ?>
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>

    <p><a href="/login">Войти</a></p>
</body>
</html>