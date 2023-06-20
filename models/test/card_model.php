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
* @name Card Model - Test
* @file card_model.php
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


// use the `Card` model class
use Maxaboom\Models\Card;
use Faker\Factory;

// use some PHP core classes
// use pdo;
// use pdoexception;


// Create an object of the `Factory` class
$faker = Factory::create('fr_FR'); // <- use the factory to create a Faker\Generator instance named `$faker`

// DEBUG [4dbsmaster]: tell me about it ;)
printf("\n\x1b[34m[Card - Model - Test]: Welcome 👋🏽 !!!\x1b[0m\n");



// TODO: define some variables here ;)


// check if there's a test argument passed to script
$hasTestArg = isset($argc) ? true : false;
// get the 1st argument variable as `testArg`
$testArg = isset($argv[1]) ? $argv[1] : '';



// ===================== TEST #1 ============================
// ===========[ DISPLAY A LIST OF ALL CARDS ]============
// ==========================================================
// example 1: php card_model.php all 
// ----------------------------------------------------------



// If there's a test argument and it's `test1`...
if ($hasTestArg && in_array($testArg, ['all', 'test1'])) :
  // ...get all cards using the `all()` static method
  $allCards = Card::all();
  
  // print the list of all cards
  printf("\n\x1b[33m[CardModel - Test]: Here's a list of all cards:\x1b[0m\n");
    
  print_r($allCards);

endif; 
// <- ========[ End of Test #1 / all ]===========




// ===================== TEST #2 ========================
// ================[ CREATE A NEW CARD ]================
// ======================================================
// example 1: php card_model.php create <userId> <type>
// example 2: php card_model.php create 1 'visa'
// ------------------------------------------------------

if ($hasTestArg && in_array($testArg, ['create', 'test2'])) :
  // get the 2nd argument variable as `userId`
  $userId = isset($argv[2]) ? $argv[2] : 1;
   
  // get the 3rd argument variable as `cardType`
  $cardType = isset($argv[3]) ? strtolower($argv[3]) : 'visa';

  // other fields
  $cardNumber = $faker->numerify('################');
  $expiryMonth = $faker->month;
  $expiryYear = $faker->year;
  $cvv = $faker->numerify('###');

  
  // Create a new card with the fake data with the `create()` static method
  $newCard = Card::create([
    'type' => $cardType, 
    'user_id' => $userId, 
    'card_no' => $cardNumber,
    'expiry_month' => $expiryMonth, 
    'expiry_year' => $expiryYear, 
    'cvv' => $cvv
  ]);
  
   
  // If a new card was created...
  if ($newCard->exists()) {
    // ...IDEA: log this card in a `card_create.log` file
    
    // get card_id and created_at variables
    $cardId = $newCard->id;
    $createdAt = $newCard->created_at;

    // Create a `log` string variable
    $log = sprintf(<<<LOG
    
    === "[New Card Created]" ===
    id: %d
    type: %s
    user_id: %d
    card_no: %d
    expiry_month: %d
    expiry_year: %d
    cvv: %d
    created_at: %s
    =========================

    LOG,

    $cardId,
    $cardType,
    $userId,
    $cardNumber,
    $expiryMonth,
    $expiryYear,
    $cvv,
    $createdAt
    );

    // Append this `log` in a `card_create.log` file
    file_put_contents('card_create.log', $log, FILE_APPEND);

    // DEBUG [4dbsmaster]: tell me about the new card
    printf("\n\x1b[2m\x1b[33m[CARD-MODEL](TEST2|CREATE): card Id.: (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m), type (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) and number: \x1b[0m\x1b[1m%d\x1b[2m\x1b[33m, etc... have been added to the database successfully :) \x1b[0m\n", $cardId, $cardType, $cardNumber);

  } else { // <- error creating new card

    // DEBUG [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[CARD-MODEL](TEST2|CREATE): Failed to create a new card :( \x1b[0m\n");
  }

endif; 
// <- ========[ End of Test #2 ]===========









// ================== TEST #3 ====================
// =============[ FIND A CARD ]==================
// ===============================================
// example 1: php card_model.php find <cardId>
// example 2: php card_model.php find 1
// ------------------------------------------------

if ($hasTestArg && in_array($testArg, ['find', 'test3'])) :

  // get the 2nd argument variable as `cardId`
  $cardId = isset($argv[2]) ? $argv[2] : ''; // <- if it exists, use it, else use an empty string
  
  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[CardID NOT Provided]" ====
  card_id: ???
  date_time: %s
  ======================

  LOG, date('Y-m-d H:i:s'));


  // If the `cardId` is not empty...
  if (!empty($cardId)) {
    // ...find one card with this `cardId`
    $card = Card::find($cardId);

    // if a card was found with that email...
    if ($card->exists()) { 
    // ...TEST [4dbsmaster]: tell me about the card
    printf("\n\x1b[2m\x1b[33m[CARD-MODEL](TEST3|FIND): Card found ✅ (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $cardId);

    // print the card's info
    print_r($card->info());

    // Update the `$log`
    $log = sprintf(<<<LOG
    
    ==== "[Card Found]" ====
    card_id: %d
    date_time: %s
    ======================

    LOG, $cardId, date('Y-m-d H:i:s'));

    } else { // <- no card found with that email

      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[34m[CARD-MODEL](TEST3|FIND): \x1b[0m\x1b[34mNo card found with this id (\x1b[0m\x1b[4m\x1b[34m%d\x1b[0m\x1b[2m\x1b[34m) :( \x1b[0m\n", $cardId);

      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[Card NOT Found]" ====
      card_id: %d
      date_time: %s
      ======================

      LOG, $cardId, date('Y-m-d H:i:s'));

    }


  } else { // <- no card id provided

    // TEST [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[CARD-MODEL](TEST3|FIND): \x1b[0m\x1b[31mNo card id provided :( \x1b[0m\n");

  }


  // save the `$log` in a `card_find_one.log` file
  file_put_contents('card_find.log', $log, FILE_APPEND);

endif; 
// <- ========[ End of Test #3 ]===========



