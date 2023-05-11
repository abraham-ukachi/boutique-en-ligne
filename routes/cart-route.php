<?php
/**
* @license MIT
* boutique-en-ligne (maxaboom)
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand. The Maxaboom Project Contributors.
* All rights reserved.
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @project boutique-en-ligne
* @name Cart - Route
* @file cart-route.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> //  
*    -|> 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// declare the `routes` namespace
namespace Maxaboom\Routes;

// use maxaboom's `CartController` class
use Maxaboom\Controllers\CartController;



// ####################
// ##  GET - ROUTES  ##
// ####################


/**
 * Route used to display the cart page
 *
 * @example  `/cart` will display the cart page
 *
 * @route /cart - the route to display the cart page
 */
$router->map('GET', '/cart', function() {
  // create an instance of the CartController as `$cartController`
  $cartController = new CartController();
  // call the `showPage()` method to display the cart page
  $cartController->showPage();
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



/**
 * Route used to get the total number of products in the cart
 *
 * @example  `/cart/total` will add the product with id 1 to the cart
 *
 * @param int $product_id - the id of the product to add to the cart
 */
$router->map('GET', '/cart/total', function() {
  // create an instance of the CartController
  $cartController = new CartController();
  // call the addToCart method and store the response
  $response = $cartController->getCartProductsTotal();
  
  // return the response as JSON
  echo json_encode($response);
});




$router->map( 'GET', '/cart/test', function() {
    $cartController = new CartController();
    $infoCart = $cartController->infoCart(11);
         require_once __DIR__ . '/../models/test/cart.php';
 });





/**
 * Route used to get a range of products from the cart
 *
 * @example (1) - `/cart/products/0/10` will get the first 10 products from the cart
 * @example (2) - `/cart/products/10/10` will get the next 10 products from the cart
 *
 * @route /cart/products/[i:start]/[i:limit] - the route to get a range of products from the cart
 *
 * @method GET
 *
 * @param int $start - the start index of the range
 * @param int $limit - the limit of the range
 */
$router->map('GET', '/cart/products/[i:start]/[i:limit]', function($start, $limit) {
  // instantiate the CartController
  $cartController = new CartController();

  // Get the products from the cart
  $products = $cartController->getProducts($start, $limit);

  // return the products as JSON
  echo json_encode($products);
});





/*
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
*/








// #######################
// ##  DELETE - ROUTES  ##
// #######################




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







// ########################
// ####  PUT - ROUTES  ####
// ########################



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





// ##########################
// ####  PATCH - ROUTES  ####
// ##########################



/**
 * Route used to update the quantity of a product in the cart
 *
 * @example  `/cart/increase/2` will increase the quantity of the product with id 2 in the cart
 *
 * @route /cart/[increase|decrease:action]/[i:product_id] - 
 *
 * @param string $action - the action to perform on the product quantity (increase|decrease)
 * @param int $product_id - the id of the product to update the quantity of
 */
$router->map('PATCH', '/cart/[increase|decrease:action]/[i:product_id]', function($action, $product_id) {
  // create an instance of the CartController
  $cartController = new CartController();

  // If the action is `increase`...
  if($action == 'increase') {
    // call the `increaseProductQuantity()` method and store the response
    $response = $cartController->increaseProductQuantity($product_id);
    // echo the response as JSON
    echo json_encode($response);
  }

  // If the action is `reduce`...
  if($action == 'decrease') {
    // ... call the `decreaseProductQuantity()` method and store the response
    $response = $cartController->decreaseProductQuantity($product_id);
    // echo the response as JSON
    echo json_encode($response);
  }

});


