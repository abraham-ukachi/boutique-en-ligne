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
* @project boutique-en-ligne (maxaboom)
* @name Common Password - Class
* @file CommonPassword.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Find a common password
*    -|>
*    -|> $commonPassword = CommonPassword::find('password');
*    -|>
*
*   2+|> // Check if the password is common
*    -|>
*    -|> if ($commonPassword->isCommon()) {
*    -|>   // Do something
*    -|> }
*    -|>
*
*/

// Declare the namespace for this `Model` class
namespace Maxaboom\Controllers\Helpers;



/**
 * A class to check if a password is common
 * For more info, see: https://www.kaggle.com/datasets/shivamb/10000-most-common-passwords
 */
#[\AllowDynamicProperties]
class CommonPassword {

  // declare some constanst

  // protected variables

  /**
   * The file name of the csv file containing the common passwords
   * IMPORTANT: For now, this file must be in the `assets` directory
   *
   * @var string
   */
  protected string $csv_file = 'common_passwords.csv';


  /**
   * The fields associated with this csv file
   *
   * @var array
   */
  protected array $fields = [
    'password',
    'length',
    'num_chars',
    'num_digits',
    'num_upper',
    'num_lower',
    'num_special',
    'num_vowels',
    'num_syllables'
  ];


  /**
   * The primary key associated with the csv file (i.e. the field to use to find a row)
   *
   * @var string
   */
  protected string $primaryKey = 'password';


  // public variables

  public ?string $password = null;
  public ?int $length = null;
  public ?int $num_chars = null;
  public ?int $num_digits = null;
  public ?int $num_upper = null;
  public ?int $num_lower = null;
  public ?int $num_special = null;
  public ?int $num_vowels = null;
  public ?int $num_syllables = null;


  // private variables

  /**
   * The original properties of the class.
   *
   * @var array
   */
  private array $originalProperties = [];

  
  /**
   * The csv data
   *
   * @var array|null
   */
  private ?array $csv_data = null;
  



   
  /**
   * Constructor of the `CommonPassword` class
   */
  public function __construct() {

    // load the csv data
    $this->loadCsvData();
 
  }


  // PUBLIC STATIC METHODS

  /**
   * Finds a row in `$csv_data` with the given `$password`
   *
   * @param int $password
   * @return self 
   */
  public static function find(string $password): self {
    // Get an instance of the class
    $instance = self::getInstance();
     

    $found_key = array_search($password, array_column($instance->csv_data, $instance->primaryKey));

    // Initialize the `$result` variable with the found row
    $result = $instance->csv_data[$found_key];

    // If the `$result` is an array...
    if (is_array($result)) {
      // ...populate the instance with the given `$result` array
      $instance = self::populate($result, $instance);
    }

    //var_dump($result);
    
    // Return the instance
    return $instance;
  }


  /**
   * Returns all the info of this common password 
   *
   * @return array - an associative array of all the field properties.
   */
  public function info(): array {
    // Intialize the `output` associative array
    $output = [];
    
    // loop throught the `fields` property
    foreach ($this->fields as $field) {
      // Append the `field` to the `output` associative array
      $output[$field] = isset($this->$field) ? $this->$field : null;
    }

    // Return the `output`
    return $output;
  }


  // PUBLIC STATIC SETTERS

  // PUBLIC STATIC GETTERS
  
  
  
  // PRIVATE STATIC METHODS

  // PRIVATE STATIC SETTERS

  // PRIVATE STATIC GETTERS



  /**
   * Populates the given `$instance` with the given `$params` array
   *
   * @param array $params
   * @param self $instance
   *
   * @return self
   * @private
   */
  private static function populate(array $params, self $instance): self {
    // Initialize the `originalProperties` associative array
    $originalProperties = [];
    

    // loop through all the `params`
    foreach ($params as $fieldKey => $fieldValue) {
      // echo $fieldKey . ' => ' . $fieldValue . ' ' . gettype($fieldValue) . '<br>';
      // Set the `$fieldKey` to the `$fieldValue` in the `$instance`
      $instance->$fieldKey = ($fieldKey !== $instance->primaryKey) ? (int) $fieldValue : $fieldValue;

      // Append the `$fieldKey` and `$fieldValue` to the `originalProperties` associative array
      $originalProperties[$fieldKey] = $fieldValue;
    }
    
    // If the `originalProperties` array of the current instance is empty...
    if (empty($instance->originalProperties)) {
      // ...set the `originalProperties` to the `originalProperties` associative array
      $instance->originalProperties = $originalProperties;
    }
    
    // Return the `$instance`
    return $instance;
  }



  // PUBLIC METHODS

  // PUBLIC SETTERS

  // PUBLIC GETTERS


  /**
   * Checks if this password is actually common ;)
   *
   * @return bool
   * @public
   */
  public function isCommon(): bool {
    return isset($this->length) && $this->length > 0;
  }

  
  // PRIVATE METHODS


  /**
   * Method used to load the csv data
   * NOTE: This method updates the `csv_data` property
   *
   * @return void
   * @private
   */
  private function loadCsvData(): void {
    // Get the path to the csv file
    $csvFilePath = $this->getCsvFilePath();

    // If the csv file exists...
    
    if (file_exists($csvFilePath)) {
    // ...load the csv data
      $this->csv_data = $this->getCsvData($csvFilePath);
    }
    
  }


  /**
   * Returns the path to the csv file
   *
   * @return string
   * @private
   */
  private function getCsvFilePath(): string {
    return __DIR__ . '/../../assets/' . $this->csv_file;
  }


  /**
   * Method used to retrieve the csv data from the given `$csvFilePath`
   *
   * @param string $csvFilePath : The path to the csv file (eg. `./assets/common-passwords.csv`)
   *
   * @return array $csvData : The csv data
   * @private
   */
  private function getCsvData(string $csvFilePath): array {
    // Initialize the `csvData` array
    $csvData = [];
 // If the csv file exists...
    if (file_exists($csvFilePath)) {
      // ...let's read the file from the beginning
      $file = fopen($csvFilePath, 'r');

      // While we have not reached the end of the file...
      // NOTE 1: We use `feof` to check if we have reached the end of the file
      // NOTE 2: We use `fgetcsv` to read the file line by line
      // NOTE 3: We use `array_combine` to combine the `fields` array with the `fgetcsv` array

      while (!feof($file)) {
        // Get the current line
        $line = fgetcsv($file);

        // If the `line` is an array...
        if (is_array($line)) {
          // ...combine the `fields` array with the `line` array
          $csvData[] = array_combine($this->fields, $line);
        }
      }

    }

    // Return the `csvData` array
    return $csvData;
  }


  // PRIVATE SETTERS

  // PRIVATE GETTERS


  // PROTECTED METHODS

  // PROTECTED SETTERS

  // PROTECTED GETTERS

  
  /**
   * Returns an instance of the current class
   *
   * @return self
   * @protected
   */
  protected static function getInstance(): self {
    // Get the class name of the current class
    $className = get_called_class(); // <- returns eg. 'Maxaboom\Controllers\Helpers\CommonPassword'

    // Return an instance of the current class
    return new $className();
  }

  
}
