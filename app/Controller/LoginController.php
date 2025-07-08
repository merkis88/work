<?php

namespace App\Controller;
use App\Model\User;

class LoginController
{
    public function showLoginForm()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        view('auth/login', [
            'siteKey' => getenv('SMARTCAPTCHA_SITEKEY')
        ]);
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;

        $login = trim($_POST['phone'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $captchaToken = $_POST['smart-token'] ?? '';

        $errors = [];
        $showCaptcha = $_SESSION['login_attempts'] >= 3;

        if (!$login) {
            $errors['login'] = "Введите номер телефона или email";
        }

        if (!$password) {
            $errors['password'] = "Введите пароль";
        }

        if ($showCaptcha && !$this->verifyCaptcha($captchaToken)) {
            $errors['captcha'] = "Подтвердите, что вы не робот.";
        }

        if (empty($errors)) {
            $user = User::where('email', $login)->orWhere('phone', $login)->first();
            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = $user->id;
                $_SESSION['login_attempts'] = 0;
                header("Location: /work/profile");
                exit;
            } else {
                $_SESSION['login_attempts']++;
                $errors['login'] = 'Неверные данные для входа';
            }
        }

        view('auth/login', [
            'errors' => $errors,
            'old' => ['login' => $login],
            'showCaptcha' => $showCaptcha,
            'siteKey' => getenv('SMARTCAPTCHA_SITEKEY')
        ]);
    }

    private function verifyCaptcha($token)
    {
        if (!$token) return false;

        $secret = getenv('SMARTCAPTCHA_SECRET');
        $response = file_get_contents("https://smartcaptcha.yandexcloud.net/validate?secret=$secret&token=$token");
        $result = json_decode($response, true);

        return isset($result['status']) && $result['status'] === 'ok';
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: /work/login");
        exit;
    }
}
