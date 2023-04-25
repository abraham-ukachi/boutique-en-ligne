<?php
use Maxaboom\Controllers\AdminController;

// ------------------------for cart --------------------
$router->map( 'GET', '/cart', function() {
    require_once __DIR__ . '/../views/cart-page.php';
 });


 ?>