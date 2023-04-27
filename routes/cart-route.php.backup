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






/**
 * Route used to remove a product from the cart
 *
 * @example: `/cart/1` will remove the product with id 1 from the cart
 *
 * @route /cart/[i:product_id] - the route to remove a product from the cart
 * @param int $product_id - the id of the product to remove from the cart
 */
$router->map('DELETE', '/cart/[i:product_id]', function($product_id) {
  // create an instance of the CartController
  $cartController = new CartController();
  // call the `removeFromCart()` method and store the response
  $response = $cartController->removeFromCart($product_id);
  
  // return the response as JSON
  echo json_encode($response);
});


/**
 * Route used to add a product to the cart
 *
 * @example  `/cart/1` will add the product with id 1 to the cart
 *
 * @route /cart/[i:product_id] - the route to add a product to the cart
 * @param int $product_id - the id of the product to add to the cart
 */
$router->map('PUT', '/cart/[i:product_id]', function($product_id) {
  // create an instance of the CartController
  $cartController = new CartController();
  // call the addToCart method and store the response
  $response = $cartController->addToCart($product_id);
  
  // return the response as JSON
  echo json_encode($response);
});





$router->map( 'GET', '/cart/test', function() {
    $cartController = new CartController();
    $infoCart = $cartController->infoCart(11);
         require_once __DIR__ . '/../models/test/cart.php';
 });

