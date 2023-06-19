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
* @project boutique-en-ligne (maxaboom)
* @name Order Model - Test
* @file order_model.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
*
*/


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MOTTO: I'll always do more 😜!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */



// declare the namespace of this models test
namespace App\Model\Test;


// ==== Display all PHP errors and warnings ====
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// =============================================


// require the `autoload.php` file
require_once __DIR__ . '../../../vendor/autoload.php';

// set the default timezone to 'Europe/Paris'
date_default_timezone_set('Europe/Paris');
// start the session
session_start();


// use the `Order` models 
use Maxaboom\Models\Order;
use Faker\Factory;

// use some PHP core classes
//use pdo;
// use pdoexception;


// Create an object of the `Factory` class
$faker = Factory::create('fr_FR'); // <- use the factory to create a Faker\Generator instance named `$faker`

// DEBUG [4dbsmaster]: tell me about it ;)
printf("\n\x1b[34m[OrderModel - Test]: Welcome 👋🏽 !!!\x1b[0m\n");



// TODO: define some variables here ;)


// check if there's a test argument passed to script
$hasTestArg = isset($argc) ? true : false;
// get the 1st argument variable as `testArg`
$testArg = isset($argv[1]) ? $argv[1] : '';



// ===================== TEST #1 ========================
// ===========[ DISPLAY A LIST OF ALL ORDERS ]============
// ======================================================

// If there's a test argument and it's `test1`...
if ($hasTestArg && in_array($testArg, ['all', 'test1'])) :
  // ...get all orders using the `all()` static method
  $allOrders = Order::all();
  
  // print the list of all orders
  printf("\n\x1b[33m[OrderModel - Test]: Here's a list of all orders:\x1b[0m\n");

  print_r($allOrders);
    

endif; 
// <- ========[ End of Test #1 / findAll ]===========




// ===================== TEST #2 ========================
// ================[ CREATE A NEW ORDER ]================
// ======================================================
// example 1: php orders_model.php create <userId> <orderStatus> <addressId> <cardId> <paymentMethod> <deliveryMethod>
// example 2: php orders_model.php create 123456789 pending 1 2 visa standard
// ------------------------------------------------------

if ($hasTestArg && in_array($testArg, ['create', 'test2'])) :
  // get the 2nd argument variable as `userId`
  $userId = isset($argv[2]) ? $argv[2] : 1;
  // get the 3rd argument variable as `status`
  $status = isset($argv[3]) ? $argv[3] : 'pending';
  // get the 4th argument variable as `addressId`
  $addressId = isset($argv[4]) ? $argv[4] : 1;
  // get the 5th argument variable as `cardId`
  $cardId = isset($argv[5]) ? $argv[5] : 1;
  // get the 6th argument variable as `paymentMethod`
  $paymentMethod = isset($argv[6]) ? $argv[6] : 'visa'; // <- other payment method examples: 'paypal' | 'stripe' | 'mastercard'
  // get the 7th argument variable as `deliveryMethod`
  $deliveryMethod = isset($argv[7]) ? $argv[7] : 'standard'; // <- other delivery method examples: 'express' | 'premium' | 'standard'

  // create the `total` price variable
  $total = 100.00;
  // create a discount percentage variable
  $discountPercentage = 10;
  // create a total discounted variable
  $totalDiscounted = $total - ($total * ($discountPercentage / 100)); // <- eg.: round(100 - (100 * (10 / 100)), 2) = 90.00 
  // create a `taxAmount` variable
  $taxAmount = 25.00;
  // create a `deliveryAmount` variable
  $deliveryAmount = 10.00;
  // create a `totalPrice` variable
  $totalPrice = $totalDiscounted + $taxAmount + $deliveryAmount; // <- eg.: 90.00 + 25.00 + 10.00 = 125.00

  // generate a random id
  $generatedOrderId = Order::generateId();

  // create a new order with the fake data
  $newOrder = Order::create([
    'id' => $generatedOrderId,
    'user_id' => $userId, 
    'status' => $status, 
    'address_id' => $addressId, 
    'card_id' => $cardId, 
    'payment_method' => $paymentMethod, 
    'delivery_method' => $deliveryMethod, 
    'total' => $total, 
    'discount_percentage' => $discountPercentage, 
    'total_discounted' => $totalDiscounted, 
    'tax_amount' => $taxAmount, 
    'delivery_amount' => $deliveryAmount, 
    'total_price' => $totalPrice
  ]);

  // If a new order was created...
  if ($newOrder->exists()) {
    // ...IDEA: log this order in a `order_create.log` file
    
    // get order_id and created_at variables
    $orderId = $newOrder->id;
    $createdAt = $newOrder->created_at;

    // Create a `log` string variable
    $log = sprintf(<<<LOG
    
    === "[New Order Created]" ===
    id: %d
    user_id: %d
    status: %s
    address_id: %d
    card_id: %d
    payment_method: %s
    total: %f
    discount_percentage: %d
    total_discounted: %f
    tax_amount: %f
    delivery_amount: %f
    total_price: %f
    created_at: %s
    =========================

    LOG,

    $orderId,
    $userId,
    $status,
    $addressId,
    $cardId,
    $paymentMethod,
    $total,
    $discountPercentage,
    $totalDiscounted,
    $taxAmount,
    $deliveryAmount,
    $totalPrice,
    $createdAt

    );

    // Append this `log` in a `order_create.log` file
    file_put_contents('order_create.log', $log, FILE_APPEND);

    // DEBUG [4dbsmaster]: tell me about the new order
    printf("\n\x1b[2m\x1b[33m[ORDER-MODEL](TEST2|CREATE): order No. (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m) and status (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) w/ totalPrice: \x1b[0m\x1b[1m%f\x1b[2m\x1b[33m, etc... have been added to the database successfully :) \x1b[0m\n", $orderId, $status, $totalPrice);

  } else { // <- error creating new order

    // DEBUG [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[ORDER-MODEL](TEST2|CREATE): Failed to create a new order :( \x1b[0m\n");
  }

