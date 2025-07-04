<?php

namespace App\Controller;
use App\Model\User;

class RegistrationController
{
    public function showRegisterForm() {
        view('auth/register');
    }

    public function register() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $repeatPassword = trim($_POST['repeat_password'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        $errors = [];

        if (!$name) {
            $errors['name'] = "Имя обязаительно для заполнения";
        }

        if (!$email) {
            $errors['email'] = "Email обязаителен для заполнения";
        } elseif (User::where('email', $email)->exists()) {
            $errors['email'] = "Такой email уже сущетсвутет";
        }

        if (!$password || !$repeatPassword) {
            $errors['password'] = "Пароль обязаителен для заполнения";
        } elseif ($password !== $repeatPassword) {
            $errors['password'] = "Пароли не совпадают";
        }

        if (!$phone) {
            $errors['phone'] = "Номер телнфона обязаителен для заполнения";
        } elseif (User::where('phone', $phone)->exists()) {
            $errors['phone'] = "Такой номер телефона уже существует";
        }


        if (empty($errors)) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'phone' => $phone
            ]);

            header("Location: /public/login");
            exit;
        }

        view('auth/register', [
            'errors' => $errors,
            'old' => [
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]
        ]);

    }
}



