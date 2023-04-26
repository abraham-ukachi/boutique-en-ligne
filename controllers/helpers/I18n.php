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
* @name I18n - Controller Helper 
* @file I18n.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> require __DIR__ . '/controllers/helpers/I18n.php';
*    -|> $i18n = new I18n('en');
*    -|> $hello = $i18n->getString('hello');
*    -|>
*    -|> echo $hello; // <- "Bonjour"
* 
*   2+|> // get browser's default language,
*    -|> // using a static method
*    -|> 
*    -|> $browserLanguage = I18n::getBrowserLanguage(); // <- invoked outside the class using the `::` operator
*    -|> 
*    
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



// Declare a class named `I18n`
class I18n {


  // Defining some constants...



  // LANG constants 
  // Usage example => I18n::LANG_ENGLISH
  // TODO: Remove the `LANG_` part of these constant variables (i.e. LANG_ENGLISH -> ENGLISH)
  const LANG_ENGLISH = 'en';
  const LANG_FRENCH = 'fr';
  const LANG_RUSSIAN = 'ru';
  const LANG_SPANISH = 'es';


  /**
   * Currently supported languages by this app
   */
  const SUPPORTED_LANGS = [self::LANG_ENGLISH, self::LANG_FRENCH, self::LANG_RUSSIAN, self::LANG_SPANISH];
  
  /**
   * Define the currently supported lanugages by this app as `LANGUAGES`
   * NOTE: This is a short-syntax multi dimensional array which contains an `id` (e.g 'en'),
   * `greeting` (e.g 'English'), and default `text` (e.g 'Red is my favorite color')
   * @deprecated
   */
  const LANGUAGES = [
    self::LANG_ENGLISH => ['greeting' => "Hi!", 'text' => "Red is my favorite color" ],
    self::LANG_FRENCH => ['greeting' => "Salut!", 'text' => "Le rouge est ma couleur préférée"],
    self::LANG_RUSSIAN => ['greeting' => "Привет!", 'text' => "Красный мой любимый цвет"],
    self::LANG_SPANISH => ['greeting' => "Hola!", 'text' => "Res es mi color favorito"]
  ];



  // Path to 'locale' folder or directory
  const LOCALE_DIR = 'assets/locale';

  
  // Defining some private properties...
  // NOTE: These are properties that can only by accessed by this `Internationalization` class.

  private string $lang;
  private array $stringsData;
  private array $numbersData;
  private array $arraysData;


  // TODO: Create a `numberData` private property
  

  /**
   * Create a constructor to initialize the properties of an object upon creation.
   * NOTE: PHP will automatically call this constructor whenever an object of `I18n` is created.
   *
   * @param string $lang : 'en' <- default language
   */
  public function __construct(string $lang = 'en') {
    // TODO: Make sure the given `lang` is supported before proceeding ;)

    // Initialize our properties
    $this->lang = $lang;

    $this->stringsData = [];
    $this->numbersData = [];
    $this->arraysData = [];


    // load the strings, numbers and arrays data
    $this->_loadStringsData(); 
    $this->_loadNumbersData();
    $this->_loadArraysData();

   
    // DEBUG [4dbsmaster]: tell me about it :)
    // var_dump($this->getSupportedLanguages());
    // echo $this::LANGUAGES['fr']['greeting'];

  }

  // PUBLIC METHODS
  // PUBLIC SETTERS
  // PUBLIC GETTERS

  /**
   * Returns the text value of the given `key` from `$stringsData`
   *
   * @param string $key
   * @param string $fallback
   *
   * @return string 
   */
  public function getString(string $key, string $fallback = ''): string {
    // TODO: Use a try/catch statement to handle errors
    return $this->stringsData[$key] ?? $fallback;
  }


  /**
   * Returns the number value of the given `key` from `$numbersData`
   *
   * @param string $key
   * @return int
   */
  public function getNumber(string $key): int {
    // TODO: Use a try/catch statement to handle errors
    return $this->numbersData[$key];
  }



