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
* @name Password - Controller 
* @file PasswordController.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>,
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
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


// declare a namespace
namespace Maxaboom\Controllers;

// use the `CommonPassword` and `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\CommonPassword;
use Maxaboom\Controllers\Helpers\ResponseHandler;





/**
 * The PasswordController class
 *
 * NOTE: This class is a controller for all password endpoints (routes)
 */
class PasswordController {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;

  // declare some constants...

  // declare some properties...

  // private properties
  // private CommonPassword $commonPassword;


  // public properties
  

  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   */
  public function __construct() {
    
    // instantiate the `CommonPassword` helper class 
    // $this->commonPassword = CommonPassword::getInstance();

  }


  // PUBLIC SETTERS

  // PUBLIC GETTERS

  // PUBLIC METHODS


  /**
   * Checks if the given `$password` is a common one ;)
   *
   * @return array : the response
   */
  public function findCommonPassword($password): array {
    // find the common password
    $commonPassword = CommonPassword::find($password);

    // get the success, status and message based on if the password is common or not
    $success = $commonPassword->isCommon();
    $status = $success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_BAD_REQUEST;
    $message = $success ? 'The password is common' : 'The password is not common';
    $data = $success ? $commonPassword->info() : [];

    // update the response
    $this->updateResponse($success, $status, $message, $data);

    // return the response
    return $this->getResponse();

  }


  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS

}
