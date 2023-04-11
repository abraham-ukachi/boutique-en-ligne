<?php

namespace Maxaboom\Models\Test;

include "../helpers/Database.php";
include "../User.php";

use Maxaboom\Models\User;
use Maxaboom\Models\Helpers\Database;

$user = new User();

$firstname  = "Lala";
$lastname = "Lily";
$email = "lala@gmail.com";
$password = "azerty";
$user_role = Database::ROLE_CUSTOMER;
$user->register($firstname, $lastname, $email, $password, $user_role);

