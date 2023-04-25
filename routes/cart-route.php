<?php
use Maxaboom\Controllers\CartController;

// ------------------------for cart --------------------
$router->map( 'GET', '/cart', function() {
    $cartController = new CartController();
    $cartController->showPage();
});

$router->map( 'GET', '/cart/test', function() {
    $cartController = new CartController();
    $infoCart = $cartController->infoCart(11);
    require_once __DIR__ . '/../models/test/cart.php';

});

