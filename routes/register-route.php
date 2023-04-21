<?php
use Maxaboom\Controllers\RegisterController;

$router->map( 'GET', '/register', function() {
    require __DIR__ . '/../views/register-page.php';
});


$router->map('POST', '/register', function (){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['check-password'];

    $registerController = New RegisterController();
    $response = $registerController->registerUser($firstname, $lastname, $mail, $password, $passwordConfirm);

    echo json_encode($response);

});


/*
$router->map('POST', '/register/[a:firstname]/[a:lastname]/[*:mail]/[*:password]/[*:passwordConfirm]', function($firstname, $lastname, $mail, $password, $passwordConfirm) {
    $response = ["statut" => "success"];

    echo json_encode($response);
});
*/
/*
$router->map('POST', '/register', function() {
    $data = json_decode(file_get_contents('php://input')); // {mail: exemple@mail.com, password: slkfjsl}
    $data = (array)$data; // ['mail' => 'exem...]
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $mail = $data['mail'];
    $password = $data['password'];
    $passwordConfirm = $data['passwordConfirm'];



    $registerController = New RegisterController();

    $response = $registerController->registerUser($firstname, $lastname, $mail, $password, $passwordConfirm);

    echo json_encode($response);
});

*/