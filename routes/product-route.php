<?php

$router->map( 'GET', '/product', function() {
    require __DIR__ . '/../views/product-page.php';
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/product/test', function() {
    require __DIR__ . '/../models/test/product.php';
});