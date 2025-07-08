<?php

namespace App\Controller;

use App\Model\User;

class ProfileController
{
    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showProfile()
    {
        $this->startSession();

        if (empty($_SESSION['user'])) {
            header("Location: /work/login");
            exit;
        }

        $user = User::find($_SESSION['user']);
        if (!$user) {
            echo "Пользователь не найден";
            exit;
        }

        view('profile/profile', ['user' => $user]);
    }

    public function showUpdateProfile()
    {
        $this->startSession();

        if (empty($_SESSION['user'])) {
            header("Location: /work/login");
            exit;
        }

        $user = User::find($_SESSION['user']);
        if (!$user) {
            echo "Пользователь не найден";
            exit;
        }

        view('profile/profile_edit', ['user' => $user]);
    }

    public function updateProfile()
    {
        $this->startSession();

        if (empty($_SESSION['user'])) {
            header("Location: /work/login");
            exit;
        }

        $user = User::find($_SESSION['user']);
        if (!$user) {
            echo "Пользователь не найден";
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $repeatPassword = trim($_POST['repeat_password'] ?? '');

        $errors = [];

        if (!$name) {
            $errors['name'] = "Имя обязательно для заполнения";
        }

        if (!$email) {
            $errors['email'] = "Email обязателен для заполнения";
        } elseif ($email !== $user->email && User::where('email', $email)->exists()) {
            $errors['email'] = "Такой email уже существует";
        }

        if (!$phone) {
            $errors['phone'] = "Телефон обязателен для заполнения";
        } elseif ($phone !== $user->phone && User::where('phone', $phone)->exists()) {
            $errors['phone'] = "Такой телефон уже существует";
        }

        if ($password && $password !== $repeatPassword) {
            $errors['password'] = "Пароли не совпадают";
        }

        if (!empty($errors)) {
            view('profile/profile_edit', [
                'user' => $user,
                'errors' => $errors,
                'old' => [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone
                ]
            ]);
            exit;
        }

        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;

        if ($password) {
            $user->password = password_hash($password, PASSWORD_BCRYPT);
        }

        $user->save();

        $_SESSION['flash'] = "Данные успешно обновлены";
        header("Location: /work/profile");
        exit;
    }
}
