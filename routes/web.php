<?php

use App\Controller\RegistrationController;
use App\Controller\LoginController;
use App\Controller\ProfileController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/work', '', $uri);
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/' && $method === 'GET') {
    echo "<h1>Главная</h1>";
    echo "<p><a href='/work/register'>Регистрация</a> | <a href='/work/login'>Вход</a></p>";

} elseif ($path === '/register' && $method === 'GET') {
    (new RegistrationController())->showRegisterForm();
} elseif ($path === '/register' && $method === 'POST') {
    (new RegistrationController())->register();

} elseif ($path === '/login' && $method === 'GET') {
    (new LoginController())->showLoginForm();
} elseif ($path === '/login' && $method === 'POST') {
    (new LoginController())->login();
} elseif ($path === '/logout' && $method === 'GET') {
    (new LoginController())->logout();

} elseif ($path === '/profile' && $method === 'GET') {
    (new ProfileController())->profile();


} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
}
