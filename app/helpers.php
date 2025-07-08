<?php

function view(string $path, array $data = []): void
{
    $file = __DIR__ . '/../views/' . $path . '.php';

    if (!file_exists($file)) {
        http_response_code(500);
        echo "Не найдено";
        exit;
    }

    extract($data);
    require $file;
}