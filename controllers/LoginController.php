<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\User;

class LoginController{

    public function connectUser($mail, $password){
        $user = New User();
        $success = $user->connection($mail, $password);

        return ['success' => $success];

    }
}