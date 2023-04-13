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
* @name Database - Test
* @file database.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
*
*/


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MOTTO: We'll always do more 😜!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */

// ==== Display all PHP errors and warnings ====
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// =============================================

// declare the namespace of this models test
namespace Maxaboom\Models\Helpers\Test;

// require the `Database.php` file
require '../Database.php';


// Create a shortcut of the `Maxaboom\Models\Helpers` namespace as `mmh` (i.e. m = maxaboom & m = models & h = helpers)
use Maxaboom\Models\Helpers as mmh;
// use some PHP core classes
use pdo;
// use pdoexception;



// Instantiate an object of the `Database` class as `database`
$database = new mmh\Database();

// $database->setDatabaseUsername('abraham-ukachi');
// $database->setDatabasePassword('root');
// $database->setDatabasePort(80);


// connect to the database
$database->dbConnect();


// check connection
if ($database->db_connect_errno) {
  echo $database->db_connect_error;
  exit();
}

// DEBUG [4dbsmaster]: tell me about it ;)
printf("\n\x1b[34m[PDO]: ✅ Database connected successfully !!!\x1b[0m\n");


// DEBUG [4dbsmaster]: tell me about the `users` table ;)
// echo mmh\Database::TABLE_USERS;


// define some variables
$firstName = 'Abraham';
$lastName = 'Ukachi';
$email = 'abraham.ukachi@laplateforme.io';
$dob = '1991-07-25';
$createdAt = date('Y-m-d H:i:s');
$role = mmh\Database::ROLE_CUSTOMER;



// check if there's a test argument passed to script
$hasTestArg = isset($argc) ? true : false;
// get the 1st argument variable as `testArg`
$testArg = isset($argv[1]) ? $argv[1] : '';



// ===================== TEST #1 ========================
// ==[ FORMAT QUERY & INSERT 1 ROW INTO `users` TABLE ]==
// ======================================================

if ($hasTestArg && $testArg === 'test1') :

  // create a placeholder variable-function as `S`
  $S = 'strval';

  $query = "
    INSERT INTO `{$S(mmh\Database::TABLE_USERS)}` (

      `{$S(mmh\Database::FIELD_FIRST_NAME)}`, 
      `{$S(mmh\Database::FIELD_LAST_NAME)}`,
      `{$S(mmh\Database::FIELD_EMAIL)}`, 
      `{$S(mmh\Database::FIELD_BIRTH_DATE)}`, 
      `{$S(mmh\Database::FIELD_CREATED_AT)}`,
      `{$S(mmh\Database::FIELD_ROLE)}`
    ) 
    VALUES (
     '$firstName', 
     '$lastName', 
     '$email', 
     '$dob', 
     '$createdAt',
     '$role'
   )
  "; 
    
  $database->pdo->exec($query);

  printf("\x1b[33m[PDO](TEST1): ✅ $firstName has been added to the database successfully :) \x1b[0m");

endif; // <- ========[ End of Test #1 ]===========




// ===================== TEST #2 ========================
// ==[ FORMAT QUERY & INSERT 1 ROW INTO `users` TABLE ]==
// ======================================================

if ($hasTestArg && $testArg === 'test2') :

// create our sql query
$query = sprintf(<<<SQL
  INSERT INTO `%s` 
    (%s, %s, %s, %s, %s, %s)
  VALUES
    (?, ?, ?, ?, ?, ?)
  SQL, 

  // table
  mmh\Database::TABLE_USERS,

  // fields
  mmh\Database::FIELD_FIRST_NAME,
  mmh\Database::FIELD_LAST_NAME,
  mmh\Database::FIELD_EMAIL,
  mmh\Database::FIELD_BIRTH_DATE,
  mmh\Database::FIELD_CREATED_AT,
  mmh\Database::FIELD_ROLE
);

// DEBUG [4dbsmaster]: tell me about this query ;
printf("\n$query\n\n");


// prepare our sql query
$pdo_stmt = $database->pdo->prepare($query);
// bind the params
$pdo_stmt->bindParam(1, $firstName, PDO::PARAM_STR);
$pdo_stmt->bindParam(2, $lastName, PDO::PARAM_STR);
$pdo_stmt->bindParam(3, $email, PDO::PARAM_STR);
$pdo_stmt->bindParam(4, $dob, PDO::PARAM_STR);
$pdo_stmt->bindParam(5, $createdAt, PDO::PARAM_STR);
$pdo_stmt->bindParam(6, $role, PDO::PARAM_STR);

// execute the `query`
$result = $pdo_stmt->execute();

// DEBUG [4dbsmaster]: tell me about the result
var_dump($result);

if ($result) {
  printf("\x1b[33m[PDO](TEST2): ✅ $firstName has been added to the database successfully :) \x1b[0m");
}else {
  printf("\x1b[31m[PDO](TEST2): ❌ failed to $firstName to the database successfully :( \x1b[0m");
}

endif; // <- ========[ End of Test #2 ]===========
