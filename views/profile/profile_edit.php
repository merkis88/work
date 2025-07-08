<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать профиль</title>
</head>
<body>
<h1>Редактировать профиль</h1>

<form action="/work/profile_update" method="post">
    <div>
        <label>Имя</label>
        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? $user->name) ?>">
        <?php if (!empty($errors['name'])): ?>
            <div style="color:red"><?= htmlspecialchars($errors['name']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Email</label>
        <input type="text" name="email" value="<?= htmlspecialchars($old['email'] ?? $user->email) ?>">
        <?php if (!empty($errors['email'])): ?>
            <div style="color:red"><?= htmlspecialchars($errors['email']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Телефон</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($old['phone'] ?? $user->phone) ?>">
        <?php if (!empty($errors['phone'])): ?>
            <div style="color:red"><?= htmlspecialchars($errors['phone']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Новый пароль</label>
        <input type="password" name="password">
    </div>

    <div>
        <label>Повторите пароль</label>
        <input type="password" name="repeat_password">
        <?php if (!empty($errors['password'])): ?>
            <div style="color:red"><?= htmlspecialchars($errors['password']) ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Сохранить изменения</button>
</form>

<p><a href="/work/profile">Назад в профиль</a></p>
</body>
</html>
