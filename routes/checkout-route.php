<?php

namespace  Maxaboom\Routes;
use Maxaboom\Controllers\CheckoutController;

$router->map('GET', '/checkout', function(){
    $checkoutController = new CheckoutController();
    $checkoutController->showCheckoutPage();
})

?>