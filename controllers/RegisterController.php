<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\User;

class RegisterController{

    public function registerUser($firstname, $lastname, $mail, $password, $passwordConfirm){
        $user = New User();
        $success = $user->register($firstname, $lastname, $mail, $password, $passwordConfirm);

        return ['success' => $success];

    }
}