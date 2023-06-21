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
* @name User Model - Test
* @file user_model.php
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


// use the `User` model
use Maxaboom\Models\User;
use Faker\Factory;

// use some PHP core classes
//use pdo;
// use pdoexception;


// Create an object of the `User` class as `usersModel`
$usersModel = new User();
$faker = Factory::create('fr_FR'); // <- use the factory to create a Faker\Generator instance named `$faker`

// DEBUG [4dbsmaster]: tell me about it ;)
printf("\n\x1b[34m[User - Test]: Welcome 👋🏽 !!!\x1b[0m\n");



// TODO: define some variables here ;)


// check if there's a test argument passed to script
$hasTestArg = isset($argc) ? true : false;
// get the 1st argument variable as `testArg`
$testArg = isset($argv[1]) ? $argv[1] : '';



// ===================== TEST #1 ========================
// ===========[ DISPLAY A LIST OF ALL USERS ]============
// ======================================================

// If there's a test argument and it's `test1`...
if ($hasTestArg && in_array($testArg, ['findAll', 'test1'])) :
  // ...get all users using the `displayUsers()` method
  // TODO: Rename this method to `findAll()`
  $allUsers = $usersModel->displayUsers();
  
  // print the list of all users
  printf("\n\x1b[33m[User - Test]: Here's a list of all users:\x1b[0m\n");

  print_r($allUsers);
    

endif; 
// <- ========[ End of Test #1 / findAll ]===========




// =========================== TEST #2 ===============================
// =====================[ CREATE A NEW USER ]=========================
// ===================================================================
// @example 1: php user_model_test create <userRole> <email> <password>
// @example 2: php user_model_test create customer <email> <password>
// ------------------------------------------------------

if ($hasTestArg && in_array($testArg, ['create', 'createUser', 'test2'])) :

  // get the 2nd argument variable as `userRole`
  $userRole = isset($argv[2]) ? $argv[2] : 'customer';

  // generate some fake user data with a unique email
  $firstName = $faker->firstName();
  $lastName = $faker->lastName();
  $email = isset($argv[3]) ? $argv[3] : $faker->email();
  $password = isset($argv[4]) ? $argv[4] : $faker->password();
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
  // create a new user with the fake data
  // $newUser = $usersModel->createUser($firstName, $lastName, $email, $hashedPassword, null, $userRole);

  $newUser = User::create([
    'firstname' => $firstName,
    'lastname' => $lastName,
    'mail' => $email,
    'password' => $hashedPassword,
    'user_role' => $userRole
  ]);
  

  // If a new user was created...
  if ($newUser->exists()) {
    // ...IDEA: log this user in a `test2.log` file
    
    // Create a `log` string variable
    $log = sprintf(<<<LOG
    
    === "[New User Created]" ===
    id: %d
    email: %s
    first_name: %s
    last_name: %s
    password: %s
    hashedPassword: %s
    role: %s
    =========================

    LOG,

    $newUser->id,
    $email,
    $firstName,
    $lastName,
    $password,
    $hashedPassword,
    $userRole

    );

    // Append this `log` in a `test2.log` file
    file_put_contents('test2.log', $log, FILE_APPEND);

    // DEBUG [4dbsmaster]: tell me about the new user
    printf("\n\x1b[2m\x1b[33m[USERS-MODEL](TEST2|CREATE): newUser->id (\x1b[0;4;33m%d\x1b[0;2;33m) & email (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) and password (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) of \x1b[0m\x1b[1m%s\x1b[2m\x1b[33m have been added to the database successfully :) \x1b[0m\n", $newUser->id, $email, $password, $firstName . ' ' . $lastName);

  } else { // <- error creating new user

    // DEBUG [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[USERS-MODEL](TEST2|CREATE): Failed to create a new user :( \x1b[0m\n");
  }

endif; 
// <- ========[ End of Test #2 ]===========









// ===================== TEST #3 ========================
// ==============[ FIND A USER BY EMAIL ]================
// ======================================================

// TODO: Rename the `verifUser()` method to `findByEmail()`

