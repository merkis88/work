<?php

namespace App\Controller;
use App\Model\User;

class LoginController
{
    private $siteKey = 'ysc1_jtdEE7euosNTMM4bm0RbBdL7puGJc5Kt3ZagmcC4193009e2';
    private $secret = 'ysc2_jtdEE7euosNTMM4bm0RbKEOrR2XnxGtmSFqeCpKvac61a986';

    public function showLoginForm()
    {
        view('auth/login', [
            'siteKey' => $this->siteKey
        ]);
    }

    public function login()
    {
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
            'siteKey' => $this->siteKey
        ]);
    }

    private function verifyCaptcha($token)
    {
        if (!$token) return false;

        $secret = $this->secret;
        $response = file_get_contents("https://smartcaptcha.yandexcloud.net/validate?secret=$secret&token=$token");
        $result = json_decode($response, true);

        return isset($result['status']) && $result['status'] === 'ok';
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: /work/login");
        exit;
    }
}
