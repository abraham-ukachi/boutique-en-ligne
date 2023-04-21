<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\User;

class LoginController{
    public object $user;

    public function __construct() {
        $this->user = New User();
    }

    public function connectUser($mail, $password){
        $success = $this->user->connection($mail, $password);
        return ['success' => $success];
    }
}