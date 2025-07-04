<?php

use App\Controller\RegistrationController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// маршруты
if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new RegistrationController())->showRegisterForm();
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    (new RegistrationController())->register();
} else {
    echo "<h1>Главная страница</h1>";
    echo "<a href='/register'>Регистрация</a>";
}