  /**
   * Returns the array value of the given `key` from `$arraysData`
   *
   * @param string $key
   * @return array
   */
  public function getArray(string $key): array {
    // TODO: Use a try/catch statement to handle errors
    return $this->arraysData[$key];
  }


  
  /**
   * Returns a list or indexed array of all currently supported languages
   * 
   * @return array $supportedLanguages
   * @deprecated
   */
  public function getSupportedLanguages(): array {
    // Initialize the `supportedLanguages` variable with an empty short syntax array
    $supportedLanguages = [];

    // For each language id & data in our predefined `LANGUAGES` constant...
    foreach ($this::LANGUAGES as $langId => $langData) {
      // ..append only the id (e.g 'en') to the `supportedLanguages` list
      $supportedLanguages[] = $langId;
    }
    
    // return the `supportedLanguages` list
    return $supportedLanguages;
  }




  /**
   * Method used to detect and return the browser's language
   * 
   * @return ?string $browserLanguage
   * @static
   */
  public static function getBrowserLanguage(): ?string {
    // Initialize the `browserLanguage` variable with a null value
    $browserLanguage = null;

    // If the `HTTP_ACCEPT_LANGUAGE` server variable is set...
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      // ...then get the value of the `HTTP_ACCEPT_LANGUAGE` server variable as `language`
      $language = $_SERVER['HTTP_ACCEPT_LANGUAGE']; // <- returns eg.: en-US,en;q=0.9
      
      // split the `language` variable from (';' and ',') into an array of substrings named `langList`
      $langList = preg_split('/[;,]/', $language); // <- returns eg.: ['en-US', 'en', 'q=0.9']
      
      // loop through the `langList` array and get the first substring
      foreach ($langList as $lang) {
        // If the first 2 characters of the `lang` is equal to `q=`...
        if (substr($lang, 0, 2) === 'q=') continue; // ...then continue to the next iteration
        
        // if there's a hyphen (i.e. '-') in the `lang`...
        if (strpos($lang, '-') !== false) {
          // ...explode or split the `lang` into 2 and use the first item
          $lang = explode('-', $lang)[0];
        }

        // else update the `browserLanguage` variable with lower-cased `lang` variable
        $browserLanguage = strtolower($lang);

        // break out of the loop
        break;
      }

    }

    // return the `browserLanguage` variable
    return $browserLanguage;
  }



  /**
   * Returns the current language of the app
   *
   * @param string $asName - if TRUE, returns the language name instead of the language id
   *
   * @returns string $lang - the language id or name
   */
  public function getLanguage(?string $asName = null): string {
    return $asName ? $this->getString($this->lang) : $this->lang;
  }







  // PRIVATE METHODS
  
  /**
   * Method used to load or update the `stringData` list.
   * @private
   */
  private function _loadStringsData(): void {
    // Get the strings data (from e.g 'locale/strings/en.json') 
    // and assign it to the `stringsData` property
    $this->stringsData = $this->_getLocaleDataOf('strings');
     
  }


  /**
   * Method used to load or update the `arraysData` list.
   * @private
   */
  private function _loadNumbersData(): void {
    // Get the numbers data (from e.g 'locale/numbers/en.json') 
    // and assign it to the `numbersData` property
    $this->numbersData = $this->_getLocaleDataOf('numbers');
  }


  /**
   * Method used to load or update the `arraysData` list.
   * @private
   */
  private function _loadArraysData(): void {
    // Get the arrays data (from e.g 'locale/arrays/en.json') 
    // and assign it to the `arraysData` property
    $this->arraysData = $this->_getLocaleDataOf('arrays');
  }


  // PRIVATE SETTERS
  // PRIVATE GETTERS




  /**
   * Returns the locale data of the given `type`
   * 
   * @param string $type - 'strings' | 'numbers' | 'arrays'
   *
   * @return array $data
   * @private 
   */
  private function _getLocaleDataOf(string $type): array {
    // Get the json file of the current language as `localeFile`,
    // using the value of `LOCALE_PATH` and `lang`
    $localeFile = $this::LOCALE_DIR . "/" . $type . "/" . $this->lang . '.json'; // <- returns eg.: 'assets/locale/strings/en.json'

    // DEBUG [4dbsmaster](1): tell me about it :) 
    // echo "localFile => " . $localeFile . "<br>";
    
    // get the json data of the locale file
    $jsonData = file_get_contents($localeFile);
    
    // DEBUG [4dbsmaster](2): tell me about it :)
    // var_dump($jsonData);

    // Convert or decode the `jsonData` to an `array` as `data`
    $data = json_decode($jsonData, true);
    
    
    // return `data`
    return $data;

  }



}


