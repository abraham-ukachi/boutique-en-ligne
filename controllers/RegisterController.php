<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\User;

class RegisterController
{

    public object $user;

    public function __construct()
    {
        $this->user = new User();

    }

    public function showPage()
    {

        require __DIR__ . '/../views/register-page.php';
    }

    public function registerUser($firstname, $lastname, $mail, $password)
    {
        $success = $this->user->register($firstname, $lastname, $mail, $password);
        return ['success' => $success];
    }
}