<?php

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../app/helpers.php";
require_once __DIR__ . "/../routes/web.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

echo getenv('SMARTCAPTCHA_SITEKEY');
