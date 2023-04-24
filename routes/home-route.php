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
* @name Home - Route
* @file home-route.php
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


// declare the `routes` namespace
namespace Maxaboom\Routes;

// use maxaboom's `APIController` class
use Maxaboom\Controllers\HomeController;



/**
 * ============================
 *  Home Routes
 * ============================
 */






/**
 * Route used to display the splash, welcome or home view
 * 
 * @method GET
 * @action / - or (/splash|/welcome)
 *
 * @echo string $splashScreen|$welcomeScreen|$homePage - the splash screen, welcome screen or home page
 * @return void
 */
$router->map('GET', '/[splash|welcome:screen]?', function(?string $screen = null): void {
  // create an object of the `HomeController` class
  $homeController = new HomeController();

  // switch the screen
  switch ($screen) {
    case HomeController::SCREEN_SPLASH:
      // show the splash screen
      $homeController->showSplashScreen();
      break;
    case HomeController::SCREEN_WELCOME:
      // show the welcome screen
      $homeController->showWelcomeScreen();
      break;
    default:
      // 
      break;
  }

  if (!isset($screen)) {
    // show the home page
    $homeController->showHomePage();
  }

});


/**
 * Route used to redirect to the home page
 *
 * @method GET
 * @action /home
 * @redirect / - the home page
 */
$router->map('GET', '/home', function() {
  // redirect to the home page
  header("Location: " . MAXABOOM_HOME_DIR);
});





