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
* @name Order Item - Model - Test
* @file order-item_model.php
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
namespace Maxaboom\Models\Test;


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


// use the `OrderItem` models 
use Maxaboom\Models\OrderItem;
use Faker\Factory;

// use some PHP core classes
// use pdo;
// use pdoexception;


// Create an object of the `Factory` class
$faker = Factory::create('fr_FR'); // <- use the factory to create a Faker\Generator instance named `$faker`

// DEBUG [4dbsmaster]: tell me about it ;)
printf("\n\x1b[34m[OrderItem - Model - Test]: Welcome 👋🏽 !!!\x1b[0m\n");



// TODO: define some variables here ;)


// check if there's a test argument passed to script
$hasTestArg = isset($argc) ? true : false;
// get the 1st argument variable as `testArg`
$testArg = isset($argv[1]) ? $argv[1] : '';



// ===================== TEST #1 ========================
// ===========[ DISPLAY A LIST OF ALL ORDERS ]============
// ======================================================
// example 1: php order-item_model.php all
// example 2: php order-item_model.php test1
// ------------------------------------------------------

// If there's a test argument and it's `test1`...
if ($hasTestArg && in_array($testArg, ['all', 'test1'])) :
  // ...get all orders using the `all()` static method
  $allOrderItems = OrderItem::all();
  
  // print the list of all orders
  printf("\n\x1b[33m[OrderItem - Model - Test]: Here's a list of all order items:\x1b[0m\n");

  print_r($allOrderItems);


endif; 
// <- ========[ End of Test #1 / all ]===========




// ======================== TEST #2 ==========================
// ================[ CREATE A NEW ORDER ITEM ]================
// ===========================================================
// example 1: php order-item_model.php create <orderId> <?productId> <?quantity> <?unitPrice>
// example 2: php order-item_model.php create 1234532 1 2 10.00
// -----------------------------------------------------------

if ($hasTestArg && in_array($testArg, ['create', 'test2'])) :
  // get the 2nd argument variable as `orderId`
  $orderId = $argv[2];
  
  // get the 3rd argument variable as `productId`
  $productId = isset($argv[3]) ? $argv[3] : $faker->numerify('#');
  // get the 4th argument variable as `quantity`
  $quantity = isset($argv[4]) ? $argv[4] : $faker->randomDigitNot(0);
  // get the 5th argument variable as `unitPrice`
  $unitPrice = isset($argv[5]) ? $argv[5] : $faker->numerify('###.##');


  // create a new order with the fake data
  $newOrderItem = OrderItem::create([
    'order_id' => $orderId, 
    'product_id' => $productId, 
    'quantity' => $quantity, 
    'unit_price' => $unitPrice
  ]);

  // If a new order item was created...
  if ($newOrderItem->exists()) {
    // ...IDEA: log this order in a `order-item_create.log` file
    
    // get order-item_id and created_at variables
    $orderItemId = $newOrderItem->id;

    // Create a `log` string variable
    $log = <<<LOG
    
    === "[New Order Item Created]" ===
    id: $orderItemId
    order_id: $orderId
    product_id: $productId
    quantity: $quantity
    unit_price: $unitPrice
    =========================

    LOG;

    // Append this `log` in a `order-item_create.log` file
    file_put_contents('order-item_create.log', $log, FILE_APPEND);

    // DEBUG [4dbsmaster]: tell me about the new order item
    printf("\n\x1b[2m\x1b[33m[ORDER-ITEM-MODEL](TEST2|CREATE): order-item id (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m), orderId / productId (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) & quantity: \x1b[0m\x1b[1m%10.2f\x1b[2m\x1b[33m, etc... have been added to the database successfully :) \x1b[0m\n", $orderItemId, $orderId . '/' . $productId, $quantity);

  } else { // <- error creating new order item

    // DEBUG [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[ORDER-ITEM-MODEL](TEST2|CREATE): Failed to create a new order item :( \x1b[0m\n");
  }

endif; 
// <- ========[ End of Test #2 ]===========









// ===================== TEST #3 =======================
// ===============[ FIND AN ORDER ITEM ]================
// =====================================================
// example 1: php order-item_model.php find <orderItemId>
// example 2: php order-item_model.php find 1
// -----------------------------------------------------

if ($hasTestArg && in_array($testArg, ['find', 'test3'])) :

  // get the 2nd argument variable as `orderItemId`
  $orderItemId = isset($argv[2]) ? $argv[2] : ''; // <- if it exists, use it, else use an empty string
  
  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[OrderItem ID NOT Provided]" ====
  order_item_id: ???
  date_time: %s
  ======================

  LOG, date('Y-m-d H:i:s'));


  // If the `orderItemId` is not empty...
  if (!empty($orderItemId)) {
    // ...find one order with this `orderItemId`
    $orderItem = OrderItem::find($orderItemId);
    
    // if a order item was found with that email...
    if ($orderItem->exists()) { 
    // ...TEST [4dbsmaster]: tell me about the order
    printf("\n\x1b[2m\x1b[33m[ORDER-ITEM-MODEL](TEST3|FIND): Order item found ✅ (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $orderItemId);

    // print the order item's info
    print_r($orderItem->info());

    // Update the `$log`
    $log = sprintf(<<<LOG
    
    ==== "[Order Item Found]" ====
    order_item_id: %d
    date_time: %s
    ======================

    LOG, $orderItemId, date('Y-m-d H:i:s'));

    } else { // <- no order found with that email

      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[34m[ORDER-ITEM-MODEL](TEST3|FIND): \x1b[0m\x1b[34mNo order-item found with this id (\x1b[0m\x1b[4m\x1b[34m%d\x1b[0m\x1b[2m\x1b[34m) :( \x1b[0m\n", $orderItemId);

      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[Order Item NOT Found]" ====
      order_item_id: %d
      date_time: %s
      ======================

      LOG, $orderItemId, date('Y-m-d H:i:s'));

    }


  } else { // <- no order id provided

    // TEST [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[ORDER-ITEM-MODEL](TEST3|FIND): \x1b[0m\x1b[31mNo order-item id provided :( \x1b[0m\n");

  }


  // save the `$log` in a `order-item_find.log` file
  file_put_contents('order-item_find.log', $log, FILE_APPEND);

endif; 
// <- ========[ End of Test #3 ]===========



