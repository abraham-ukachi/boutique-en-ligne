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
* @name Order - Model
* @test test/order_model.php
* @file Database.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Generate a new order id
*    -|>
*    -|> $generatedOrderId = Order::generateId();
*    -|>
*    -|> echo $generatedOrderId; // 163456789
*
*
*   2+|> // Create a new order 
*    -|>
*    -|> $order = Order::create([
*    -|>   'id' => $generatedOrderId,
*    -|>   'user_id' => 1,
*    -|>   'status' => 'pending',
*    -|>   'address_id' => 1,
*    -|>   'card_id' => 1,
*    -|>   'delivery_method' => 'standard',
*    -|>   'payment_method' => 'visa',
*    -|>   'total' => 100.00,
*    -|>   'discount_percentage' => 0,
*    -|>   'total_discounted' => 100.00,
*    -|>   'tax_amount' => 20.00,
*    -|>   'delivery_amount' => 10.00,
*    -|>   'total_price' => 130.00,
*    -|> ]);
*
*
 */


// declare the namespace for this `Order` class
namespace Maxaboom\Models;

// use these classes
use datetime;













/**
 * Class Order / Order Model
 * A class that represents the `orders` table in the database.
 */
class Order extends Model {

  // Define some constants here ;)



  // Define some properties here ;)


  // protected properties


  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table = 'orders';


  /**
   * Indicates if the model should automatically connect to the database.
   *
   * @var bool
   */
  protected bool $autoConnect = true;


  /**
   * All the supported fields in the `orders` table
   * @var array
   */
  protected array $fields = [
    'id',
    'user_id',
    'status',
    'address_id',
    'card_id',
    'delivery_method',
    'payment_method',
    'total',
    'discount_percentage',
    'total_discounted',
    'tax_amount',
    'delivery_amount',
    'total_price',
    'deleted_at',
    'updated_at',
    'created_at'
  ];


  // public properties

  public ?int $id = null;
  public ?int $user_id = null;
  public ?string $status = null;
  public ?int $address_id = null;
  public ?int $card_id = null;
  public ?string $payment_method = null;
  public ?float $total = null;
  public ?int $discount_percentage = null;
  public ?float $total_discounted = null;
  public ?int $tax_amount = null;
  public ?float $delivery_amount = null;
  public ?float $total_price = null;
  public ?string $created_at = null;


  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = true;

  

  // private properties




  /**
   * Order constructor.
   * NOTE: This constructor is called automatically when the class is instantiated
   */
  public function __construct() {
    // call the parent Model constructor
    parent::__construct();
  }


  // PUBLIC STATIC METHODS
  
  /**
   * Generates a time-based unique random order id.
   * NOTE: This generated id doesn't exist in the database yet.
   *
   * @return int
   */
  public static function generateId(): int {
    // get current timestamp
    $timestamp = time();
    // convert timestamp from binary to hexadecimal value & stringify the number
    $hexTimestamp = strval(bin2hex($timestamp));

    // get the last 9 numbers from the hexadecimal timestamp as `last9`
    $last9 = (int) substr($hexTimestamp, -9);
    // pad `last9` with zeros to make it 9 digits long
    $result = str_pad(strval($last9), 9, '0', STR_PAD_RIGHT);

    // DEBUG [4dbsmaster]: tell me about it ;)
    // printf("hexTimestamp =>>> %s & result ==> %s", $hexTimestamp, $result);

    // return the result as an integer
    return (int) $result;
  }


  // PUBLIC STATIC GETTERS

  // PUBLIC STATIC SETTERS



  // PUBLIC METHODS

  // PUBLIC GETTERS

  // PUBLIC SETTERS






  // PRIVATE STATIC METHODS
  
  // PRIVATE STATIC GETTERS

  // PRIVATE STATIC SETTERS
  
  
  
  // PRIVATE METHODS  

  /**
   * Checks if the given `orderId` already exists in this table
   *
   * @param int $orderId - the order id to check
   *
   * @return bool - returns TRUE if the order id exists, otherwise returns FALSE
   * @private
   */
  private function verifyId(int $orderId): bool {}
  
   
  // PRIVATE GETTERS

  // PRIVATE SETTERS
}