endif; 
// <- ========[ End of Test #2 ]===========









// ================== TEST #3 ====================
// =============[ FIND AN ORDER ]================
// ===============================================
// example 1: php orders_model.php find <orderId>
// example 2: php orders_model.php find 123456789
// ------------------------------------------------

if ($hasTestArg && in_array($testArg, ['find', 'test3'])) :

  // get the 2nd argument variable as `orderId`
  $orderId = isset($argv[2]) ? $argv[2] : ''; // <- if it exists, use it, else use an empty string
  
  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[OrderID NOT Provided]" ====
  order_id: ???
  date_time: %s
  ======================

  LOG, date('Y-m-d H:i:s'));


  // If the `orderId` is not empty...
  if (!empty($orderId)) {
    // ...find one order with this `orderId`
    $order = Order::find($orderId);

    // if a order was found with that email...
    if ($order->exists()) { 
    // ...TEST [4dbsmaster]: tell me about the order
    printf("\n\x1b[2m\x1b[33m[ORDER-MODEL](TEST3|FIND): Order found ✅ (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $orderId);

    // print the order's info
    print_r($order->info());

    // Update the `$log`
    $log = sprintf(<<<LOG
    
    ==== "[Order Found]" ====
    order_id: %d
    date_time: %s
    ======================

    LOG, $orderId, date('Y-m-d H:i:s'));

    } else { // <- no order found with that email

      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[34m[ORDER-MODEL](TEST3|FIND): \x1b[0m\x1b[34mNo order found with this id (\x1b[0m\x1b[4m\x1b[34m%d\x1b[0m\x1b[2m\x1b[34m) :( \x1b[0m\n", $orderId);

      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[Order NOT Found]" ====
      order_id: %d
      date_time: %s
      ======================

      LOG, $orderId, date('Y-m-d H:i:s'));

    }


  } else { // <- no order id provided

    // TEST [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[ORDER-MODEL](TEST3|FIND): \x1b[0m\x1b[31mNo order id provided :( \x1b[0m\n");

  }


  // save the `$log` in a `order_find_one.log` file
  file_put_contents('order_find.log', $log, FILE_APPEND);

endif; 
// <- ========[ End of Test #3 ]===========



