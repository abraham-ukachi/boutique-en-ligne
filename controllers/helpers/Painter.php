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
* @name Painter - Controller Helper 
* @file Painter.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> // Get the current theme
*    -|> require __DIR__ . '/controllers/helpers/Painter.php';
*    -|> $painter = new Painter('light');
*    -|> $theme = $painter->getTheme(); // <- 'light'
*    -|> 
* 
*   2+|> // Set the theme to 'dark'
*    -|> $painter->setTheme('dark');
*    -|> 
* 
*   3+|> // Get a list of all supported themes
*    -|> $themes = $painter->getThemes();  // <- ['light', 'dark']
*    -|> // or
*    -|> $themes = Painter::SUPORTED_THEMES;
*    -|>
*
* ============================
* FUN QUIZ: API stands for Awkward Programmer Interface [Yes/No] ? ;)
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// create a namespace for this class
namespace Maxaboom\Controllers\Helpers;



// Declare a class named `Painter`
class Painter {


  // Defining some constants...



  // Theme constants 
  // Usage example => Painter::THEME_LIGHT
  const THEME_LIGHT = 'light';
  const THEME_DARK = 'dark';
  const THEME_DEFAULT = self::THEME_LIGHT; // <- the default theme is 'light' #lol


  /**
   * Currently supported themes by this app
   */
  const SUPPORTED_THEMES = [self::THEME_LIGHT, self::THEME_DARK];
  
  
  // Defining some private properties...

  private ?string $defaultTheme = null;


 

  /**
   * Create a constructor to initialize the properties of an object upon creation.
   * NOTE: PHP will automatically call this constructor whenever an object of `Painter` is created.
   *
   * @param string $theme : 'light' <- default theme
   */
  public function __construct(string $defaultTheme = self::THEME_DEFAULT) {

    // Initialize our properties
    $this->defaultTheme = $defaultTheme;

    // Initialize the `theme` session variable with the default theme
    $this->initThemeSession($defaultTheme);
    
  }



  // PUBLIC METHODS

  // PUBLIC SETTERS

  /**
   * Sets of update the theme withe the given `value`
   *
   * @param string $theme
   */
  public function setTheme(string $value): void {
    // Sets the 'theme' value in 'config' session
    $_SESSION['config']['theme'] = $value;

    // Update the `theme` property
    $this->theme = $value;
  }


  // PUBLIC GETTERS

  /**
   * Returns the theme value from session 
   *
   * @return string 
   */
  public function getTheme(): string {
    return $_SESSION['config']['theme'];
  }



  // PRIVATE METHODS

  /**
   * Method used to initialize the `theme` session variable
   */
  private function initThemeSession(?string $defaultTheme = null): void {
    // If the `config` session array varible doesn't exist...
    if (!isset($_SESSION['config'])) {
      // ...initialize it !
      $_SESSION['config'] = ['theme' => $defaultTheme ?? self::THEME_DEFAULT];
      
    } elseif (!isset($_SESSION['config']['theme'])) { // <- no 'theme' session variable in 'config'
      // ..initialize it !
      $_SESSION['config']['theme'] = $defaultTheme ?? self::THEME_DEFAULT;
    }
  }

  // PRIVATE SETTERS
  // PRIVATE GETTERS



}


