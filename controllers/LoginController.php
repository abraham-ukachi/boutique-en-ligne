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
* @name Login - Controller 
* @file LoginController.php
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


// declare a namespace
namespace Maxaboom\Controllers;

// use the `User` model
use Maxaboom\Models\User;



// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;
use Maxaboom\Controllers\Helpers\ValidationHandler;





/**
 * Class LoginController
 * NOTE: This class is a controller for the login page 
 */
class LoginController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;
  use ValidationHandler;

  // declare some constants...

  // declare some properties...

  // private properties
  private User $user;


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

    // TODO: write something awesome code here ;)
    
    // instantiate some models 
    $this->user = new User();


    // DEBUG [4dbsmaster]: tell me about the `user` property 
    // var_dump($this->user); 
  }


  // PUBLIC SETTERS

  // PUBLIC GETTERS

  // PUBLIC METHODS


  /**
   * Returns TRUE if the user is logged in, FALSE otherwise
   *
   * @return bool
   */
  public function isUserLoggedIn(): bool {
    return $this->user->isConnected();
  }

  
  /**
   * Shows the login page
   *
   * @return void
   */
  public function showPage(): void {
      require __DIR__ . '/../views/login-page.php';
  }


  /**
   * Connects a user
   *
   * @param string $mail : the user's mail
   * @param string $password : the user's password
   *
   * @return array : the response
   * @deprecated - use the `login()` method instead
   */
  public function connectUser(string $mail, string $password): array {
    // TODO: Validate the mail before connecting the user
    $success = $this->user->connection($mail, $password);
    return ['success' => $success];
  }



  /**
   * Method used to login a user with his/her email and password
   *
   * @param string $email : the user's email
   * @param string $password : the user's password
   *
   * @return bool $success : Returns TRUE if the user was successfully logged in, FALSE otherwise.
   */
  public function login(string $email, string $password): bool {
    // initialize the `success` variable
    $success = false;
    // initialize the `status` variable
    $status = self::$STATUS_ERROR_BAD_REQUEST;
    // initialize the `message` variable
    $message = "";
     
    
    // validate the email
    if ($this->validate($email, self::$VALIDATE_EMAIL)) { // <-- the email is valid
      // connect the user with his/her email and password
      $user = User::connect(['mail' => $email, 'password' => $password]);

      // if there's a user instance, then the connection was successful
      $success = ($user instanceof User);
      // update the `status` variable
      $status = $success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_UNAUTHORIZED;
      // create a response message based on the success of the connection
      $message = $success ? $this->i18n->getString('loginSuccessful') : $this->i18n->getString('loginFailed');

    } else { // <-- the email is not valid

      // get the validation status and update the `status` variable
      $status = $this->getValidationStatus();
      // get the validation message and update the `message` variable
      $message = $this->getValidationMessage();
    }

    // update the response
    $this->updateResponse($success, $status, $message); 
    // return the `success` variable
    return $success;
  }


  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS

}
