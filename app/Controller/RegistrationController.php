<?php

namespace App\Controller;

use App\Model\User;
use App\Validators\NameValidator;
use App\Validators\EmailValidator;
use App\Validators\PhoneValidator;
use App\Validators\PasswordValidator;


class RegistrationController
{
    private $siteKey = 'ysc1_jtdEE7euosNTMM4bm0RbBdL7puGJc5Kt3ZagmcC4193009e2';
    private $secret = 'ysc2_jtdEE7euosNTMM4bm0RbKEOrR2XnxGtmSFqeCpKvac61a986';

    public function showRegisterForm()
    {
        view('auth/register', [
            'siteKey' => $this->siteKey
        ]);
    }

    public function register()
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $repeatPassword = trim($_POST['repeat_password'] ?? '');
        $captchaToken = $_POST['smart-token'] ?? '';

        $errors = [];

        if (!NameValidator::validateName($name)) {
            $errors['name'] = "Имя обязательно для заполнения";
        }

        if (!EmailValidator::validateEmail($email)) {
            $errors['email'] = "Email обязателен для заполнения или не корректный ";
        } elseif (User::where('email', $email)->exists()) {
            $errors['email'] = "Такой email уже существует";
        }

        if (!PhoneValidator::validatePhone($phone)) {
            $errors['phone'] = "Телефон должен быть в формате +7XXXXXXXXXX";
        } elseif (User::where('phone', $phone)->exists()) {
            $errors['phone'] = "Такой телефон уже существует";
        }

        if (!PasswordValidator::validatePassword($password)) {
            $errors['password'] = "Пароль должен содержать не менее 4 символов";
        } elseif ($password !== $repeatPassword) {
            $errors['password'] = "Пароли не совпадают";
        }

        if (!$this->verifyCaptcha($captchaToken)) {
            $errors['captcha'] = "Подтвердите, что вы не робот.";
        }

        if (empty($errors)) {
            User::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            header("Location: /work/login");
            exit;
        }

        view('auth/register', [
            'errors' => $errors,
            'old' => [
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ],
            'siteKey' => $this->siteKey
        ]);
    }

    private function verifyCaptcha($token)
    {
        if (!$token) return false;

        $secret = $this->secret;
        $data = http_build_query([
            'secret' => $secret,
            'token' => $token
        ]);

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => $data,
                'timeout' => 5
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents('https://smartcaptcha.yandexcloud.net/validate', false, $context);

        if ($result === FALSE) {
            return false;
        }

        $data = json_decode($result, true);
        return isset($data['status']) && $data['status'] === 'ok';
    }
}
