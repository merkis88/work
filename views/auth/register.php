<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/work/public/css/register.css">


</head>
<body>
<h2>Регистрация</h2>

<form method="post" action="/work/register">
    <div>
        <label>Имя</label>
        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
        <?php if (!empty($errors['name'])): ?>
            <div style="color: red"><?= htmlspecialchars($errors['name']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Email</label>
        <input type="text" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
        <?php if (!empty($errors['email'])): ?>
            <div style="color: red"><?= htmlspecialchars($errors['email']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Телефон</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
        <?php if (!empty($errors['phone'])): ?>
            <div style="color: red"><?= htmlspecialchars($errors['phone']) ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label>Пароль</label>
        <input type="password" name="password">
    </div>

    <div>
        <label>Повторение пароля</label>
        <input type="password" name="repeat_password">
        <?php if (!empty($errors['password'])): ?>
            <div ><?= htmlspecialchars($errors['password']) ?></div>
        <?php endif; ?>
    </div>

    <div class="smart-captcha" data-sitekey="<?= htmlspecialchars($siteKey) ?>"></div>
    <?php if (!empty($errors['captcha'])): ?>
        <div style="color:red"><?= htmlspecialchars($errors['captcha']) ?></div>
    <?php endif; ?>

    <button type="submit">Зарегистрироваться</button>
</form>
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

<p><a href="/work/login">Войти</a></p>
</body>
</html>
