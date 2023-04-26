<?php
use Maxaboom\Controllers\CartController;

// ------------------------for cart --------------------
$router->map( 'GET', '/cart', function() {
    $cartController = new CartController();
    $cartController->showPage(27);
});

$router->map('GET', '/cart/[increase|reduce:action]/[i:product_id]', function($action, $product_id) {
    $cartController = new CartController();
    if($action=='increase'){
        $response = $cartController->increaseQuantity($product_id);
        echo json_encode($response);
    }

    if($action=='reduce'){
        $response = $cartController->reduceQuantity($user_id, $product_id);
        echo json_encode($response);
    }
});


$router->map('PATCH', '/cart/[increase|reduce:action]/[i:user_id]/[i:product_id]', function($action, $user_id, $product_id) {
    $cartController = new CartController();
    if($action=='increase'){
        $response = $cartController->increaseQuantity($user_id, $product_id);
        echo json_encode($response);
    }
    if($action=='reduce'){
        $response = $cartController->reduceQuantity($user_id, $product_id);
        echo json_encode($response);
    }
    //echo $response; 
});






$router->map( 'GET', '/cart/test', function() {
    $cartController = new CartController();
    $infoCart = $cartController->infoCart(11);
         require_once __DIR__ . '/../models/test/cart.php';
 });

