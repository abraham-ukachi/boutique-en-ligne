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

// use these models
use Maxaboom\Models\Category;
use Maxaboom\Models\SubCategory;
use Maxaboom\Models\Color;


// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;



/**
 * Class APIController
 * NOTE: This class is a controller for Maxaboom's API endpoints
 */
class APIController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;

  // declare some constants...

  // declare some properties...
  
  // private properties

  // public properties
  public Category $category;
  public SubCategory $subCategory;
  public Color $color;

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

    // instantiate the models
    $this->category = new Category();
    $this->subCategory = new SubCategory();
    $this->color = new Color();
  }



  // PUBLIC SETTERS
  // PUBLIC GETTERS

  /**
   * Returns a response containing a list of available colors
   *
   * @return array $response - eg. ['success' => true, 'status' => 200, 'message' => '...', ['results' => [...]]]
   */
  public function getColors(): array {
    // get all the colors
    $colors = Color::all();

    // intialize the `results` array
    $results = [];

    // loop through the colors and get their info
    foreach ($colors as $color) {
      // ..get the color's info
      $colorInfo = $color->info();

      // add the original name of the color
      $colorInfo['original_name'] = $this->i18n->getString($color->name) ?? $color->name;

      // append the color's info to the `results` array
      $results[] = $colorInfo;
    }

    // define the `success`, `status`, `message` and `data` for the response
    $success = true;
    $status = self::$STATUS_SUCCESS_OK;
    $message = 'Colors retrieved successfully';
    $data = ['results' => $results];

    // update the response
    $this->updateResponse($success, $status, $message, $data);

    // return the response
    return $this->response;
  }


  /**
   * Returns a response containing a list of available categories
   *
   * @return array $response - eg. ['success' => true, 'status' => 200, 'message' => '...', ['results' => [...]]]
   */
  public function getCategories(): array {
    // get all the categories
    $categories = Category::all();

    // intialize the `results` array
    $results = [];


    // loop through the categories and get their info
    foreach ($categories as $category) {
      // ...append the category's info to the `results` array
      $results[] = $category->info();
    }


    // define the `success`, `status`, `message` and `data` for the response
    $success = true;
    $status = self::$STATUS_SUCCESS_OK;
    $message = 'Categories retrieved successfully';
    $data = ['results' => $results];
    
    // update the response
    $this->updateResponse($success, $status, $message, $data);

    // return the response
    return $this->response;
  }

  
  /**
   * Returns a response containing a list of available sub-categories of the given `categoryId`
   *
   * @return array $response - eg. ['success' => true, 'status' => 200, 'message' => '...', ['results' => [...]]]
   */
  public function getSubCategories(int $categoryId): array {
    // initialize the `results` array variable
    $results = [];

    // get all the sub-categories as `results`
    $subCategories = SubCategory::where('category_id', $categoryId)->get(true);

    // define the `success`, `status`, `message` and `data` for the response
    $success = is_array($subCategories) ? true : false;
    $status = $success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_BAD_REQUEST;
    $message = $success ? 'SubCategories retrieved successfully' : 'SubCategories could not be retrieved';


    if ($success) {
      // TODO: Do some stuff with the sub-categories like filtering, sorting, etc...
      
      // update the `results` array with the sub-categories
      $results = $subCategories;
    }


    // update the data 
    $data = $success ? ['results' => $results] : [];
    
    // update the response
    $this->updateResponse($success, $status, $message, $data);

    // return the response
    return $this->response;
  }


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





