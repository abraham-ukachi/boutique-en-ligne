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
// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;





// Declare a class that represents the `Home` controller,
// which is a child of the `Controller` class
class HomeController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;
  
  // declare some constants...

  // actions 

  // screens
  const SCREEN_SPLASH = 'splash';
  const SCREEN_WELCOME = 'welcome';

  // pages
  const PAGE_HOME = 'home';

  // declare some properties...

  // private properties
  private User $user;


  // public properties
  // splash & welcome screen timeous
  public int $splashScreenTimeout = 30; // <- in seconds
  public int $welcomeScreenTimeout = 30; // <- in seconds
  


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
    
    // initialize the `user` property by creating a new `User` object
    $this->user = new User();
    
    
    // DEBUG [4dbsmaster]: tell me about the `user` property and display all the users
    // var_dump($this->user); 
    // var_dump($user->displayUsers());

  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS
  // PUBLIC METHODS


  /**
   * Shows the splash screen
   *
   * @return void
   */
  public function showSplashScreen(): void {
    // TODO: do something awesome here before showing the splash screen ;)

    // require [once] the splash screen from the `views` folder
    require_once __DIR__ . '/../views/splash-screen.php';

    // set the splash screen timestamp to the current timestamp 
    $this->setSplashScreenTimestamp($this->currentTimestamp() + $this->splashScreenTimeout);
  }


  /**
   * Shows the welcome screen
   *
   * @return void
   */
  public function showWelcomeScreen(): void {
    // TODO: do something awesome here before showing the welcome screen ;)

    // require [once] the welcome screen from the `views` folder
    require_once __DIR__ . '/../views/welcome-screen.php';

    // set the welcome screen timestamp to the current timestamp 
    $this->setWelcomeScreenTimestamp($this->currentTimestamp() + $this->welcomeScreenTimeout);
  }


  /**
   * Shows the home page
   *
   * @return void
   */
  public function showHomePage(): void {
    // TODO: do something awesome here before showing the home page ;)

    // require [once] the home page from the `views` folder
    require_once __DIR__ . '/../views/home-page.php';
  }


  

  /**
   * Checks if the splash screen should be displayed
   * NOTE: This method checks if the current timestamp is greater than or equal to the splash-screen timestamp
   *
   * @return bool : whether or not the splash screen should be displayed
   */
  public function checkSplashScreen(): bool {
    // get the splash screen timestamp as `$splashScreenTimestamp`
    $splashScreenTimestamp = $this->getSplashScreenTimestamp();
    // get the current timestamp as `$currentTimestamp`
    $currentTimestamp = $this->getCurrentTimestamp();

    // return whether or not the `$currentTimestamp` is greater than or equal to the `$splashScreenTimestamp`
    return $currentTimestamp >= $splashScreenTimestamp;
  }

  

  /**
   * Checks if the welcome screen should be displayed
   * NOTE: This method checks if the current timestamp is greater than or equal to the welcome-screen timestamp
   *
   * @return bool : whether or not the splash screen should be displayed
   */
  public function checkWelcomeScreen(): bool {
    // get the welcome screen timestamp as `$welcomeScreenTimestamp`
    $welcomeScreenTimestamp = $this->getWelcomeScreenTimestamp();

    // get the current timestamp as `$currentTimestamp`
    $currentTimestamp = $this->getCurrentTimestamp();

    // return whether or not the `$currentTimestamp` is greater than or equal to the `$welcomeScreenTimestamp`
    return $currentTimestamp >= $welcomeScreenTimestamp;
  }

  

  
  
  // PRIVATE SETTERS


  /**
   * Sets the splash screen timestamp 
   *
   * @param int $timestamp : the timestamp to set 
   *
   * @return void
   * @private
   */
  private function setSplashScreenTimestamp($timestamp): void {
    // if there's a `config` session variable...
    if (isset($_SESSION['config'])) {
      // ...then set the `splashScreenTimestamp` property of the `config` session variable
      $_SESSION['config']['splashScreenTimestamp'] = $timestamp;
       
      // TODO: create & update the `splashScreenTimestamp` property of the class
      // $this->splashScreenTimestamp = $timestamp;
    }

  }

  /**
   * Sets the welcome screen timestamp 
   *
   * @param int $timestamp : the timestamp to set 
   *
   * @return void
   * @private
   */
  private function setWelcomeScreenTimestamp($timestamp): void {
    // if there's a `config` session variable...
    if (isset($_SESSION['config'])) {
      // ...then set the `welcomeScreenTimestamp` property of the `config` session variable
      $_SESSION['config']['welcomeScreenTimestamp'] = $timestamp;
       
      // TODO: create & update the `welcomeScreenTimestamp` property of the class
      // $this->welcomeScreenTimestamp = $timestamp;
    }

  }


  // PRIVATE GETTERS

  /**
   * Returns the splash screen timestamp from the `config` session variable, 
   * or the default / current timeout if the `config` session variable is not set
   * 
   * @return int
   * @private
   */
  private function getSplashScreenTimestamp(): int {
    return (isset($_SESSION['config'])) ? $_SESSION['config']['splashScreenTimestamp'] : $this->getCurrentTimestamp();
  }

  /**
   * Returns the welcome screen timestamp from the `config` session variable, 
   * or the default / current timeout if the `config` session variable is not set
   * 
   * @return int
   * @private
   */
  private function getWelcomeScreenTimestamp(): int {
    return (isset($_SESSION['config'])) ? $_SESSION['config']['welcomeScreenTimestamp'] : $this->getCurrentTimestamp();
  }


  /**
   * Returns the current timestamp
   *
   * @return int
   */
  private function getCurrentTimestamp(): int {
    // TODO: Do something awesome here to get the current timestamp

    return time(); // <- For now... super simple, isn't it? 😜
  }

  
  // PRIVATE METHODS

};





