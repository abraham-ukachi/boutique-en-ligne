<?php


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/address/test', function() {
    require __DIR__ . '/../models/test/address.php';
});