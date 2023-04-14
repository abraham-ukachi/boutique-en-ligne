<?php

$router->map( 'GET', '/login', function() {
    require __DIR__ . '/../views/login-page.php';
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/login/test', function() {
    require __DIR__ . '/../models/test/login.php';
});