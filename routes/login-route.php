<?php
use Maxaboom\Controllers\LoginController;

$router->map( 'GET', '/login', function() {
    require __DIR__ . '/../views/login-page.php';
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/login/test', function() {
    require __DIR__ . '/../models/test/login.php';
});

$router->map('POST', '/login/[*:mail]/[*:password]', function($mail, $password) {
    $response = ["statut" => "success"];

    echo json_encode($response);
});


$router->map('POST', '/login', function() {
    $data = json_decode(file_get_contents('php://input')); // {mail: exemple@mail.com, password: slkfjsl}
    $data = (array)$data; // ['mail' => 'exem...]

    $mail = $data['mail'];
    $password = $data['password'];


    $loginController = New LoginController();

    $response = $loginController->connectUser($mail, $password);

    echo json_encode($response);
});