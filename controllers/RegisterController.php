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
* @name Register - Controller 
* @file RegisterController.php
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
 * Class RegisterController
 * NOTE: This class is a controller for the register page 
 */
class RegisterController extends Controller {
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
   * Shows the register page
   *
   * @return void
   */
  public function showPage(): void {
      require __DIR__ . '/../views/register-page.php';
  }



  /**
   * Method used to register a user with his/her email and password
   *
   * @param string $firstName : the user's first name
   * @param string $lastName : the user's last name
   * @param string $email : the user's email
   * @param string $password : the user's password
   * @param string $confirmPassword : the user's password confirmation
   *
   * @return bool $success : Returns TRUE if the user was successfully logged in, FALSE otherwise.
   */
  public function register(string $firstName, string $lastName, string $email, string $password, string $confirmPassword): bool {
    // initialize the `success` variable
    $success = false;
    // initialize the `status` variable
    $status = self::$STATUS_ERROR_BAD_REQUEST;
    // initialize the `message` variable
    $message = "";

    // create a multi-dimensional short-syntax list/array of all values to be validated
    $values = [
      'firstName' => [ 'value' => $firstName, 'type' => self::$VALIDATE_FIRST_NAME ],
      'lastName' => [ 'value' => $lastName, 'type' => self::$VALIDATE_LAST_NAME ],
      'email' => [ 'value' => $email, 'type' => self::$VALIDATE_EMAIL ],
      'password' => [ 'value' => $password, 'type' => self::$VALIDATE_PASSWORD ],
      'confirmPassword' => [ 'value' => $confirmPassword, 'type' => self::$VALIDATE_PASSWORD ]
    ];

    // validating all values...
    
    foreach ($values as $key => $validation) {
      // if the value is not valid
      if (!$this->validate($validation['value'], $validation['type'])) {
        // set `success` to FALSE
        $success = false;
        // get the validation status and update the `status` variable
        $status = $this->getValidationStatus();
        // get the validation message and update the `message` variable
        $message = $this->getValidationMessage();

        // update the response
        $this->updateResponse($success, $status, $message);

        // return the `success` variable
        return $success;
      }

      // if the key is `confirmPassword` and not equal to the `password` value
      if ($key === 'confirmPassword' && $validation['value'] !== $values['password']['value']) {
        // set `success` to FALSE
        $success = false;
        // update the `status` variable
        $status = self::$STATUS_ERROR_BAD_REQUEST;
        // update the `message` variable
        $message = $this->i18n->getString('passwordsDoNotMatch');

        // update the response
        $this->updateResponse($success, $status, $message);

        // return the `success` variable
        return $success;
      }
    }


    // NOTE: At this point, all values should be valid ;)

    // So, create the user with the validated values 
    // NOTE: the password is hashed before being stored in the database
    $user = User::create([
      'firstname' => $firstName,
      'lastname' => $lastName,
      'mail' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'user_role' => 'customer'
    ]);

    // if there's a user instance, then the creation was successful
    $success = ($user instanceof User) ? true : false; // <- #NN but we love our ternary statements 😜
    // update the `status` variable
    $status = $success ? self::$STATUS_SUCCESS_CREATED : self::$STATUS_ERROR_INTERNAL_ERROR;
    // create a response message based on the success of the connection
    $message = $success ? $this->i18n->getString('registerSuccessful') : $this->i18n->getString('registerFailed');

    $data = $success ? $user->info() : [];

    // update the response
    $this->updateResponse($success, $status, $message, $data); 
    // return the `success` variable
    return $success;
  }


  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS

}
