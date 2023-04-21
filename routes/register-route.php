<?php
use Maxaboom\Controllers\RegisterController;

$router->map( 'GET', '/register', function() {
    $registerController = New RegisterController();
    $registerController->showPage();
});

$router->map('POST', '/register', function (){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['check-password'];

    $registerController = New RegisterController();
    $response = $registerController->registerUser($firstname, $lastname, $mail, $password);

    echo json_encode($response);

});
