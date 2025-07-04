<?php

namespace App\Http\Controllers;
use App\Model\User;

class  LoginController
{
    public function showLoginForm() {
        view('auth/login');
    }

    public function login() {
        session_start();

        $login = trim($_POST['phone'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $errors = [];

        if (!$login) {
            $errors['login'] = "Введите номер телефона";
        }

        if (!$password) {
            $errors['password'] = "Введите пароль";
        }

        if (empty($errors)) {
            $user = User::where('email', $login)->orWhere('phone', $login)->first();

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = $user->id;
                header("Location: /profile");
                exit;
            } else {
                $errors['phone'] = 'Неверные данные для входа';
            }
        }

        view('auth/login', [
           'errors' => $errors,
           'old' => [
               'login' => $login,
           ]
        ]);
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /");
        exit;
    }
}