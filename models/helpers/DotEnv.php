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
* @name DotEnv - Model Helper
* @file DotEnv.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Using the DotEnv class 
*    -|>
*
*/



// Declare a namespace for this `DotEnv` class
namespace Maxaboom\Models\Helpers;



/**
 * A class for loading environment variables from `.env` files
 */
class DotEnv {

  /**
   * @var string
   */
  private string $path;


  /**
   * Constructor of the DotEnv class
   *
   * @param string $path (default: '../config/.env')
   */
  public function __construct(string $path = '.env') {
    // Initialize the `path` attribute
    $this->path = $path;
  }

  /**
   * Loads the environment variables
   */
  public function load() {
    // Check if the file exists
    if (!file_exists($this->path)) {
      throw new \RuntimeException(sprintf('Unable to load the "%s" file.', $this->path));
    }

    // Read the file
    $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Loop through the lines
    foreach ($lines as $line) {
      // Check if the line is a comment
      if (strpos(trim($line), '#') === 0) {
        continue;
      }

      // Split the line
      list($name, $value) = explode('=', $line, 2);

      // Check if the value is quoted
      if (!preg_match('/\A(["\'])(.*)\1\z/', $value, $matches)) {
        $value = trim($value);
      } else {
        $value = $matches[2];
      }
      
      // Set the environment variable
      putenv(sprintf('%s=%s', $name, $value));
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;

      // DEBUG [4dbsmaster]: tell me about it ;)
      // var_dump(sprintf('%s=%s', $name, $value));
    }
  }
  
}
