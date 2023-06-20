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
* @name Address Model - Test
* @file address_model.php
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


// use the `Address` model class
use Maxaboom\Models\Address;
use Faker\Factory;

// use some PHP core classes
// use pdo;
// use pdoexception;


// Create an object of the `Factory` class
$faker = Factory::create('fr_FR'); // <- use the factory to create a Faker\Generator instance named `$faker`

// DEBUG [4dbsmaster]: tell me about it ;)
printf("\n\x1b[34m[Address - Model - Test]: Welcome 👋🏽 !!!\x1b[0m\n");



// TODO: define some variables here ;)


// check if there's a test argument passed to script
$hasTestArg = isset($argc) ? true : false;
// get the 1st argument variable as `testArg`
$testArg = isset($argv[1]) ? $argv[1] : '';



// ===================== TEST #1 ============================
// ===========[ DISPLAY A LIST OF ALL ADDRESSES ]============
// ==========================================================
// example 1: php addresss_model.php all 
// ----------------------------------------------------------



// If there's a test argument and it's `test1`...
if ($hasTestArg && in_array($testArg, ['all', 'test1'])) :
  // ...get all addresss using the `all()` static method
  $allAddresss = Address::all();
  
  // print the list of all addresss
  printf("\n\x1b[33m[AddressModel - Test]: Here's a list of all addresss:\x1b[0m\n");
    
  print_r($allAddresss);

endif; 
// <- ========[ End of Test #1 / all ]===========




// ===================== TEST #2 ========================
// ================[ CREATE A NEW ADDRESS ]================
// ======================================================
// example 1: php addresss_model.php create <userId> <title> <address>
// example 2: php addresss_model.php create 1 'My Home Address' '35 Boulevard de Paris'
// ------------------------------------------------------

if ($hasTestArg && in_array($testArg, ['create', 'test2'])) :
  // get the 2nd argument variable as `userId`
  $userId = isset($argv[2]) ? $argv[2] : 1;
   
  // get the 3rd argument variable as `addressTitle`
  $addressTitle = isset($argv[3]) ? $argv[3] : $faker->words(2, true);
  // get the 4th argument variable as `address`
  $address = isset($argv[4]) ? $argv[4] : $faker->streetAddress;

  // other fields
  $addressComplement = $faker->secondaryAddress;
  $postalCode = $faker->numerify('#####');
  $city = $faker->city;
  $country = strtolower($faker->country);
  
  // Create a new address with the fake data with the `create()` static method
  $newAddress = Address::create([
    'title' => $addressTitle, 
    'address' => $address, 
    'address_complement' => $addressComplement, 
    'postal_code' => $postalCode, 
    'city' => $city, 
    'country' => $country, 
    'user_id' => $userId
  ]);
  
  
  // If a new address was created...
  if ($newAddress->exists()) {
    // ...IDEA: log this address in a `address_create.log` file
    
    // get address_id and created_at variables
    $addressId = $newAddress->id;
    $createdAt = $newAddress->created_at;

    // Create a `log` string variable
    $log = sprintf(<<<LOG
    
    === "[New Address Created]" ===
    id: %d
    user_id: %d
    title: %s
    address: %s
    address_complement: %s
    postal_code: %d
    city: %s
    country: %s
    created_at: %s
    =========================

    LOG,

    $addressId,
    $userId,
    $addressTitle,
    $address,
    $addressComplement,
    $postalCode,
    $city,
    $country,
    $createdAt
    );

    // Append this `log` in a `address_create.log` file
    file_put_contents('address_create.log', $log, FILE_APPEND);

    // DEBUG [4dbsmaster]: tell me about the new address
    printf("\n\x1b[2m\x1b[33m[ADDRESS-MODEL](TEST2|CREATE): address Id.: (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m), title (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) and city / country: \x1b[0m\x1b[1m%s\x1b[2m\x1b[33m, etc... have been added to the database successfully :) \x1b[0m\n", $addressId, $addressTitle, $city . ' / ' . $country);

  } else { // <- error creating new address

    // DEBUG [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[ADDRESS-MODEL](TEST2|CREATE): Failed to create a new address :( \x1b[0m\n");
  }

endif; 
// <- ========[ End of Test #2 ]===========









// ================== TEST #3 ====================
// =============[ FIND AN ADDRESS ]================
// ===============================================
// example 1: php addresss_model.php find <addressId>
// example 2: php addresss_model.php find 1
// ------------------------------------------------

if ($hasTestArg && in_array($testArg, ['find', 'test3'])) :

  // get the 2nd argument variable as `addressId`
  $addressId = isset($argv[2]) ? $argv[2] : ''; // <- if it exists, use it, else use an empty string
  
  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[AddressID NOT Provided]" ====
  address_id: ???
  date_time: %s
  ======================

  LOG, date('Y-m-d H:i:s'));


  // If the `addressId` is not empty...
  if (!empty($addressId)) {
    // ...find one address with this `addressId`
    $address = Address::find($addressId);

    // if a address was found with that email...
    if ($address->exists()) { 
    // ...TEST [4dbsmaster]: tell me about the address
    printf("\n\x1b[2m\x1b[33m[ADDRESS-MODEL](TEST3|FIND): Address found ✅ (\x1b[0m\x1b[4m\x1b[33m%d\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $addressId);

    // print the address's info
    print_r($address->info());

    // Update the `$log`
    $log = sprintf(<<<LOG
    
    ==== "[Address Found]" ====
    address_id: %d
    date_time: %s
    ======================

    LOG, $addressId, date('Y-m-d H:i:s'));

    } else { // <- no address found with that email

      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[34m[ADDRESS-MODEL](TEST3|FIND): \x1b[0m\x1b[34mNo address found with this id (\x1b[0m\x1b[4m\x1b[34m%d\x1b[0m\x1b[2m\x1b[34m) :( \x1b[0m\n", $addressId);

      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[Address NOT Found]" ====
      address_id: %d
      date_time: %s
      ======================

      LOG, $addressId, date('Y-m-d H:i:s'));

    }


  } else { // <- no address id provided

    // TEST [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[ADDRESS-MODEL](TEST3|FIND): \x1b[0m\x1b[31mNo address id provided :( \x1b[0m\n");

  }


  // save the `$log` in a `address_find_one.log` file
  file_put_contents('address_get.log', $log, FILE_APPEND);

endif; 
// <- ========[ End of Test #3 ]===========



