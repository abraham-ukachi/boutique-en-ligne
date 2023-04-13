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
* @name Home - Controller 
* @file HomeController.php
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
use Maxaboom\Controllers\Helpers\I18n;


// create an instance of the `I18n` class
// $i18n = new I18n('ru');

// get the browser's language as `browserLang`
// $browserLang = $i18n->getBrowserLanguage();




// declare the class
// TODO: Create a `Controller` class that will be extended by all the controllers
class HomeController {

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
   *
   * @param I18n $i18n - an instance of the `I18n` class
   * @param User $user - an instance of the `User` class
   *
   */
  public function __construct(I18n $i18n,  User $user) {
    // TODO: write something awesome code here ;)
    
    // initialize the `i18n` and `user` property
    $this->i18n = $i18n;
    $this->user = $user;
    
    // $user = new User();
    // $users = $user->displayUsers();
    // var_dump($users); 

  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS
  // PUBLIC METHODS


  /**
   * Shows the splash screen
   *
   * @param string $theme - the default theme of the splash screen
   *
   * @return void
   */
  public function showSplashScreen($theme = self::DEFAULT_THEME, $lang = self::DEFAULT_LANG): void {
    // TODO: do something awesome here before showing the splash screen ;)

    // show the splash screen 
    require_once __DIR__ . '/../views/splash-screen.php';
  }



  /**
   * Shows the welcome screen
   *
   * @param string $theme - the default theme of the welcome screen
   *
   * @return void 
   */
  public function showWelcomeScreen($theme = self::DEFAULT_THEME, $lang = self::DEFAULT_LANG): void {
    // TODO: do something awesome here before showing the welcome screen ;)
    
    // show the welcome screen 
    require_once __DIR__ . '/../views/welcome-screen.php';
  }



  /**
   * Shows the home page
   *
   * @param string $theme - the default theme of the home page
   *
   * @return void
   */
  public function showHomePage($theme = self::DEFAULT_THEME, $lang = self::DEFAULT_LANG): void {
    // TODO: do something awesome here before showing the home page ;)


    // show the home page 
    require_once __DIR__ . '/../views/home-page.php';
  }


  
  
  
  
  
  
  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


};





