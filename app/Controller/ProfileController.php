<?php

namespace App\Controller;
use App\Model\User;

class ProfileController
{
    public function profile() {

        if(!isset($_SESSION['user'])) {
            header("Location: /work/login");
            exit;
        }

        $user = User::find($_SESSION['user']);

        if (!$user) {
            echo "Пользоватль не найден";
            exit;
        }

        view('profile', ['user' => $user]);
    }
}