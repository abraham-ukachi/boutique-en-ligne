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
* @name Model Interface
* @file ModelInterface.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // 
*    -|>
*
*/

namespace Maxaboom\Models;



/**
 * The interface of our maxaboom model ;) #laravel
 * NOTE: This interface was inspired by Laravel's eloquent models 
 */
interface ModelInterface {

  // PUBLIC STATIC METHODS -----------------------------------------------------
  
  /**
   * Creates a new record in the database with the given parameters
   *
   * @param array $params - The parameters to create the record with (eg. ['name' => 'John Doe'])
   * @return self - The created record (eg. $user = User::create($params))
   */
  public static function create(array $params): self;

  /**
   * Finds a record in the database with the given `id`
   *
   * @param int $id - The id of the record to find
   * @return self - The found record (eg. $user = User::find($id))
   */
  public static function find(int $id): self;
  

  /**
   * Finds all the records in the database
   *
   * @return array - The found records (eg. $users = User::all())
   */
  public static function all(): array;


  /**
   * Finds all the records in the database with the given `column` and `value`, using the given `operator`
   * NOTE: This method is used to find records with a specific column value
   * 
   * @param string $column - The column to find the records with (eg. 'name')
   * @param string $operator - The operator to use to find the records (eg. '=')
   * @param string $value - The value to find the records with (eg. 'John Doe')
   *
   * @return array - The found records (eg. $users = User::where('name', '=', 'John Doe'))
   */
  public static function where(): self|array;


  // PUBLIC METHODS -----------------------------------------------------------

  /**
   * Saves all the changed properties of the record to the database
   *
   * @return bool - Whether the save was successful or not
   */
  public function save(): bool;


  // PUBLIC GETTERS -----------------------------------------------------------
  
  /**
   * Returns all the properties and their values of this model
   * NOTE: This method is used to get the properties and their values of a model
   *
   * @return array - The properties and their values of this model (eg. ['name' => 'John Doe'])
   */
  public function info(): array;

  /**
   * Returns all the info of the last record created as an array
   *
   * @return array - The info of the last record created (eg. ['name' => 'John Doe'])
   */
  public function get(): array;

  
  /**
   * Returns the value of the `id` property is set
   *
   * @return bool
   */
  public function exists(): bool;

}
