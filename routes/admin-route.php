<?php

$router->map( 'GET', '/admin/product/create', function() {
    require __DIR__ . '/../views/admin-product-page.php';
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/admin/product/create/test', function() {
    require __DIR__ . '/../models/admin-product-page-test/product.php';
});