if ($hasTestArg && in_array($testArg, ['findByEmail', 'verifUser', 'test3'])) :

  // get the 2nd argument variable as `userEmail`
  $userEmail = isset($argv[2]) ? $argv[2] : ''; // <- if it exists, use it, else use an empty string

  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[Email NOT Provided]" ====
  email: ???
  date_time: %s
  ======================

  LOG, date('Y-m-d H:i:s'));


  // If the `userEmail` is not empty...
  if (!empty($userEmail)) {
    // ...find the user with that email as `user`
    $user = $usersModel->verifUser($userEmail);

    
    // if a user was found with that email...
    if ($user) { 
    // ...TEST [4dbsmaster]: tell me about the user
    //printf("\n\x1b[2m\x1b[33m[USERS-MODEL](TEST3|FINDBYEMAIL): Here's the user with email (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $userEmail);
    printf("\n\x1b[2m\x1b[33m[USERS-MODEL](TEST3|FINDBYEMAIL): Email found ✅ (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $userEmail);

    // print the user
    // print_r($user);


    // Update the `$log`
    $log = sprintf(<<<LOG
    
    ==== "[User Found]" ====
    email: %s
    date_time: %s
    ======================

    LOG, $userEmail, date('Y-m-d H:i:s'));

    } else { // <- no user found with that email

      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[34m[USERS-MODEL](TEST3|FINDBYEMAIL): \x1b[0m\x1b[34mNo user found with email (\x1b[0m\x1b[4m\x1b[34m%s\x1b[0m\x1b[2m\x1b[34m) :( \x1b[0m\n", $userEmail);

      
      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[User NOT Found]" ====
      email: %s
      date_time: %s
      ======================

      LOG, $userEmail, date('Y-m-d H:i:s'));

    }


  } else { // <- no email provided

    // TEST [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[USERS-MODEL](TEST3|FINDBYEMAIL): \x1b[0m\x1b[31mNo email provided :( \x1b[0m\n");

  }


  // save the `$log` in a `test3.log` file
  file_put_contents('test3.log', $log, FILE_APPEND);

endif; 
// <- ========[ End of Test #3 ]===========




// ======================= TEST #4 ========================
// =============[ CONNECT A REGISTERED USER ]==============
// ========================================================

// TODO: Rename the `connection()` method to `connect()`

if ($hasTestArg && in_array($testArg, ['connect', 'test4'])) :

  // get the 2nd argument variable as `userEmail`
  $userEmail = isset($argv[2]) ? $argv[2] : ''; // <- if it exists, use it, else use an empty string

  // get the 3rd argument variable as `userPassword`
  $userPassword = isset($argv[3]) ? $argv[3] : ''; // <- if it exists, use it, else use an empty string



  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[User NOT Connected ❌]" ====
  email: %s
  password: %s
  date_time: %s
  ======================

  LOG, 
  $userEmail, $userPassword,
  date('Y-m-d H:i:s'));


  // If the email and password are not empty...
  if (!empty(trim($userEmail)) && !empty(trim($userPassword))) {
    // ...try to connect the user
    try {
      // connect the user
      // $user = $usersModel->connection($userEmail, $userPassword);
      $user = User::connect([
        'mail' => $userEmail,
        'password' => $userPassword
      ]);

      // user is connected if `user` is not FALSE
      $userIsConnected = $user !== false;

      // If the user is connected...
      if ($userIsConnected) {
        // ...TEST [4dbsmaster]: tell me about the user
        printf("\n\x1b[2m\x1b[33m[USERS-MODEL](TEST4|CONNECT): \x1b[0m\x1b[33mUser with email (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m) is connected :) \x1b[0m\n", $userEmail);

        // print the user
        print_r($user->info());

        // update the `$log` 
        $log = sprintf(<<<LOG

        ==== "[User Connected ✅]" ====
        id: %d
        email: %s
        password: %s
        date_time: %s
        ======================

        LOG,
        -1, $userEmail, $userPassword,
        date('Y-m-d H:i:s'));
          
      }else { // <- user is not connected

        // update the `$log` 
        $log = sprintf(<<<LOG

        ==== "[Connected Failed 😢]" ====
        email: %s
        password: %s
        date_time: %s
        ======================

        LOG,
        $userEmail, $userPassword,
        date('Y-m-d H:i:s'));


        // DEBUG [4dbsmaster]: tell me about the error
        printf("\n\x1b[2m\x1b[31m[USERS-MODEL](TEST4|CONNECT): \x1b[0m\x1b[31mFailed to connect the user with email (\x1b[0m\x1b[4m\x1b[31m%s\x1b[0m\x1b[2m\x1b[31m) :( Try again ! \x1b[0m\n", $userEmail);
      }

    } catch (Exception $e) {
      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[31m[USERS-MODEL](TEST4|CONNECT): \x1b[0m\x1b[31m%s \x1b[0m\n", $e->getMessage());
    }


    // log the result in a `test4.log` file
    file_put_contents('test4.log', $log, FILE_APPEND);

  } else { // <- email or password is empty

    // DEBUG [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[USERS-MODEL](TEST4|CONNECT): \x1b[0m\x1b[31mEmail or password is empty :( \x1b[0m\n");
  }


endif; 
// <- ========[ End of Test #4 ]===========




// ================== TEST #5 =======================
// ===========[ SAVE USER PROPERTY  ]================
// ==================================================
// @example: php user_model.php save 1 mail <new_mail>
// --------------------------------------------------

// If there's a test argument and get `where` or `test5`...
if ($hasTestArg && in_array($testArg, ['save', 'test5'])) :

  // get the 2nd argument variable as `userId`
  $userId = isset($argv[2]) ? $argv[2] : '';

  // get the 3rd argument variable as `propName`
  $propName = isset($argv[3]) ? $argv[3] : '';

  // get the 4th argument variable as `propValue`
  $propValue = isset($argv[4]) ? $argv[4] : '';

  
  // Initialize a `log` variable
  $log = sprintf(<<<LOG
  
  ==== "[ID NOT Provided]" ====
  id: ???
  date_time: %s
  ======================
  
  LOG, date('Y-m-d H:i:s'));


  // If the `userId` is not empty...
  if (!empty($userId)) {
    // ...find the user with the `userId`
    $user = User::find($userId);

    
    // if a user was found...
    if ($user->id) {

      // ...change the `propName` property to `propValue`
      $user->$propName = $propValue;

      // save the changes
      $user->save();

      // DEBUG [4dbsmaster]: tell me about the user
      printf("\n\x1b[2m\x1b[33m[USER-MODEL](TEST5|SAVE): The user with id [%d] has a new $propName: (\x1b[0m\x1b[4m\x1b[33m%s\x1b[0m\x1b[2m\x1b[33m):\x1b[0m\n", $user->id, $user->$propName);
    
      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[User %s Saved]" ====
      id: %s
      %s: %s
      mail: %s
      date_time: %s
      ========================

      LOG, $propName, $user->id, $propName, $propValue, $user->mail, date('Y-m-d H:i:s'));
      
    } else { // <- no user found with the given `userId`
      
      // DEBUG [4dbsmaster]: tell me about the error
      printf("\n\x1b[2m\x1b[34m[USER-MODEL](TEST5|SAVE): \x1b[0m\x1b[34mNo user found with that id (\x1b[0m\x1b[4m\x1b[34m%s\x1b[0m\x1b[2m\x1b[34m) :( \x1b[0m\n", $userId);
       
      // Update the `$log`
      $log = sprintf(<<<LOG
      
      ==== "[User NOT Found]" ====
      id: %s
      date_time: %s
      ======================

      LOG, $userId, date('Y-m-d H:i:s'));

    }


  } else { // <- no user id provided

    // TEST [4dbsmaster]: tell me about the error
    printf("\n\x1b[2m\x1b[31m[USER-MODEL](TEST5|SAVE): \x1b[0m\x1b[31mUser Id not provided :( \x1b[0m\n");

  }


  // Append this `log` in a `user_model_find.log` file
  file_put_contents('logs/user_model_save.log', $log, FILE_APPEND);


  
endif;
// <- ========[ End of Test #5 / save ]===========




