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
* @name Register - Route
* @file register-route.php
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

// use maxaboom's `RegisterController` class
use Maxaboom\Controllers\RegisterController;






/**
 * ============================
 *  Register Routes
 * ============================
 */



/**
 * Route used to display the 'register' page
 * 
 * @method GET
 * @url /register
 *
 */
$router->map('GET', '/register', function() {
  // create an object of `RegisterController` class
  $registerController = new RegisterController();

  // if the user is already logged in
  if ($registerController->isUserLoggedIn()) {
    // redirect the user to the home page
    header('Location: ' . MAXABOOM_HOME_DIR);
    exit();
  }

  // show the register page
  $registerController->showPage();

}, 'register-page');




/**
 * Route used to connect a user
 *
 * @method POST
 * @url /register
 */
$router->map('POST', '/register', function() {
  // get the user's mail and password
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $mail = $_POST['mail'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  
  // instantiate the `RegisterController` class
  $registerController = new RegisterController();
  // register the user
  $registerController->register($firstname, $lastname, $mail, $password, $confirmPassword);
  // get the response
  $response = $registerController->getResponse();

  // echo the response as a json object
  echo json_encode($response);

}, 'register');
