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
* @name Validation Handler - Controller Helper
* @file ValidationHandler.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> // validate an email
*    -|> 
*    -|> if ($this->validate($email, self::$VALIDATE_EMAIL)) {
*    -|>   echo $this->getValidationMessage(); // returns eg.: "Email is valid"
*    -|> }
*    -|>
*
*   2+|> // update validation message
*    -|>
*    -|> $this->updateValidation(false, self::$STATUS_EMAIL_INVALID, "Email is invalid");
*    -|> 
*/


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MOTTO: I'll always do more 😜!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */

// Declare a namespace`
namespace Maxaboom\Controllers\Helpers;



/*
 * Declare a trait named 'ValidationHandler'.
 */
trait ValidationHandler {

  // private properties
  
  // Defining some "FAKE" CONSTANTS ;)...
  
  // validate codes
  // ?TODO: change validate codes to strings (e.g: "v_email", "v_password", etc.)
  private static $VALIDATE_EMAIL = 42; // <- starts with 42 because it's the answer to everything #LOL ;)
  private static $VALIDATE_PASSWORD = 43;
  private static $VALIDATE_FIRST_NAME = 44;
  private static $VALIDATE_LAST_NAME = 45;

  // validity codes
  private static $VALIDITY_SUCCESS = 1;
  private static $VALIDITY_FAILURE = 0;

  // email - status codes
  private static $STATUS_EMAIL_INVALID = 100;
  private static $STATUS_EMAIL_VALID = 120;
  private static $STATUS_EMAIL_TOO_SHORT = 130; 
  private static $STATUS_EMAIL_TOO_LONG = 140;
  // password - status codes
  private static $STATUS_PASSWORD_INVALID = 200;
  private static $STATUS_PASSWORD_VALID = 220;
  private static $STATUS_PASSWORD_TOO_SHORT = 230;
  private static $STATUS_PASSWORD_TOO_LONG = 240;
  private static $STATUS_PASSWORD_NO_UPPERCASE = 250;
  private static $STATUS_PASSWORD_NO_LOWERCASE = 260;
  private static $STATUS_PASSWORD_NO_NUMBER = 270;
  private static $STATUS_PASSWORD_NO_SPECIAL_CHAR = 280;

  // first name - status codes
  private static $STATUS_FIRST_NAME_INVALID = 300;
  private static $STATUS_FIRST_NAME_VALID = 320;
  private static $STATUS_FIRST_NAME_TOO_SHORT = 330;
  private static $STATUS_FIRST_NAME_TOO_LONG = 340;
  private static $STATUS_FIRST_NAME_SPECIAL_CHAR = 381;
  // last name - status codes
  private static $STATUS_LAST_NAME_INVALID = 400;
  private static $STATUS_LAST_NAME_VALID = 420;
  private static $STATUS_LAST_NAME_TOO_SHORT = 430;
  private static $STATUS_LAST_NAME_TOO_LONG = 440;
  private static $STATUS_LAST_NAME_SPECIAL_CHAR = 481;


  // protected properties 

  /*
   * # Validation
   * > NOTE: This is an short-syntax associative array containing the 
   * current `success`, `status` and `message` of a validation.
   * 
   * @type array
   */
  protected array $validation = [
    "success" => false,
    "status" => 0,
    "message" => ""
  ];

  // public properties

  // email - minimum and maximum lengths
  public int $minEmailLength = 5;
  public int $maxEmailLength = 50;
  // password - minimum and maximum lengths
  public int $minPasswordLength = 8;
  public int $maxPasswordLength = 64; // <- recommended by NIST (National Institute of Standards and Technology) https://pages.nist.gov/800-63-3/sp800-63b.html#sec5
  // first name - minimum and maximum lengths
  public int $minFirstNameLength = 2;
  public int $maxFirstNameLength = 30;
  // last name - minimum and maximum lengths
  public int $minLastNameLength = 2;
  public int $maxLastNameLength = 30;
  





  // PUBLIC SETTERS

  // PUBLIC GETTERS


  /**
   * Method used to get the `validation` array.
   * 
   * @return array $validation
   */
  public function getValidation(): array {
    return $this->validation;
  }


  /**
   * Returns the validation success.
   *
   * @return int $success
   */
  public function getValidationSuccess() {
    return $this->validation['success'];
  }


  /**
   * Returns the validation status.
   *
   * @return int $status
   */
  public function getValidationStatus(): int {
    return $this->validation['status'];
  }



