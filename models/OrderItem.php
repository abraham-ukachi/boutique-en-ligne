<?php
/*
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
* @name Order Item - Model
* @test test/order-item_model.php
* @file Database.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*
*   2+|> // Create a new order item
*    -|>
*    -|> $orderItem = OrderItem::create([
*    -|>   'order_id' => 1,
*    -|>   'product_id' => 1,
*    -|>   'quantity' => 1,
*    -|>   'unit_price' => 1.99
*    -|> ]);
*
*
*/


// declare the namespace for this `OrderItem` class
namespace Maxaboom\Models;

// use these classes
use datetime;













/**
 * Class OrderItem / OrderItem Model
 * A class that represents the `orders_items` table in the database.
 */
class OrderItem extends Model {

  // Define some constants here ;)



  // Define some properties here ;)


  // protected properties


  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table = 'orders_items';


  /**
   * Indicates if the model should automatically connect to the database.
   *
   * @var bool
   */
  protected bool $autoConnect = true;


  /**
   * All the supported fields in the `orders_items` table
   * @var array
   */
  protected array $fields = [
    'id',
    'order_id',
    'product_id',
    'quantity',
    'unit_price'
  ];
  
  
  // public properties

  public ?int $id = null;
  public ?int $order_id = null;
  public ?int $product_id = null;
  public ?int $quantity = null;
  public ?float $unit_price = null;


  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = false;

  

  // private properties




  /**
   * OrderItem constructor.
   * NOTE: This constructor is called automatically when the class is instantiated
   */
  public function __construct() {
    // call the parent Model constructor
    parent::__construct();
  }


  // PUBLIC STATIC METHODS

  // PUBLIC STATIC GETTERS

  // PUBLIC STATIC SETTERS



  // PUBLIC METHODS

  // PUBLIC GETTERS

  // PUBLIC SETTERS






  // PRIVATE STATIC METHODS
  
  // PRIVATE STATIC GETTERS

  // PRIVATE STATIC SETTERS
  
  
  
  // PRIVATE METHODS   
   
  // PRIVATE GETTERS

  // PRIVATE SETTERS


}
