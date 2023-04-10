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
* @name API - Controller 
* @file APIController.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> // authenticate a user 
*    -|> 
*    -|> $apiController = new APIController();
*    -|> $response = $apiController->authUser($email, $password);
*    -|> 
*    -|> echo $response;
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// declare a namespace
namespace Maxaboom\Controllers;


// declare the class
class APIController {

  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   */
  public function __construct() {
    // TODO: write something awesome code here ;)
  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS
  // PUBLIC METHODS


  /**
   * Authenticates a user with the given `email` and `password`
   *
   * @param string $email - the email of the user
   * @param string $password - the password of the user
   *
   * @return string $response - the json representation of the response
   */
  public function authUser(string $email, string $password): string {
    return json_encode([
      'status' => 'success',
      'message' => 'User authenticated successfully',
      'data' => [
        'user' => [
          'id' => 1,
          'firstname' => 'Abraham',
          'lastname' => 'Ukachi',
          'email' => 'abraham.ukachi@laplateforme.io'
        ]
      ]
    ]);

  }


  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


};





