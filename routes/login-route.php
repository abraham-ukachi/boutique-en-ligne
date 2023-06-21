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
* @name Login - Route
* @file login-route.php
* @author: Axel Vair <axel.vair@laplateforme.io>, 
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
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

// use maxaboom's `LoginController` class
use Maxaboom\Controllers\LoginController;






/**
 * ============================
 *  Login Routes
 * ============================
 */



/**
 * Route used to display the 'login' page
 * 
 * @method GET
 * @url /login
 *
 */
$router->map('GET', '/login', function() {

  // create an object of `LoginController` class
  $loginController = new LoginController();

  // if the user is already logged in
  if ($loginController->isUserLoggedIn()) {
    // redirect the user to the home page
    header('Location: ' . MAXABOOM_HOME_DIR);
    exit();
  }


  // show the login page
  $loginController->showPage();

}, 'login-page');




/**
 * Route used to connect a user
 *
 * @method POST
 * @url /login
 */
$router->map('POST', '/login', function() {
  // get the user's mail and password
  $mail = $_POST['mail'];
  $password = $_POST['password'];

  // instantiate the `LoginController` class
  $loginController = new LoginController();
  // login the user
  $loginController->login($mail, $password);
  // get the response
  $response = $loginController->getResponse();

  // echo the response as a json object
  echo json_encode($response);

}, 'login');
