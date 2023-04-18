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
* @name Account - Controller 
* @file AccountController.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
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


// use the `User` model
use Maxaboom\Models\User;
// use the `I18n` helper class
use Maxaboom\Controllers\Helpers\I18n;




// declare the class
// TODO: Create a `Controller` class that will be extended by all the controllers
class AccountController {

  // declare some constants...

  const DEFAULT_THEME = 'light';
  const DEFAULT_LANG = 'en';
  
  

  // declare some properties...

  // private properties
  private I18n $i18n;
  private User $user;

  
  
  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   */
  public function __construct() {
    // TODO: write something awesome code here ;)
    
    // initialize the `i18n` and `user` property
    $this->i18n = new I18n(self::DEFAULT_LANG);
    $this->user = new User();
    
     
    // $user = new User();
    // $users = $user->displayUsers();
    // var_dump($users);

  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS
  // PUBLIC METHODS



  /**
   * Shows the default account page
   *
   * @param string $theme - the theme of the page
   * @param string $lang - the language of the page
   *
   * @return void
   */
  public function showPage($theme = self::DEFAULT_THEME, $lang = self::DEFAULT_LANG): void {
    // TODO: do something awesome here before showing the home page ;)


    // show the home page 
    require_once __DIR__ . '/../views/account-page.php';
  }


  
  
  
  
  
  
  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


};





