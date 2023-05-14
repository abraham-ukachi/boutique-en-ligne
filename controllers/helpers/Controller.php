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
* @name Controller - Controller Helper 
* @file Controller.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> // 
*    -|> 
*    
*
* ============================
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// create a namespace for this abstract class
namespace Maxaboom\Controllers\Helpers;

// use the `I18n` helper class
use Maxaboom\Controllers\Helpers\I18n;
// use the `Painter` helper class
use Maxaboom\Controllers\Helpers\Painter;






// Declare an abstract class named `Controller`
abstract class Controller {

  // declare some constants...

  // themes
  const THEME_DARK = 'dark';
  const THEME_LIGHT = 'light';
  const DEFAULT_THEME = self::THEME_LIGHT;

  // languages
  const LANG_ENGLISH = 'en';
  const LANG_FRENCH = 'fr';
  const LANG_SPANISH = 'es';
  const DEFAULT_LANG = self::LANG_ENGLISH;


  // Defining some public properties...
  
  public I18n $i18n;
  public Painter $painter;

  // Defining some private properties...


  // Defining some protected properties...

  protected ?string $theme;
  protected ?string $lang;









  /**
   * The constructor of the abstract `Controller` class
   *
   * @param ?string $theme : the theme to use
   * @param ?string $lang : the language to use
   * @param bool $useDefaultBrowserLang : whether or not to use the default browser language
   */
  public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true) {
    // TODO: Make sure the given `lang` is supported before proceeding ;)
    
    // initialize the `config` session array if it doesn't exist
    $this->initConfigSession($useDefaultBrowserLang);

    // Initialize our properties
    $this->theme = $theme ?? $this->getCurrentTheme();
    $this->lang = $lang ?? $this->getCurrentLang();

    // Instantiate the `I18n` helper class and assign it to the `$i18n` property
    $this->i18n = new I18n($this->lang);
    $this->painter = new Painter($this->theme);

  }
  


  // PUBLIC METHODS
  // PUBLIC SETTERS

  /**
   * Method used to set or update the current theme from the `config` session array, with the given `theme`
   * NOTE: This method will also update the `$theme` property
   *
   * @param string $theme : the theme to use
   * @return void
   */
  public function setCurrentTheme(string $theme): void {
    // add the given `theme` to the `config` session array
    $_SESSION['config']['theme'] = $theme;
    // update the `$theme` property
    $this->theme = $theme;
  }


  /**
   * Method used to set or update the current language from the `config` session array, with the given `lang`
   * NOTE: This method will also update the `$lang` property
   *
   * @param string $lang : the language to use (eg. 'en')
   * @return void
   */
  public function setCurrentLang(string $lang): void {
    // add the given `lang` to the `config` session array
    $_SESSION['config']['lang'] = $lang;
    // update the `$lang` property
    $this->lang = $lang;
  }


  /**
   * Returns the current `theme` from the `config` session array
   *
   * @return string
   */
  public function getCurrentTheme(): string {
    return $_SESSION['config']['theme'];
  }

  /**
   * Returns the current `lang` from the `config` session array
   *
   * @return string
   */
  public function getCurrentLang(): string {
    return $_SESSION['config']['lang'];
  }


  // PUBLIC GETTERS




  // PRIVATE SETTERS
  // PRIVATE GETTERS

  // PRIVATE METHODS

  /**
   * Redirects the user to the specified `url`
   *
   * @param ?string $url : the url to redirect to
   *
   * @return void
   * @protected
   */
  protected function redirect(?string $url = null) {
    // Modify the `url`
    $url = is_null($url) ? _NAME : APP_NAME . $url;

    // redirect the user to the given `url`
    header('Location: /' . $url);
    exit;
  }

  /**
   * Method used to create the `config` session array if it doesn't exist
   *
   * @param bool $useDefaultBrowserLang : whether or not to use the default browser language for initialization
   */
  private function initConfigSession($useDefaultBrowserLang = true): void {
    // check if the `config` session array doesn't exist
    if (!isset($_SESSION['config'])) {
      // get the default theme as `$defaultTheme`
      $defaultTheme = self::DEFAULT_THEME;

      // get the default language as `$defaultLang`,
      // using our beloved ternary statement 😜
      $defaultLang = ($useDefaultBrowserLang && in_array(I18n::getBrowserLanguage(), I18n::SUPPORTED_LANGS)) ? I18n::getBrowserLanguage() : self::DEFAULT_LANG;
      //$defaultLang = self::DEFAULT_LANG;

      // create the `config` session array with the default theme and language
      $_SESSION['config'] = [
        'theme' => $defaultTheme,
        'lang' => $defaultLang
      ];
      
    }
  }


}


