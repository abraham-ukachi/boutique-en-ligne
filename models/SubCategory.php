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
* @name Sub-Category - Model
* @test test/???.php
* @file SubCategory.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Create a new sub category
*    -|>
*    -|> $subCategory = SubCategory::create([
*    -|>   'title' => 'piano a queue',
*    -|>   'name' => 'grand-piano',
*    -|>   'category_id' => 1
*    -|> ]);
*    -|>
*   o=|> echo $subCategory->id; // 1
*    -|>
*
*   2+|> // Find a sub-category by id
*    -|>
*    -|> $subCategory = SubCategory::find(1);
*    -|>
*   o=|> echo $subCategory->name; // grand-piano
*    -|>
*
*/



// declare a namespace for this User class
namespace Maxaboom\Models;

// use these classes
use datetime;
use PDO;
use PDOException;

/**
 * Class SubCategory / SubCategory Model
 * A class that represents the `sub_categories` table in the database.
 */
class SubCategory extends Model {

  // Define some properties here ;)
  
  // protected properties

  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table = 'sub_categories';



  /**
    * Indicates if the model should automatically connect to the database.
    *
    * @var bool
    */
  protected bool $autoConnect = true;


  /**
   * All the supported fields in the `categories` table
   * @var array
   */
  protected array $fields = [
    'id',
    'title',
    'name',
    'category_id'
  ];


  // public properties
  public ?int $id = null;
  public ?string $title = null;
  public ?string $name = null;
  public ?int $category_id = null;


  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = false;


  

  /**
   * SubCategory constructor.
   * NOTE: This constructor is called automatically when the class is instantiated
   */
  public function __construct() {
    // call the parent Model constructor
    parent::__construct();

  }


  // PUBLIC STATIC SETTERS

  // PUBLIC STATIC GETTERS

  // PUBLIC STATIC METHODS


  
  
  
  
  // PUBLIC SETTERS
  
  // PUBLIC GETTERS
  
  // PUBLIC METHODS

 

  // PRIVATE STATIC SETTERS

  // PRIVATE STATIC GETTERS

  // PRIVATE STATIC METHODS




  // PRIVATE SETTERS
  
  // PRIVATE GETTERS
  
  // PRIVATE METHODS
  

}