  /**
   * Returns the validation message.
   *
   * @return string $message
   */
  public function getValidationMessage(): string {
    return $this->validation['message'];
  }



  /**
   * Returns the validation message with the given `key`.
   *
   * @param string $key - The key of the data to return
   * @return string $data
   */
  public function getValidationData($key): string {
    return $this->validation[$key];
  }


  // PUBLIC METHODS

  /**
   * Validates the given `value`, using the given `mode`.
   *
   * @param mixed $value - The value to validate
   * @param int $mode - The mode to use for validation. eg.: self::$VALIDATE_EMAIL
   *
   * @return bool - Returns TRUE if the validation was successful, FALSE otherwise.
   */
  public function validate(mixed $value, int $mode): bool {
    
    switch ($mode) {
      case self::$VALIDATE_EMAIL: // <- validate email
        return $this->validateEmail($value);
        break;
      case self::$VALIDATE_PASSWORD: // <- validate password
        return $this->validatePassword($value);
        break;
      case self::$VALIDATE_FIRST_NAME: // <- validate first name
        return $this->validateFirstName($value);
        break;
      case self::$VALIDATE_LAST_NAME: // <- validate last name
        return $this->validateLastName($value);
        break;
      default:
        return false;
        break;
    }
  } 

  /**
   * Method used to validate the given `email`.
   * NOTE: This method also updates the `validation` array accordingly
   *
   * @param string $email - The email to validate
   *
   * @return bool - Returns TRUE if the email is valid, FALSE otherwise.
   */
  public function validateEmail(string $email): bool {
    // ?TODO: Add more validation rules like (STATUS_EMAIL_ALREADY_EXISTS, etc...)

    // trim the email
    $email = trim($email);

    // check if email is too short
    if (strlen($email) < $this->minEmailLength) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_EMAIL_TOO_SHORT, $this->i18n->getString('emailTooShort'));
      return false;
    }

    // check if email is too long
    if (strlen($email) > $this->maxEmailLength) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_EMAIL_TOO_LONG, $this->i18n->getString('emailTooLong'));
      return false;
    }

    // check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
      // TODO: Make some additional checks here ;)

      // update validation message
      $this->updateValidation(true, self::$STATUS_EMAIL_VALID, $this->i18n->getString('emailValid'));
      return true;
    }

    // update validation message
    $this->updateValidation(false, self::$STATUS_EMAIL_INVALID, $this->i18n->getString('emailInvalid'));
    return false;
  }

  

  /**
   * Method used to validate the given `password`.
   * NOTE: This method also updates the `validation` array accordingly
   *
   * @param string $password - The password to validate
   * 
   * @return bool - Returns TRUE if the password is valid, FALSE otherwise.
   */
  public function validatePassword(string $password): bool {
    // trim the password
    $password = trim($password);

    // check if password is too short
    if (strlen($password) < $this->minPasswordLength) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_PASSWORD_TOO_SHORT, $this->i18n->getString('passwordTooShort'));
      return false;
    }

    // check if password is too long
    if (strlen($password) > $this->maxPasswordLength) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_PASSWORD_TOO_LONG, $this->i18n->getString('passwordTooLong'));
      return false;
    }

    // check if password contains at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_PASSWORD_NO_UPPERCASE, $this->i18n->getString('passwordNoUppercase'));
      return false;
    }

    // check if password contains at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_PASSWORD_NO_LOWERCASE, $this->i18n->getString('passwordNoLowercase'));
      return false;
    }

    // check if password contains at least one number
    if (!preg_match('/[0-9]/', $password)) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_PASSWORD_NO_NUMBER, $this->i18n->getString('passwordNoNumber'));
      return false;
    }

    // check if password contains at least one special character
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>?]/', $password)) {
      // update validation message
      $this->updateValidation(false, self::$STATUS_PASSWORD_NO_SPECIAL_CHAR, $this->i18n->getString('passwordNoSpecialChar'));
      return false;
    }

    // update validation message
    $this->updateValidation(true, self::$STATUS_PASSWORD_VALID, $this->i18n->getString('passwordValid'));
    return true;
  }


  /**
   * Method used to validate the given `last name`.
   * NOTE: This method also updates the `validation` array accordingly
   *
   * @param string $lastName - The last name to validate
   *
   * @return bool - Returns TRUE if the last name is valid, FALSE otherwise.
   */
  public function validateFirstName(string $firstName): bool {
    // trim the first name
    $firstName = trim($firstName);

    // If the first name is one word...
    if (strpos($firstName, ' ') === false) {

      // check if first name is too short
      if (strlen($firstName) < $this->minFirstNameLength) {
        // update validation message
        $this->updateValidation(false, self::$STATUS_FIRST_NAME_TOO_SHORT, $this->i18n->getString('firstNameTooShort'));
        return false;
      }

      // check if first name is too long
      if (strlen($firstName) > $this->maxFirstNameLength) {
        // update validation message
        $this->updateValidation(false, self::$STATUS_FIRST_NAME_TOO_LONG, $this->i18n->getString('firstNameTooLong'));
        return false;
      }

      // check if first name contains any special characters
      if (preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $firstName)) {
        // update validation message
        $this->updateValidation(false, self::$STATUS_FIRST_NAME_SPECIAL_CHAR, $this->i18n->getString('firstNameSpecialChar'));
        return false;
      }
    
      // update validation message
      $this->updateValidation(true, self::$STATUS_FIRST_NAME_VALID, $this->i18n->getString('firstNameValid'));
      return true;

    } else { // <- If the first name is two or more words...
      // update validation message
      $this->updateValidation(false, self::$STATUS_FIRST_NAME_INVALID, $this->i18n->getString('firstNameInvalid'));
      return false;
    }
    

  }


  /**
   * Method used to validate the given `last name`.
   * NOTE: This method also updates the `validation` array accordingly
   *
   * @param string $lastName - The last name to validate
   *
   * @return bool - Returns TRUE if the last name is valid, FALSE otherwise.
   */
  public function validateLastName(string $lastName): bool {
    // trim the last name 
    $lastName = trim($lastName);

    // If the last name is one word...
    if (strpos($lastName, ' ') === false) {

      // check if last name is too short
      if (strlen($lastName) < $this->minLastNameLength) {
        // update validation message
        $this->updateValidation(false, self::$STATUS_LAST_NAME_TOO_SHORT, $this->i18n->getString('lastNameTooShort'));
        return false;
      }

      // check if last name is too long
      if (strlen($lastName) > $this->maxLastNameLength) {
        // update validation message
        $this->updateValidation(false, self::$STATUS_LAST_NAME_TOO_LONG, $this->i18n->getString('lastNameTooLong'));
        return false;
      }

      // check if last name contains any special characters
      if (preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $lastName)) {
        // update validation message
        $this->updateValidation(false, self::$STATUS_LAST_NAME_SPECIAL_CHAR, $this->i18n->getString('lastNameSpecialChar'));
        return false;
      }
    
      // update validation message
      $this->updateValidation(true, self::$STATUS_LAST_NAME_VALID, $this->i18n->getString('lastNameValid'));
      return true;

    } else { // <- If the last name is two or more words...
      // update validation message
      $this->updateValidation(false, self::$STATUS_LAST_NAME_INVALID, $this->i18n->getString('lastNameInvalid'));
      return false;
    }

  }

  


  // PRIVATE SETTERS

  /**
   * Sets the 'success' in `$validation` array to the given `value`
   *
   * @param bool $value
   *
   * @private
   */
  private function setValidationSuccess(bool $value): void {
    $this->validation['success'] = $value;
  }


  /**
   * Sets the 'status' in `$validation` array to the given `value`
   *
   * @param int $value
   *
   * @private
   */
  private function setValidationStatus(int $value): void {
    $this->validation['status'] = $value;
  }



  /**
   * Sets the 'message' in `$validation` array to the given `value`
   *
   * @param string $value
   *
   * @private
   */
  private function setValidationMessage(string $value): void {
    $this->validation['message'] = $value;
  }

  /**
   * Sets the 'data' in `$validation` array to the given `value`
   * NOTE: This method merges the given `value` with the current `validation` array.
   *
   * @param array $value
   */
  private function setValidationData(array $value): void {
    $this->validation = array_merge($this->validation, $value);
  }


  // PRIVATE GETTERS




  // PRIVATE METHODS

  /**
   * Updates the `validation` array with the given `success`, `status`, `message` and/or `data`.
   *
   * @param bool $success
   * @param int $status
   * @param string $message
   * @param array $data - An additional/extra data to the validation (eg. ["userId" => $userId])
   *
   * @private
   */
  private function updateValidation(bool $success, int $status, string $message, array $data = []): void {
    // update the `validation` array
    $this->validation = array_merge([
      'success' => $success,
      'status' => $status,
      'message' => $message
    ], $data);

  }



}
