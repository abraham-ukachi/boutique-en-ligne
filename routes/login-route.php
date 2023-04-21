<?php
use Maxaboom\Controllers\LoginController;

$router->map( 'GET', '/login', function() {
    require __DIR__ . '/../views/login-page.php';
});


$router->map('POST', '/login', function() {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $loginController = new LoginController();
    $response = $loginController->connectUser($mail, $password);

    echo json_encode($response);
});
