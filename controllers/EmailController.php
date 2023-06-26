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
* @name Email - Controller 
* @file EmailController.php
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

// use these models
use Maxaboom\Models\User;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;





/**
 * The EmailController class
 *
 * NOTE: This class is a controller for all email endpoints (routes)
 */
class EmailController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;

  // declare some constants...

  // declare some properties...

  // private properties


  // public properties
  

  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   *
   * @param ?string $theme : the theme to use
   * @param ?string $lang : the language to use
   * @param bool $useDefaultBrowserLang : whether or not to use the default browser language
   */
  public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true) {
    // call the parent's constructor
    parent::__construct($theme, $lang, $useDefaultBrowserLang);
    
  }

  // PUBLIC SETTERS

  // PUBLIC GETTERS

  // PUBLIC METHODS


  /**
   * Check if the given `$email` in relation to the specified `$role`
   *
   * @param string $email : the email to check
   * @param string $role : the role to check the email against
   *
   * @return array : the response
   */
  public function checkEmail($email, $role = 'customer'): array {
    // find the user with the given email
    $user = User::where('mail', $email);
    
    // get the success, status and message based on if the user's email exists or not
    $success = ($user->exists() && $user->user_role === $role) ? true : false;
    // get the correct status code
    $status = $success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_BAD_REQUEST;
    // get the appropriate message based on the success
    $message = $success ? $this->i18n->getString('emailFound') : $this->i18n->getString('emailNotFound');
    // get the user's info as data (if the user exists)
    $data = $success ? $user->info(['mail', 'firstname', 'created_at']) : [];
    
    // update the response
    $this->updateResponse($success, $status, $message, $data);


    // return the response
    return $this->getResponse();

  }


  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS

}
