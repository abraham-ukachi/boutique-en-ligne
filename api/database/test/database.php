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


// Require the 'Database.php' file [once] ;)
require_once '../Database.php';

// Create shortcut of the `Api\classDatabase` namespace as `mbDB` (maxaboom database #lol);
// use Api\classDatabase as mbDB;

// Instantiate an object of the `Database` class as `database`
$database = new Api\classDatabase\Database();

database->setDatabaseUsername('abraham-ukachi');
$database->setDatabasePassword('root');
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


// Uncomment the code block below, to add a new user to the `users` table
// $database->db->exec("
//  INSERT INTO `users` (login, password, email, firstname, lastname) 
//  VALUES ('abrahama-ukachi', 'jesus', 'abraham.ukachi@laplateforme.io', 'Abraham', 'Ukachi')
//");
